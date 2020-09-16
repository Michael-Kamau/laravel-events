<?php

namespace App\Http\Controllers;

use App\Models\Events\Event;
use App\Models\Events\EventBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\Events\EventBookingsMail;
use Illuminate\Support\Facades\Mail;

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

    public function mailEventBookingPdf($eventId){



        $bookings = EventBooking::userEventBookings($eventId)
            ->latest()
            ->get()
            ->map(function($booking){
                return[
                    'id'=>$booking->id,
                    'name'=>$booking->firstname." ". $booking->lastname,
                    'email'=>$booking->email,
                    'type'=>$booking->type,
                    'number'=>$booking->number,
                    'amount'=>$booking->amount
                ];
            });

        Mail::to('email@email.com')->send(new EventBookingsMail('this is the parameter'));

//        $events = Event::userEvents(Auth::id())
//            ->latest()
//            ->get()
//            ->map(function ($event) {
//                return [
//                    'id' => $event->id,
//                    'name' => $event->name,
//                    'vvip' => $event->vvip,
//                    'vip' => $event->vip,
//                    'regular' => $event->regular,
//                    'location' => $event->location,
//                    'image' => $event->image,
//                    'start_date' => $event->start_date,
//                    'end_date' => $event->end_date,
//
//                    'vvipBookings' => $event->bookings->where('type', 'vvip')->sum('number'),
//                    'vipBookings' => $event->bookings->where('type', 'vip')->sum('number'),
//                    'regularBookings' => $event->bookings->where('type', 'regular')->sum('number'),
//                    'paid' => $event->bookings->sum('amount')
//                ];
//            });
    }
}
