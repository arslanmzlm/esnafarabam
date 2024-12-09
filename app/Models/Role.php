<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use HasFactory;

    const DEFAULT_ROLE_ID = 2;

    protected $fillable = ['key', 'title', 'description'];

    public function abilities(): BelongsToMany
    {
        return $this->belongsToMany(Ability::class);
    }
}