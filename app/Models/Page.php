<?php

namespace App\Models;

use App\Enums\PageCategory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'active',
        'category',
        'title',
        'slug',
        'body',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    protected $appends = ['category_label'];

    protected $casts = [
        'active' => 'boolean',
        'category' => PageCategory::class,
    ];

    public function getCategoryLabelAttribute(): string
    {
        return trans("enums.page.category.{$this->category->name}");
    }
}
