<?php

namespace App\Services;

use App\Models\Brand;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BrandService
{
    public function store(array $data): ?Brand
    {
        $brand = new Brand();
        return $this->assignAttributes($brand, $data);
    }

    public function update(Brand $brand, array $data): ?Brand
    {
        return $this->assignAttributes($brand, $data);
    }

    public function delete(Brand $brand): ?bool
    {
        $this->deleteLogo($brand);
        return $brand->delete();
    }

    private function assignAttributes(Brand $brand, array $data): ?Brand
    {
        $brand->active = $data['active'] ?? false;
        $brand->name = $data['name'];
        $brand->title = $data['title'];
        $brand->slug = Str::slug(!empty($data['slug']) ? $data['slug'] : $data['title']);
        $brand->order = isset($data['order']) && is_numeric($data['order']) ? intval($data['order']) : null;

        if ($data['logo'] instanceof UploadedFile) {
            $brand->logo = $this->storeLogo($data['logo']);
        }

        $brand->save();

        return $brand->fresh();
    }

    private function storeLogo(UploadedFile $logo): string
    {
        $fileName = Str::uuid()->toString() . '.' . $logo->extension();
        $logo->storePubliclyAs(Brand::LOGO_PATH, $fileName, 'public');
        return $fileName;
    }

    private function deleteLogo(Brand $brand): void
    {
        if ($brand->logo) {
            Storage::disk('public')->delete(Brand::LOGO_PATH . "/{$brand->logo}");
        }
    }
}
