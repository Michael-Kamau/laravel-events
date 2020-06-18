<?php

namespace App\Events;

use Illuminate\Database\Eloquent\Model;

class EventBooking extends Model
{

    protected $fillable=['event_id','payment_id','firstname','lastname','email','contact','type','number','amount'];


    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }


    public function scopeUserEventBookings($query,$event)
    {
        return $query->where([
            'event_id'=>$event
        ]);
    }
}
