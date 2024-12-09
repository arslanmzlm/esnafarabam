<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Neighborhood extends Model
{
    protected $fillable = ['name', 'district_id', 'title', 'slug'];

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }
}
