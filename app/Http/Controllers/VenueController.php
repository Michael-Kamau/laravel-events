<?php

namespace App\Http\Controllers;

use App\Http\Resources\Events\Event as EventResource;
use App\Models\Events\Event;
use App\Models\Events\EventBooking;
use App\Models\Status;
use App\Models\Venues\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class VenueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $venues = Venue::whereHas('status', function ($query) {
            $query->where('name', 'active');
        })->get();
        return response()->json([
            'data' => $venues,
            'status' => 200
        ]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function userVenues()
    {

        $venues = Venue::userVenues(Auth::id())
            ->latest()
            ->get()
            ->map(function ($venue) {
                return [
                    'id' => $venue->id,
                    'name' => $venue->name,
                    'location' => $venue->location,
                    'description' => $venue->description,
                    'submitted' => $venue->bookings->where('status', 4)->count(),
                    'confirmed' => $venue->bookings->where('status', 3)->count(),
                    'completed' => $venue->bookings->where('status', 1)->count(),
                    'active' => $venue->status->name == 'active'
                ];
            });

        return response()->json([
            'data' => $venues,
            'status' => 200
        ]);


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
        $venue = $request->input('venue');
        $user_id = Auth::id();
        $venue_category_id = 1;
        $location = $request->input('location');
        $description = $request->input('description');
        $charges = $request->input('charges');
        $image = $this->saveImage($request->input('image'));

        Venue::create([
            'user_id' => $user_id,
            'name' => $venue,
            'venue_category_id' => $venue_category_id,
            'location' => $location,
            'description' => $description,
            'charges' => $charges,
            'image' => $image,
            'status' => 6
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Venues\Venue $venue
     * @return \Illuminate\Http\Response
     */
    public function show(Venue $venue)
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

        $venuetId = $request->input('id');
        $name = $request->input('name');
        $location = $request->input('location');
        $description = $request->input('description');
        $charges = $request->input('charges');

        $venue = Venue::where('id', $venuetId)->first();

        if ($venue->user_id == Auth::id()) {
            $venue->name = $name;
            $venue->location = $location;
            $venue->description = $description;
            $venue->charges = $charges;


            $venue->save();
        }


    }

    /**
     * delete a particular venue
     *
     * @param $id
     * @return void
     */
    public function toggleActive($id)
    {

        $venue = Venue::where('id', $id)->first();
        if ($venue->user_id == Auth::id()) {
            if ($venue->status->name == 'active') {
                $status = Status::where('name', 'inactive')->first();
                $venue->status_id = $status->id;
            } else {
                $status = Status::where('name', 'active')->first();
                $venue->status_id = $status->id;
            }

            $venue->save();

            return response()->json([
                'status' => 201
            ]);
        }


    }


    /**
     * delete a particular venue
     *
     * @param $id
     * @return void
     */
    public function delete($id)
    {

        $venue = Venue::where('id', $id)->first();
        if ($venue->user_id == Auth::id()) {
            File::delete($venue->image);

            $venue->delete();
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
