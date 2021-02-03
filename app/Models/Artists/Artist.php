<?php

namespace App\Models\Artists;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    //

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function videos()
    {
        return $this->morphMany('App\Models\Video','videoable');
    }
}
