<?php

namespace App\Models\Artists;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    protected $fillable =['user_id','name', 'description', 'location', 'image'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    public function videos()
    {
        return $this->morphMany('App\Models\Videos\Video','videoable');
    }
}
