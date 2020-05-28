<?php

namespace App\Events;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //
    protected $fillable = ['user_id', 'name', 'event_category_id', 'location', 'start_date', 'end_date', 'vvip','vip','regular','image'];

    public function users()
    {
        return $this->belongsTo('App\User');
    }

    public function bookings()
    {
        return $this->hasMany(EventBooking::class,'event_id');
    }


    public function scopeUserEvents($query, $user)
    {
        return $query->where([
            'user_id'=>$user
        ]);
    }
}
