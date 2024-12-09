<?php

namespace App\Services;

use App\Models\Province;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class ProvinceService
{
    public function store(array $data): ?Province
    {
        $province = new Province();
        $province = $this->assignAttributes($province, $data);

        return $province->fresh();
    }

    public function update(Province $province, array $data): ?Province
    {
        $province = $this->assignAttributes($province, $data);

        return $province->fresh();
    }

    public function delete(Province $province): ?bool
    {
        return $province->delete();
    }

    private function assignAttributes(Province $province, array $data): ?Province
    {
        $province->name = $data['name'];
        $province->code = $data['code'];
        $province->title = $data['title'];
        $province->slug = Str::slug(!empty($data['slug']) ? $data['slug'] : $data['title']);;

        $province->save();

        return $province->fresh();
    }

    /**
     * @return Collection<int, Province>
     */
    public function getAll(): Collection
    {
        return Province::orderBy('name')->get()->load('districts.neighborhoods');
    }

    /**
     * @return Collection<int, Province>
     */
    public function getToDistrict(): Collection
    {
        return Province::orderBy('name')->get()->load('districts');
    }
}
