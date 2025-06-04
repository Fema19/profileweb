<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileTranslation extends Model
{
    protected $fillable = ['profile_id', 'locale', 'bio'];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
