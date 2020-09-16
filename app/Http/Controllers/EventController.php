<?php

namespace App\Http\Controllers;

use App\Models\Events\EventBooking;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\Events\Event;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Http\Resources\Events\Event as EventResource;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::all();
        return EventResource::collection($events);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function userEvents()
    {

        $events = Event::userEvents(Auth::id())
            ->latest()
            ->get()
            ->map(function ($event) {
                return [
                    'id' => $event->id,
                    'name' => $event->name,
                    'vvip' => $event->vvip,
                    'vip' => $event->vip,
                    'regular' => $event->regular,
                    'location' => $event->location,
                    'image' => $event->image,
                    'start_date' => $event->start_date,
                    'end_date' => $event->end_date,
                    'bookings' => EventBooking::userEventBookings($event->id)
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
                        }),
                    'vvipBookings' => $event->bookings->where('type', 'vvip')->sum('number'),
                    'vipBookings' => $event->bookings->where('type', 'vip')->sum('number'),
                    'regularBookings' => $event->bookings->where('type', 'regular')->sum('number'),
                    'paid' => $event->bookings->sum('amount')
                ];
            });


        return response()->json([
            'data' => $events,
            'status' => 200
        ]);

//        $events = Event::userEvents(Auth::id())->get();
//        return EventResource::collection($events);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $event = $request->input('event');
        $user_id = Auth::id();
        $event_category_id = 1;
        $location = $request->input('location');
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $vvip = $request->input('vvip');
        $vip = $request->input('vip');
        $regular = $request->input('regular');
        $image = $this->saveImage($request->input('image'));

//        dd($image);
//        dd($request->input('regular'));
        Event::create([
            'user_id' => $user_id,
            'name' => $event,
            'event_category_id' => $event_category_id,
            'location' => $location,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'vvip' => $vvip,
            'vip' => $vip,
            'regular' => $regular,
            'image' => $image
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Events\Event $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {

//        dd($request);
        $eventId = $request->input('id');
        $name = $request->input('name');
        $location = $request->input('location');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $vvip = $request->input('vvip');
        $vip = $request->input('vip');
        $regular = $request->input('regular');

        $event = Event::where('id', $eventId)->first();

        if ($event->user_id == Auth::id()) {
            $event->name = $name;
            $event->location = $location;
            $event->start_date = $startDate;
            $event->end_date = $endDate;
            $event->vvip = $vvip;
            $event->vip = $vip;
            $event->regular = $regular;

            $event->save();
        }


    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Events\Event $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Events\Event $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }


    /**
     * delete a particular event
     *
     * @param $id
     * @return void
     */
    public function delete($id)
    {

        $event = Event::where('id', $id)->first();
        if ($event->user_id == Auth::id()) {
            File::delete($event->image);

            $event->delete();
        }


    }


    function saveImage($imageString)
    {
        $exploded = explode(',', $imageString);

        $decoded = base64_decode($exploded[1]);
        if ($this->str_contains($exploded[0], 'jpeg'))
            $extension = 'jpg';
        else
            $extension = 'png';
        $filename = Str::random(16) . '.' . $extension;

        $path = public_path() . '/' . $filename;

//        dd($path);

        file_put_contents($path, $decoded);

        return $filename;
    }

    function str_contains(string $haystack, string $needle): bool
    {
        return '' === $needle || false !== strpos($haystack, $needle);
    }

}
