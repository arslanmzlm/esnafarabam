<?php

namespace App\Services;

use App\Models\District;
use Illuminate\Support\Str;

class DistrictService
{
    public function store(array $data): ?District
    {
        $district = new District();
        $district = $this->assignAttributes($district, $data);

        return $district->fresh();
    }

    public function update(District $district, array $data): ?District
    {
        $district = $this->assignAttributes($district, $data);

        return $district->fresh();
    }

    public function delete(District $district): ?bool
    {
        return $district->delete();
    }

    private function assignAttributes(District $district, array $data): ?District
    {
        $district->name = $data['name'];
        $district->province_id = $data['province_id'] ?? $district->province_id;
        $district->title = $data['title'];
        $district->slug = Str::slug(!empty($data['slug']) ? $data['slug'] : $data['title']);;

        $district->save();

        return $district->fresh();
    }
}
