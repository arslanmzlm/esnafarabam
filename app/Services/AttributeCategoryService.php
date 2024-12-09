<?php

namespace App\Services;

use App\Models\AttributeCategory;

class AttributeCategoryService
{
    public function store(array $data): ?AttributeCategory
    {
        $category = new AttributeCategory();
        $category = $this->assignAttributes($category, $data);

        return $category->fresh();
    }

    public function update(AttributeCategory $category, array $data): ?AttributeCategory
    {
        $category = $this->assignAttributes($category, $data);

        return $category->fresh();
    }

    public function delete(AttributeCategory $category): ?bool
    {
        return $category->delete();
    }

    private function assignAttributes(AttributeCategory $category, array $data): ?AttributeCategory
    {
        $category->name = $data['name'];
        $category->type = $data['type'] ?? $category->type;
        $category->vehicle_type_id = $data['vehicle_type_id'] ?? $category->vehicle_type_id ?? null;
        $category->description = $data['description'];
        $category->order = isset($data['order']) && is_numeric($data['order']) ? intval($data['order']) : null;

        $category->save();

        return $category->fresh();
    }
}
