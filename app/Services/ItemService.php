<?php

namespace App\Services;

use App\Enums\AttributeInput;
use App\Enums\ItemState;
use App\Enums\PhotoState;
use App\Models\Attribute;
use App\Models\Item;
use App\Models\VehicleType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class ItemService
{
    public function store(array $data): ?Item
    {
        $item = new Item();
        return $this->assignAttribute($item, $data);
    }

    private function assignAttribute(Item $item, array $data): ?Item
    {
        $item->user_id = $item->user_id ?? auth()->id() ?? 1;
        $item->vehicle_id = $data['vehicle_id'] ?? $item->vehicle_id;
        $item->state = $item->state ?? ItemState::DRAFT;
        $item->title = $data['title'];
        $item->price = intval($data['price']);
        $item->kilometer = intval($data['kilometer']);
        $item->description = $data['description'];
        $item->province_id = $data['province_id'];
        $item->district_id = $data['district_id'];
        $item->neighborhood_id = $data['neighborhood_id'];

        $item->save();

        $item->slug = Str::slug($data['slug'] ?? $data['title']) . "-{$item->id}";

        $item->save();

        if (!empty($data['attributes'])) $this->updateAttributes($item, $data['attributes']);
        if (!empty($data['photos'])) $this->uploadImages($item, $data['photos']);

        return $item->fresh();
    }

    public function updateAttributes(Item $item, array $values): void
    {
        $attributes = Attribute::all()->load('values');
        $itemAttributes = $item->attributes;

        foreach ($values as $row) {
            $id = $row['id'];
            $attribute_id = $row['attribute_id'];
            $value = $row['value'] ?? null;

            if (empty($value) && !empty($id)) {
                $itemAttributes->find($id)->delete();
            } else if (!empty($value)) {
                $attribute = $attributes->find($attribute_id);

                $create = [
                    'attribute_id' => $attribute->id
                ];

                if ($attribute->hasValues() && !is_array($value) && $attributeValue = $attribute->values()->find($value)) {
                    $create['attribute_value_id'] = $attributeValue->id;
                } else if ($attribute->input === AttributeInput::NUMBER) {
                    $create['value'] = intval($value);
                } else {
                    $create['value'] = $value;
                }

                $item->attributes()->updateOrCreate(['id' => $row['id']], $create);
            }
        }
    }

    public function delete(Item $item): ?bool
    {
        return $item->delete();
    }

    public function uploadImages(Item $item, array $photos): void
    {
        $storage = Storage::disk('public');

        $uploaded = [];

        foreach ($photos as $index => $row) {
            $photoIndex = $index + 1;

            $id = $row['id'];
            /** @var UploadedFile $file */
            $file = $row['file'];
            $order = $row['order'] ?? $photoIndex;

            if (!empty($file)) {
                if ($file instanceof UploadedFile) {
                    $image = Image::read($file)->scaleDown(height: 1080)->toJpeg();
                    $fileName = "{$item->id}-{$photoIndex}-" . Str::orderedUuid()->toString() . ".jpg";
                    $storage->put("{$item->photo_path}/{$fileName}", $image);

                    $attributes = [
                        'item_id' => $item->id,
                        'file' => $fileName,
                        'order' => $order,
                        'state' => PhotoState::UPLOADED,
                    ];

                    if ($photo = $item->photos()->find($id)) {
                        if ($storage->exists("{$item->photo_path}/{$photo->file}")) {
                            $storage->delete("{$item->photo_path}/{$photo->file}");
                        }

                        $photo->update($attributes);
                    } else {
                        $photo = $item->photos()->create($attributes);
                    }

                    $uploaded[] = $photo->id;
                } else {
                    $uploaded[] = $id;
                }
            }
        }

        $deleted = $item->photos()->whereNotIn('id', $uploaded)->get();

        foreach ($deleted as $photo) {
            if ($storage->exists("{$item->photo_path}/{$photo->file}")) {
                $storage->delete("{$item->photo_path}/{$photo->file}");
            }
            $photo->delete();
        }

        $this->reOrderPhotos($item);
    }

    public function update(Item $item, array $data): ?Item
    {
        return $this->assignAttribute($item, $data);
    }

    private function reOrderPhotos(Item $item): void
    {
        foreach ($item->photos as $index => $photo) {
            $photo->order = $index + 1;
            $photo->save();
        }
    }

    public function evaluate(Item $item, array $data): ?Item
    {
        $item->state = $data['state'] ?? $item->state;
        $item->note = $data['note'] ?? $item->note;
        $item->save();

        $this->evaluatePhotos($item, $data);

        return $item->fresh();
    }

    public function evaluatePhotos(Item $item, array $data): void
    {
        $reOrder = false;

        if (is_array($data['approved_photos']) && !empty($data['approved_photos'])) {
            $item->photos()->whereIn('id', $data['approved_photos'])->update(['state' => PhotoState::APPROVED]);

            $reOrder = true;
        }

        if (is_array($data['rejected_photos']) && !empty($data['rejected_photos'])) {
            $item->photos()->whereIn('id', $data['rejected_photos'])->update(['state' => PhotoState::REJECTED]);

            $reOrder = true;
        }

        if (is_array($data['deleted_photos']) && !empty($data['deleted_photos'])) {
            $storage = Storage::disk('public');

            $deletedPhotos = $item->photos()->whereIn('id', $data['deleted_photos']);
            $deletedPhotos->get()->each(function ($photo) use ($item, $storage) {
                if ($storage->exists("{$item->photo_path}/{$photo->file}")) {
                    $storage->delete("{$item->photo_path}/{$photo->file}");
                }
            });

            $deletedPhotos->delete();

            $reOrder = true;
        }

        if ($reOrder) {
            $this->reOrderPhotos($item);
        }
    }

    public function getActive(?int $limit = null)
    {
        return Item::where('state', ItemState::PUBLISHED)->limit($limit)->get();
    }

    public function getActiveByType(VehicleType $vehicleType, ?int $limit = null)
    {
        return Item::whereRelation('vehicle', 'vehicle_type_id', $vehicleType->id)->where('state', ItemState::PUBLISHED)->paginate($limit);
    }

    public function filter(?string $search = null, ?int $limit = null)
    {
        $search = "%{$search}%";

        return Item::where(function (Builder $query) use ($search) {
            $query->orWhere('id', $search);
            $query->orWhereLike('description', $search);
            $query->orWhereLike('title', $search);
            $query->orWhereRelation('vehicle', 'title', 'LIKE', $search);
        })->where('state', ItemState::PUBLISHED)->paginate($limit);
    }
}
