<?php

namespace App\Models\Artists;

use App\Models\Status;
use Illuminate\Database\Eloquent\Model;

class ArtistBooking extends Model
{
    protected $guarded=[];

    public function artist()
    {
        return $this->belongsTo(Artist::class, 'artist_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function scopeUserArtistBookings($query,$event)
    {
        return $query->where([
            'artist_id'=>$event
        ]);
    }
}
