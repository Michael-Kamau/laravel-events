<?php

namespace App\Models\Venues;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    //
    public function users()
    {
        return $this->belongsTo('App\User');
    }
}
