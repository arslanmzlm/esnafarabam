<?php

namespace App\Models;

use App\Enums\AttributeType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AttributeCategory extends Model
{
    protected $fillable = ['name', 'type', 'order'];

    protected $casts = [
        'type' => AttributeType::class,
    ];

    protected $appends = ['type_label'];

    public function vehicleType(): BelongsTo
    {
        return $this->belongsTo(VehicleType::class);
    }

    public function attributes(): HasMany
    {
        return $this->hasMany(Attribute::class)->orderBy('order');
    }

    public function getTypeLabelAttribute(): string
    {
        return trans("enums.attribute.type.{$this->type->name}");
    }
}
