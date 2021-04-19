<?php

namespace App\Http\Controllers;

use App\Models\Artists\Artist;
use App\Models\Artists\ArtistBooking;
use Illuminate\Http\Request;

class ArtistBookingController extends Controller
{
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
            'book_date' => $book_date,
        ]);


//        Mail::to($artist->user->email)->send(new ArtistEnquiryMail($artist->user, $booking));


    }

}
