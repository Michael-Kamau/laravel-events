<?php

namespace App\Models\Videos;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $guarded = [];

    public function videoable()
    {
        return $this->morphTo();
    }
}
