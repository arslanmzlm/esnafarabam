<?php

namespace App\Models;

use App\Enums\AttributeInput;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Attribute extends Model
{
    protected $fillable = [
        'active',
        'attribute_category_id',
        'name',
        'input',
        'description',
        'unit',
        'order',
        'required',
    ];

    protected $casts = [
        'active' => 'boolean',
        'input' => AttributeInput::class,
        'required' => 'boolean',
        'hidden' => 'boolean'
    ];

    protected $appends = ['input_label'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(AttributeCategory::class, 'attribute_category_id');
    }

    public function values(): HasMany
    {
        return $this->hasMany(AttributeValue::class);
    }

    public function hasValues(): bool
    {
        return in_array($this->input, AttributeInput::hasValues());
    }

    public function getInputLabelAttribute(): string
    {
        return trans("enums.attribute.input.{$this->input->name}");
    }
}
