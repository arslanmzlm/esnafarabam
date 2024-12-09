<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    const LOGO_PATH = 'brands/logo';

    protected $fillable = ['name', 'logo', 'active'];

    protected $casts = ['active' => 'boolean'];

    protected $appends = ['logo_src'];

    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class);
    }

    public function getLogoSrcAttribute(): ?string
    {
        return $this->logo ? "/uploads/" . self::LOGO_PATH . "/{$this->logo}" : null;
    }
}
