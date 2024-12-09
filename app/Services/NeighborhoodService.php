<?php

namespace App\Services;

use App\Models\Neighborhood;
use Illuminate\Support\Str;

class NeighborhoodService
{
    public function store(array $data): ?Neighborhood
    {
        $neighborhood = new Neighborhood();
        $neighborhood = $this->assignAttributes($neighborhood, $data);

        return $neighborhood->fresh();
    }

    public function update(Neighborhood $neighborhood, array $data): ?Neighborhood
    {
        $neighborhood = $this->assignAttributes($neighborhood, $data);

        return $neighborhood->fresh();
    }

    public function delete(Neighborhood $neighborhood): ?bool
    {
        return $neighborhood->delete();
    }

    private function assignAttributes(Neighborhood $neighborhood, array $data): ?Neighborhood
    {
        $neighborhood->name = $data['name'];
        $neighborhood->district_id = $data['district_id'] ?? $neighborhood->district_id;
        $neighborhood->title = $data['title'];
        $neighborhood->slug = Str::slug(!empty($data['slug']) ? $data['slug'] : $data['title']);;

        $neighborhood->save();

        return $neighborhood->fresh();
    }
}
