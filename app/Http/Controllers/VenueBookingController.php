<?php

namespace App\Http\Controllers;

use App\Mail\Venues\VenueDetailsMail;
use App\Mail\Venues\VenueEnquiryMail;
use App\Models\Status;
use App\Models\Venues\Venue;
use App\Models\Venues\VenueBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use \App\Traits\Payments\DPOPayment;

class VenueBookingController extends Controller
{

    use DPOPayment;

    /**
     * Show the form for editing the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function bookVenue(Request $request)
    {

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
            'status_id' => 4,
            'description' => $description,
            'book_date' => $book_date,
            'code' => rand(99999, 10000000),
        ]);

        Mail::to($venue->user->email)->send(new VenueEnquiryMail($venue->user, $booking));

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function bookingActions(Request $request)
    {

        $bookingId = $request->input('id');
        $amount = $request->input('amount');
        $status = $request->input('status');

        if ($status == 'confirmed') {

            $status = Status::where('name', 'confirmed')->first();
        } else {
            $status = Status::where('name', 'rejected')->first();

        }


        $venueBooking = VenueBooking::where('id', $bookingId)->first();

        if ($venueBooking->venue->user->id == Auth::id()) {

            $venueBooking->amount = $amount;
            $venueBooking->status_id = $status->id;


            $venueBooking->save();

            Mail::to($venueBooking->email)->send(new VenueDetailsMail($venueBooking));

            return response()->json([
                'created' => true
            ]);

        } else {
            return response()->json([
                'error' => 'unauthenticated'
            ]);
        }

    }


    /**
     * Toggle status
     *
     * @param $id
     * @return void
     */
    public function venueBookings($id)
    {
        $venue = Venue::where('id', $id)->first();
        if ($venue->user_id == Auth::id()) {
            $venueBookings = VenueBooking::where('venue_id', $id)
                ->latest()
                ->get()
                ->map(function ($booking) {
                    return [
                        'id' => $booking->id,
                        'name' => $booking->firstname . ' ' . $booking->lastname,
                        'description' => $booking->description,
                        'date' => $booking->book_date,
                        'status' => $booking->status->name,
                    ];
                });

            return response()->json([
                'bookings' => $venueBookings,
                'status' => 201
            ]);

        } else {
            return response()->json([
                'error' => 'unauthenticated'
            ]);
        }

    }


    /**
     * Booking information
     *
     * @param $id
     * @param $code
     * @return void
     */
    public function bookingInformation($code, $id)
    {
        $booking = VenueBooking::where([
            ['id','=' ,$id],
            ['code', '=', $code]
        ])->first();
        if ($booking) {
            $bookingDetails = [
                'id' => $booking->id,
                'name' => $booking->firstname . ' ' . $booking->lastname,
                'amount' => $booking->amount,
                'venue' => [
                    'name' => $booking->venue->name,
                    'image' => $booking->venue->image,
                    'description' => $booking->venue->description,
                ],
                'date' => $booking->book_date,
                'status' => $booking->status->name,
            ];

            return response()->json([
                'booking' => $bookingDetails,
                'status' => 201
            ]);

        } else {
            return response()->json([
                'error' => 'ivalid'
            ]);
        }

    }

    /**
     * Booking information
     *
     * @param $id
     * @param $code
     * @return void
     */
    public function bookingPayment($code, $id)
    {
        $booking = VenueBooking::where([
            ['id','=' ,$id],
            ['code', '=', $code]
        ])->first();


        //Trait from DPOPayment
        $paymentResponse = $this->generateToken2($booking->amount, 'Venue Booking', $booking->venue_id, $booking);


        $booking->payment()->create([
            'token' => $paymentResponse['data']['TransToken'],
            'reference' => $paymentResponse['data']['TransRef'],
            'result' => $paymentResponse['data']['Result'],
            'result_explanation' => $paymentResponse['data']['ResultExplanation'],
            'amount' => $booking->amount,
            'status' => 4
        ]);

        return $paymentResponse;


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
