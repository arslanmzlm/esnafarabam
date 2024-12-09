<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemPhoto extends Model
{
    protected $fillable = ['item_id', 'file', 'state', 'order'];

    protected $appends = ['src'];

    public function getSrcAttribute(): ?string
    {
        return '/uploads/' . Item::PHOTO_BASE_PATH . "/{$this->item_id}/{$this->file}";
    }
}
