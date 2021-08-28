<?php

namespace App\Models\Events;

use App\Models\Payments\Payment;
use Illuminate\Database\Eloquent\Model;

class EventBooking extends Model
{

    protected $fillable=['event_id','payment_id','firstname','lastname','email','contact','type','number','amount'];


    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function payment(){
        return $this->morphOne(Payment::class, 'paymentable');
    }


    public function scopeUserEventBookings($query,$event)
    {
        return $query->where([
            'event_id'=>$event
        ]);
    }
}
