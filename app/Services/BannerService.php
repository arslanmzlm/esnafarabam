<?php

namespace App\Services;

use App\Enums\BannerField;
use App\Models\Banner;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BannerService
{
    public function store(array $data): ?Banner
    {
        $banner = new Banner();
        return $this->assignAttributes($banner, $data);
    }

    private function assignAttributes(Banner $banner, array $data): ?Banner
    {
        $banner->active = $data['active'] ?? $banner->active;
        $banner->field = $data['field'] ?? $banner->field;
        $banner->title = $data['title'] ?? $banner->title;
        $banner->alt_title = $data['alt_title'] ?? $banner->alt_title;
        $banner->sub_title = $data['sub_title'] ?? $banner->sub_title;
        $banner->body = $data['body'] ?? $banner->body;
        $banner->excerpt = $data['excerpt'] ?? $banner->excerpt;
        $banner->link_label = $data['link_label'] ?? $banner->link_label;
        $banner->link = $data['link'] ?? $banner->link;
        $banner->alt = $data['alt'] ?? $banner->alt;
        $banner->options = $data['options'] ?? $banner->options;

        if ($data['image'] instanceof UploadedFile) {
            $this->deleteImage($banner);
            $banner->image = $this->storeImage($data['image']);
        }

        if ($data['mobile_image'] instanceof UploadedFile) {
            $this->deleteMobileImage($banner);
            $banner->mobile_image = $this->storeMobileImage($data['mobile_image']);
        }

        $banner->save();

        return $banner->fresh();
    }

    private function deleteImage(Banner $banner): void
    {
        if ($banner->image) {
            Storage::disk('public')->delete(Banner::IMAGE_PATH . "/{$banner->image}");
        }
    }

    public function delete(Banner $banner): ?bool
    {
        $this->deleteImages($banner);
        return $banner->delete();
    }

    private function deleteImages(Banner $banner): void
    {
        $this->deleteImage($banner);
        $this->deleteMobileImage($banner);
    }

    private function deleteMobileImage(Banner $banner): void
    {
        if ($banner->mobile_image) {
            Storage::disk('public')->delete(Banner::IMAGE_PATH . "/{$banner->mobile_image}");
        }
    }

    private function storeImage(UploadedFile $logo): string
    {
        $fileName = Str::uuid()->toString() . '.' . $logo->extension();
        $logo->storePubliclyAs(Banner::IMAGE_PATH, $fileName, 'public');
        return $fileName;
    }

    private function storeMobileImage(UploadedFile $logo): string
    {
        $fileName = Str::uuid()->toString() . '.' . $logo->extension();
        $logo->storePubliclyAs(Banner::IMAGE_PATH, $fileName, 'public');
        return $fileName;
    }

    public function update(Banner $banner, array $data): ?Banner
    {
        return $this->assignAttributes($banner, $data);
    }

    /**
     * @param BannerField ...$fields
     * @return Collection<Banner>
     */
    public function getByField(...$fields): Collection
    {
        return Banner::where('active', true)->whereIn('field', $fields)->get();
    }
}
