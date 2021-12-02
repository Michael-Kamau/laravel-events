<?php

namespace App\Models\Artists;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    protected $fillable =['user_id','name', 'description','requirements', 'location', 'image'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    public function bookings()
    {
        return $this->hasMany(ArtistBooking::class,'artist_id');
    }

    public function videos()
    {
        return $this->morphMany('App\Models\Videos\Video','videoable');
    }
}
