<?php

namespace App\Services;

use App\Enums\AttributeInput;
use App\Models\Attribute;
use App\Models\Vehicle;
use Illuminate\Support\Str;

class VehicleService
{
    public function store(array $data): ?Vehicle
    {
        $vehicle = new Vehicle();
        return $this->assignAttribute($vehicle, $data);
    }

    public function update(Vehicle $vehicle, array $data): ?Vehicle
    {
        return $this->assignAttribute($vehicle, $data);
    }

    public function delete(Vehicle $vehicle): ?bool
    {
        return $vehicle->delete();
    }

    private function assignAttribute(Vehicle $vehicle, array $data): ?Vehicle
    {
        $vehicle->active = $data['active'] ?? false;
        $vehicle->vehicle_type_id = $data['vehicle_type_id'] ?? $vehicle->vehicle_type_id;
        $vehicle->brand_id = $data['brand_id'] ?? $vehicle->brand_id;
        $vehicle->title = $data['title'];
        $vehicle->slug = Str::slug(!empty($data['slug']) ? $data['slug'] : $data['title']);
        $vehicle->stock_code = $data['stock_code'];
        $vehicle->year = $data['year'];
        $vehicle->series = $data['series'];
        $vehicle->model = $data['model'];
        $vehicle->submodel = $data['submodel'];
        $vehicle->gear = $data['gear'];
        $vehicle->fuel = $data['fuel'];
        $vehicle->engine_power = intval($data['engine_power']);
        $vehicle->engine_size = intval($data['engine_size']);

        $vehicle->save();

        if (!empty($data['attributes'])) {
            $this->updateAttributes($vehicle, $data['attributes']);
        }

        return $vehicle->fresh();
    }

    public function updateAttributes(Vehicle $vehicle, array $values): void
    {
        $attributes = Attribute::all()->load('values');
        $vehicleAttributes = $vehicle->attributes;

        foreach ($values as $item) {
            $id = $item['id'];
            $attribute_id = $item['attribute_id'];
            $value = $item['value'];

            if (empty($value) && !empty($id)) {
                $vehicleAttributes->find($id)->delete();
            } else if (!empty($value)) {
                $attribute = $attributes->find($attribute_id);

                $create = [
                    'attribute_id' => $attribute->id
                ];

                if ($attribute->hasValues() && !is_array($value) && $attributeValue = $attribute->values()->find($value)) {
                    $create['attribute_value_id'] = $attributeValue->id;
                } elseif ($attribute->input === AttributeInput::NUMBER) {
                    $create['value'] = intval($value);
                } else {
                    $create['value'] = $value;
                }

                $vehicle->attributes()->updateOrCreate(['id' => $item['id']], $create);
            }
        }
    }
}
