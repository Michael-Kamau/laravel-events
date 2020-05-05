<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Events\Event;
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
        $events = Event::userEvents(Auth::id())->get();
        return EventResource::collection($events);

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
        $charges = $request->input('regular');

//        dd($request->input('regular'));
        Event::create([
            'user_id' => $user_id,
            'name' => $event,
            'event_category_id' => $event_category_id,
            'location' => $location,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'charges' => $charges
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
     * @param \App\Events\Event $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
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
}
