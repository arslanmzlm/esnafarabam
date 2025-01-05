<?php

namespace App\Models;

use App\Enums\BannerField;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    const IMAGE_PATH = 'banners';

    protected $fillable = [
        'active',
        'field',
        'title',
        'alt_title',
        'sub_title',
        'body',
        'excerpt',
        'link_label',
        'link',
        'image',
        'mobile_image',
        'alt',
        'options',
    ];

    protected $casts = [
        'active' => 'boolean',
        'field' => BannerField::class,
        'options' => 'json',
    ];

    protected $appends = ['field_label', 'image_src', 'mobile_image_src'];

    public function getFieldLabelAttribute(): string
    {
        return trans("enums.banner.field.{$this->field->name}");
    }

    public function getImageSrcAttribute(): ?string
    {
        return $this->image ? "/uploads/" . self::IMAGE_PATH . "/{$this->image}" : null;
    }

    public function getMobileImageSrcAttribute(): ?string
    {
        return $this->mobile_image ? "/uploads/" . self::IMAGE_PATH . "/{$this->mobile_image}" : null;
    }
}
