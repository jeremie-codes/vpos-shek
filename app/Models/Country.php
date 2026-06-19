<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';

    protected $fillable = ['name', 'code'];

    public function getDisplayNameAttribute()
    {
        return app()->getLocale() === 'en'
            ? ($this->name_en ?: $this->name)
            : $this->name;
    }
}
