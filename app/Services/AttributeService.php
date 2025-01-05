<?php

namespace App\Services;

use App\Enums\AttributeInput;
use App\Enums\AttributeType;
use App\Models\Attribute;
use App\Models\AttributeCategory;
use App\Models\Item;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class AttributeService
{
    public function store(array $data): ?Attribute
    {
        $attribute = new Attribute();
        $attribute = $this->assignAttribute($attribute, $data);

        if (!empty($data['values']) && is_array($data['values'])) {
            $this->insertValues($attribute, $data['values']);
        }

        return $attribute->fresh();
    }

    private function assignAttribute(Attribute $attribute, array $data): ?Attribute
    {
        $attribute->active = $data['active'] ?? false;
        $attribute->attribute_category_id = $data['attribute_category_id'];
        $attribute->input = $data['input'];
        $attribute->name = $data['name'];
        $attribute->description = $data['description'] ?? null;
        $attribute->unit = $data['unit'] ?? null;
        $attribute->order = isset($data['order']) && is_numeric($data['order']) ? intval($data['order']) : null;
        $attribute->required = $data['required'] ?? false;

        $attribute->save();

        return $attribute->fresh();
    }

    private function insertValues(Attribute $attribute, array $values): void
    {
        foreach ($values as $item) {
            $attribute->values()->create(['value' => $item['value']]);
        }
    }

    public function update(Attribute $attribute, array $data): ?Attribute
    {
        $attribute = $this->assignAttribute($attribute, $data);

        if (!empty($data['values']) && is_array($data['values'])) {
            $this->updateValues($attribute, $data['values']);
        } else if (
            $attribute->values()->exists() && (empty($data['values']) || !$attribute->hasValues())
        ) {
            $attribute->values()->delete();
        }

        return $attribute->fresh();
    }

    private function updateValues(Attribute $attribute, array $values): void
    {
        $ids = collect($values)->whereNotNull('id')->pluck('id')->toArray();
        $attribute->values()->whereNotIn('id', $ids)->delete();

        foreach ($values as $item) {
            $attribute->values()->updateOrCreate(
                ['id' => $item['id']],
                ['value' => $item['value']]
            );
        }
    }

    public function delete(Attribute $attribute): ?bool
    {
        return $attribute->delete();
    }

    /**
     * @param AttributeType|AttributeType[] $type
     * @param int $vehicle_type_id
     * @return Collection
     */
    public function getAttributes(array|AttributeType $type, int $vehicle_type_id): Collection
    {
        return AttributeCategory::whereIn('type', !is_array($type) ? [$type] : $type)
            ->where(function (Builder $query) use ($vehicle_type_id) {
                $query->where('vehicle_type_id', $vehicle_type_id)
                    ->orWhereNull('vehicle_type_id');
            })
            ->whereHas('attributes')
            ->get()
            ->load('attributes.values');
    }

    public function getAttributeValues(Vehicle|Item $model): Collection
    {
        if ($model instanceof Vehicle) {
            $types = [AttributeType::VEHICLE, AttributeType::BOTH];
            $vehicle_type_id = $model->vehicle_type_id;
        } else {
            $types = [AttributeType::ITEM, AttributeType::BOTH];
            $vehicle_type_id = $model->vehicle->vehicle_type_id;
        }

        $attributeCategories = AttributeCategory::select('id')
            ->whereIn('type', $types)
            ->where(function (Builder $query) use ($vehicle_type_id) {
                $query->where('vehicle_type_id', $vehicle_type_id)
                    ->orWhereNull('vehicle_type_id');
            });

        $attributes = Attribute::whereIn('attribute_category_id', $attributeCategories)->get()->load('values');
        $modelAttributes = $model->attributes;

        $data = collect();

        $attributes->each(function ($attribute) use ($model, $modelAttributes, $data) {
            $attributeValue = $modelAttributes->where('attribute_id', $attribute->id)->first();

            $vehicleValue = $model instanceof Item && $attribute->category->type === AttributeType::BOTH
                ? $model->vehicle->attributes->where('attribute_id', $attribute->id)->first()
                : null;

            $data->push([
                'id' => $attributeValue?->id ?? null,
                'attribute_id' => $attribute->id,
                'value' => $attributeValue?->attribute_value_id ?? $attributeValue?->value ?? $vehicleValue?->attribute_value_id ?? $vehicleValue?->value ?? null,
            ]);
        });

        return $data;
    }

    public function getAttributesByItem(Item $item): Collection
    {
        $vehicle_type_id = $item->vehicle->vehicle_type_id;

        $attributeCategories = AttributeCategory::whereHas('attributes')
            ->where(function (Builder $query) use ($vehicle_type_id) {
                $query->where('vehicle_type_id', $vehicle_type_id)
                    ->orWhereNull('vehicle_type_id');
            })
            ->orderBy('order')
            ->get()
            ->load('attributes.values');

        $data = collect();
        $vehicleAttributes = $item->vehicle->attributes;
        $itemAttributes = $item->attributes;

        $attributeCategories->each(function ($attributeCategory) use ($data, $vehicleAttributes, $itemAttributes) {
            $row = [
                'categoryName' => $attributeCategory->name,
                'tableAttributes' => [],
                'checkboxAttributes' => []
            ];

            $attributeCategory->attributes->each(function ($attribute) use (&$row, $vehicleAttributes, $itemAttributes) {
                if (!$attribute->hidden) {
                    if ($itemAttribute = $itemAttributes->where('attribute_id', $attribute->id)->first()) {
                        if ($itemAttribute->attribute_value_id && $attributeValue = $attribute->values->find($itemAttribute->attribute_value_id)) {
                            $value = $attributeValue->value;
                        } else if ($attribute->input === AttributeInput::CHECKBOX) {
                            $value = $attribute->values->whereIn('id', $itemAttribute->value)->pluck('value');
                        } else {
                            $value = $itemAttribute->value;
                        }
                    } else if ($vehicleAttribute = $vehicleAttributes->where('attribute_id', $attribute->id)->first()) {
                        if ($vehicleAttribute->attribute_value_id && $attributeValue = $attribute->values->find($vehicleAttribute->attribute_value_id)) {
                            $value = $attributeValue->value;
                        } else if ($attribute->input === AttributeInput::CHECKBOX) {
                            $value = $attribute->values->whereIn('id', $vehicleAttribute->value)->pluck('value');
                        } else {
                            $value = $vehicleAttribute->value;
                        }
                    }

                    if (!empty($value)) {
                        if (!is_array($value) && $attribute->unit) {
                            $value .= " {$attribute->unit}";
                        }

                        $attributeData = [
                            'name' => $attribute->name,
                            'value' => $value
                        ];

                        if ($attribute->input === AttributeInput::CHECKBOX) {
                            $row['checkboxAttributes'][] = $attributeData;
                        } else {
                            $row['tableAttributes'][] = $attributeData;
                        }
                    }
                }
            });

            if (!empty($row['tableAttributes']) || !empty($row['checkboxAttributes'])) {
                $data->push($row);
            }
        });

        return $data;
    }
}
