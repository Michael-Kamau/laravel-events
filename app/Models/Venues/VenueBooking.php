<?php

namespace App\Models\Venues;

use App\Models\Status;
use Illuminate\Database\Eloquent\Model;

class VenueBooking extends Model
{
    protected $guarded=[];


    public function venue()
    {
        return $this->belongsTo(Venue::class, 'venue_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status');
    }


    public function scopeUserVenueBookings($query,$event)
    {
        return $query->where([
            'venue_id'=>$event
        ]);
    }
}
