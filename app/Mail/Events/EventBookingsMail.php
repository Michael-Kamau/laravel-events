<?php

namespace App\Mail\Events;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EventBookingsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $eventBookings;

    /**
     * Create a new message instance.
     *
     * @param $eventBookings
     */
    public function __construct($eventBookings)
    {
        //
        $this->$eventBookings = $eventBookings;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.events.eventBookings');
    }
}
