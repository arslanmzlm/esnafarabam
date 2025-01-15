<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ability extends Model
{
    protected $fillable = ['route', 'post', 'title', 'description'];
}
