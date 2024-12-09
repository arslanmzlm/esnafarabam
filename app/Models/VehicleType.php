<?php

namespace App\Models;

use App\Enums\StepType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VehicleType extends Model
{
    const LOGO_PATH = 'icons/vehicle-types';

    protected $fillable = ['active', 'name', 'logo', 'order', 'step_type'];

    protected $casts = [
        'active' => 'boolean',
        'step_type' => StepType::class,
    ];

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
