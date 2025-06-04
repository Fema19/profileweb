<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['slug', 'name'];

    public function translations()
    {
        return $this->hasMany(ProfileTranslation::class);
    }

    public function translation($locale = 'id')
    {
        if ($this->relationLoaded('translations')) {
            return $this->translations->firstWhere('locale', $locale);
        }
        return $this->translations()->where('locale', $locale)->first();
    }
}

