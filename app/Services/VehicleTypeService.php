<?php

namespace App\Services;

use App\Models\VehicleType;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class VehicleTypeService
{
    public function store(array $data): ?VehicleType
    {
        $type = new VehicleType();
        $type = $this->assignAttribute($type, $data);

        return $type->fresh();
    }

    public function update(VehicleType $type, array $data): ?VehicleType
    {
        $type = $this->assignAttribute($type, $data);

        return $type->fresh();
    }

    public function delete(VehicleType $type): ?bool
    {
        $this->deleteLogo($type);
        return $type->delete();
    }

    private function assignAttribute(VehicleType $type, array $data): ?VehicleType
    {
        $type->active = $data['active'] ?? false;
        $type->name = $data['name'];
        $type->title = $data['title'];
        $type->slug = Str::slug(!empty($data['slug']) ? $data['slug'] : $data['title']);
        $type->order = isset($data['order']) && is_numeric($data['order']) ? intval($data['order']) : null;
        $type->step_type = $data['step_type'] ?? $type->step_type;

        if ($data['logo'] instanceof UploadedFile) {
            $type->logo = $this->storeLogo($data['logo']);
        }

        $type->save();

        return $type->fresh();
    }

    private function storeLogo(UploadedFile $logo): string
    {
        $fileName = Str::uuid()->toString() . '.' . $logo->extension();
        $logo->storePubliclyAs(VehicleType::LOGO_PATH, $fileName, 'public');
        return $fileName;
    }

    private function deleteLogo(VehicleType $type): void
    {
        if ($type->logo) {
            Storage::disk('public')->delete(VehicleType::LOGO_PATH . "/{$type->logo}");
        }
    }
}
