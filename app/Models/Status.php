<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table= "statuses";
    //


    public function venue()
    {
        return $this->hasMany('App\Models\Venues\Venue');
    }

    public function venueBookings()
    {
        return $this->hasMany('App\Models\Venues\VenueBooking');
    }
}
