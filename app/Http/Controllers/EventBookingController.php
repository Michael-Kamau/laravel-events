<?php

namespace App\Http\Controllers;

use App\Events\Event;
use App\Events\EventBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventBookingController extends Controller
{


    /**
     * Show the form for editing the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function bookEvent(Request $request)
    {

//        dd($request);

        $eventId = $request->input('id');
        $ticketPrice = $request->input('ticketPrice');
        $ticketNumber = $request->input('ticketNo');
        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $email = $request->input('email');
        $phone = $request->input('phone');


        //Ensure all the fields are correctly filled


        //get the event price and type and compute total

        //send request to mobile for authentication


        //save the data to the table after successful completion

        //send the user a notification on email with the event booking details

//        $tota

        $event = Event::where('id', $eventId)->first();
        $ticketType = $this->ticketType($event, $ticketPrice);

        if (!$ticketType) {
            return null;
        }

        $totalAmount = (float)$ticketPrice * (float)$ticketNumber;


        EventBooking::create([
            'event_id' => $event->id,
            'payment_id' => 12,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'contact' => $phone,
            'type' => $ticketType,
            'number' => $ticketNumber,
            'amount'=>$totalAmount
        ]);


    }


    public function ticketType(Event $event, $amount)
    {
        if ((float)$event->vvip == (float)$amount) {
            return 'vvip';
        } else if ((float)$event->vip == (float)$amount) {
            return 'vip';

        } else if ((float)$event->regular == (float)$amount) {
            return 'regular';
        } else {
            return false;
        }
    }
}
