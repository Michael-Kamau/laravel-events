<?php

namespace App\Http\Controllers;

use App\Mail\Artists\ArtistDetailsMail;
use App\Mail\Artists\ArtistEnquiryMail;
use App\Models\Artists\Artist;
use App\Models\Artists\ArtistBooking;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use \App\Traits\Payments\DPOPayment;

class ArtistBookingController extends Controller
{


    use DPOPayment;

    /**
     * Show the form for editing the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function bookArtist(Request $request)
    {

        $artistId = $request->input('id');
        $amount = 0;
        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $description = $request->input('description');
        $book_date = $request->input('book_date');


        $artist = Artist::where('id', $artistId)->first();


        // Create an instruction for the booking on the table

        // Notify the event owner that there's a booking awaiting their confirmation


        $booking = ArtistBooking::create([
            'artist_id' => $artist->id,
            'payment_id' => 12,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'contact' => $phone,
            'amount' => $amount,
            'status_id' => 4,
            'description' => $description,
            'code' => rand(99999, 10000000),
            'book_date' => $book_date,
        ]);


        Mail::to($artist->user->email)->send(new ArtistEnquiryMail($artist->user, $booking));

        return response()->json([
            'success' => true
        ]);


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


        $artistBooking = ArtistBooking::where('id', $bookingId)->first();

        if ($artistBooking->artist->user->id == Auth::id()) {

            $artistBooking->amount = $amount;
            $artistBooking->status_id = $status->id;


            $artistBooking->save();

            Mail::to($artistBooking->email)->send(new ArtistDetailsMail($artistBooking));

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
     * Booking information
     *
     * @param $id
     * @param $code
     * @return void
     */
    public function bookingInformation($code, $id)
    {
        $booking = ArtistBooking::where([
            ['id','=' ,$id],
            ['code', '=', $code]
        ])->first();
        if ($booking) {
            $bookingDetails = [
                'id' => $booking->id,
                'name' => $booking->firstname . ' ' . $booking->lastname,
                'artist' => [
                    'name' => $booking->artist->name,
                    'image' => $booking->artist->image,
                    'description' => $booking->artist->description,
                ],
                'amount' => $booking->amount,
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
        $booking = ArtistBooking::where([
            ['id','=' ,$id],
            ['code', '=', $code]
        ])->first();

        //Trait from DPOPayment
        $paymentResponse = $this->generateToken2($booking->amount, 'Artist Booking', $booking->artist_id, $booking);


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


}




