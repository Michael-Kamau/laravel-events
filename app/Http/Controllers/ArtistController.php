<?php

namespace App\Http\Controllers;

use App\Models\Artists\Artist;
use Illuminate\Http\Request;

class ArtistController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $artists = Artist::all();

        return response()->json([
            'data' => $artists,
            'status' => 200
        ]);
    }

}
