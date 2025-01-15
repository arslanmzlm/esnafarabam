<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SettingService
{
    public static function get(string $key, $default = null)
    {
        $setting = Setting::where('key', $key)->first();

        return $setting ? $setting->value : $default;
    }

    public static function getSrc(string $key, $default = null)
    {
        $setting = Setting::where('key', $key)->first();

        return $setting ? $setting->getSrc() : $default;
    }

    public static function getPhone(string $key, $default = null)
    {
        $setting = Setting::where('key', $key)->first();

        if ($setting) {
            try {
                return phone($setting->value, 'TR');
            } catch (\Exception|\Error $e) {
                return $setting->value;
            }
        }


        return $default;
    }

    public function getAll(): Collection
    {
        $settings = Setting::all();
        $data = collect([]);

        foreach ($settings as $setting) {
            $data->put($setting->key, $setting->value);
        }

        return $data;
    }

    public function updateAll(array $data): void
    {
        $settings = Setting::all();

        foreach ($data as $key => $value) {
            if ($setting = $settings->where('key', $key)->first()) {
                $this->update($setting, $value);
            } else {
                $this->store($key, $value);
            }
        }
    }

    public function update(Setting $setting, $value): bool
    {
        $save = false;

        if ($value instanceof UploadedFile) {
            $this->deleteFile($setting);
            $setting->value = $this->storeFile($value);
            $save = true;
        } else if ($setting->value !== $value) {
            $setting->value = $value;
            $save = true;
        }

        return $save && $setting->save();
    }

    private function deleteFile(Setting $setting): void
    {
        if ($setting->value) {
            Storage::disk('public')->delete(Setting::FILE_PATH . "/{$setting->value}");
        }
    }

    private function storeFile(UploadedFile $file): string
    {
        $fileName = Str::uuid()->toString() . '.' . $file->extension();
        $file->storePubliclyAs(Setting::FILE_PATH, $fileName, 'public');
        return $fileName;
    }

    public function store(string $key, $value): ?Setting
    {
        if (!empty($value)) {
            $setting = new Setting();
            $setting->key = $key;
            $setting->value = $value instanceof UploadedFile ? $this->storeFile($value) : $value;
            $setting->save();

            return $setting;
        }

        return null;
    }
}
