<?php

namespace App\Models\Artists;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{

    protected $guarded =[];
    //

    public function artists()
    {
        return $this->belongsToMany(Artist::class);
    }
}
