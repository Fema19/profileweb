<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Description extends Model
{
    protected $fillable = ['slug', 'title', 'link'];

    public function translations()
    {
        return $this->hasMany(DescriptionTranslation::class);
    }

    public function translation($locale = 'id')
    {
        if ($this->relationLoaded('translations')) {
            return $this->translations->firstWhere('locale', $locale);
        }
        return $this->translations()->where('locale', $locale)->first();
    }
}
