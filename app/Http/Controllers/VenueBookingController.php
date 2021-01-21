<?php

namespace App\Http\Controllers;

use App\Mail\Events\EventBookingsMail;
use App\Mail\Venues\VenueEnquiryMail;
use App\Models\Events\Event;
use App\Models\Events\EventBooking;
use App\Models\Venues\Venue;
use App\Models\Venues\VenueBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class VenueBookingController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function bookVenue(Request $request)
    {

//        dd($request);

        $venueId = $request->input('id');
        $amount = $request->input('amount');
        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $description = $request->input('description');
        $book_date = $request->input('book_date');


        $venue = Venue::where('id', $venueId)->first();


        // Create an instruction for the booking on the table

        // Notify the event owner that there's a booking awaiting their confirmation


        $booking = VenueBooking::create([
            'venue_id' => $venue->id,
            'payment_id' => 12,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'contact' => $phone,
            'amount' => $amount,
            'status' => 4,
            'description' => $description,
            'book_date' => $book_date
        ]);


        Mail::to($venue->user->email)->send(new VenueEnquiryMail($venue->user, $booking));


    }


    public function mailVenueBookingPdf($venueId)
    {


        $bookings = VenueBooking::userVenueBookings($venueId)
            ->latest()
            ->get()
            ->map(function ($booking) {
                return [
                    'id' => $booking->id,
                    'name' => $booking->firstname . " " . $booking->lastname,
                    'email' => $booking->email,
                    'type' => $booking->type,
                    'number' => $booking->number,
                    'amount' => $booking->amount
                ];
            });

        Mail::to('email@email.com')->send(new VenueEnquiryMail('this is the parameter'));


    }

}
