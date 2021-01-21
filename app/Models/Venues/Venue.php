<?php

namespace App\Models\Venues;

use App\Models\Status;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{

    protected $fillable = ['user_id', 'name', 'venue_category_id', 'location', 'description', 'charges', 'image'];

    //
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function bookings()
    {
        return $this->hasMany(VenueBooking::class,'venue_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }


    public function scopeUserVenues($query, $user)
    {
        return $query->where([
            'user_id'=>$user
        ]);
    }
}
