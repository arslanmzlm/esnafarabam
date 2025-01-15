<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    const FILE_PATH = 'static';

    protected $fillable = ['key', 'title', 'value'];

    protected $casts = ['value' => 'json'];

    public function getSrc(): ?string
    {
        return $this->value ? "/uploads/" . self::FILE_PATH . "/{$this->value}" : null;
    }
}
