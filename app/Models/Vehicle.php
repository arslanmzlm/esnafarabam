<?php

namespace App\Models;

use App\Enums\Fuel;
use App\Enums\Gear;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class Vehicle extends Model
{
    protected $fillable = [
        'active',
        'vehicle_type_id',
        'brand_id',
        'title',
        'slug',
        'stock_code',
        'year',
        'series',
        'model',
        'submodel',
        'gear',
        'fuel',
        'engine_power',
        'engine_size',
    ];

    protected $casts = [
        'active' => 'boolean',
        'gear' => Gear::class,
        'fuel' => Fuel::class,
    ];

    protected $appends = ['gear_label', 'fuel_label'];

    public function type(): BelongsTo
    {
        return $this->belongsTo(VehicleType::class, 'vehicle_type_id');
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function attributes(): HasMany
    {
        return $this->hasMany(VehicleAttribute::class);
    }

    public function getGearLabelAttribute(): string
    {
        return trans("enums.gear.{$this->gear->name}");
    }

    public function getFuelLabelAttribute(): string
    {
        return trans("enums.fuel.{$this->fuel->name}");
    }

    public function getAttributeValuesAttribute(): Collection
    {
        return $this->attributes()->get()->transform(function ($attributeValue) {
            return [
                'id' => $attributeValue->id,
                'attribute_id' => $attributeValue->attribute_id,
                'value' => $attributeValue->attribute_value_id ?? $attributeValue->value ?? null,
            ];
        });
    }
}
