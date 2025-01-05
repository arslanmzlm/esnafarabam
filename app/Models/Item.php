<?php

namespace App\Models;

use App\Enums\ItemState;
use App\Enums\PhotoState;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Number;

class Item extends Model
{
    const PHOTO_BASE_PATH = 'items/photos';

    protected $fillable = [
        'user_id',
        'vehicle_id',
        'state',
        'title',
        'slug',
        'price',
        'kilometer',
        'description',
        'province_id',
        'district_id',
        'neighborhood_id',
        'note'
    ];

    protected $casts = [
        'state' => ItemState::class
    ];

    protected $appends = ['state_label'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    public function neighborhood(): BelongsTo
    {
        return $this->belongsTo(Neighborhood::class);
    }

    public function approvedPhotos(): HasMany
    {
        return $this->hasMany(ItemPhoto::class, 'item_id')->where('state', PhotoState::APPROVED)->orderBy('order');
    }

    public function getPhotoPathAttribute(): string
    {
        return self::PHOTO_BASE_PATH . "/{$this->id}";
    }

    public function getStateLabelAttribute(): string
    {
        return trans("enums.item.state.{$this->state->name}");
    }

    public function getCoverAttribute(): ?ItemPhoto
    {
        return $this->photos()->where('state', PhotoState::APPROVED)->orderBy('order')->first();
    }

    public function photos(): HasMany
    {
        return $this->hasMany(ItemPhoto::class, 'item_id')->orderBy('order');
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

    public function attributes(): HasMany
    {
        return $this->hasMany(ItemAttribute::class);
    }

    public function getPriceFormattedAttribute(): false|string
    {
        return Number::format($this->price, locale: 'tr') . " TL";
    }

    public function getKilometerFormattedAttribute(): false|string
    {
        return Number::format($this->kilometer, locale: 'tr') . " km";
    }
}
