<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DescriptionTranslation extends Model
{
    protected $fillable = ['description_id', 'locale', 'content'];

    public function description()
    {
        return $this->belongsTo(Description::class);
    }
}
