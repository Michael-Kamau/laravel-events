<?php

namespace App\Http\Controllers;

use App\Models\Artists\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArtistGenreController extends Controller
{
    //

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $genres = Genre::all();

        $genres = $genres->map(function($genre){
            return[
                'id' => $genre->id,
                'name' => $genre->name
            ];
        });

        return response()->json([
            'data' => $genres,
            'status' => 200
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $genre = $request->input('genre');

        Genre::create([
            'name' => $genre,
            'slug' => Str::slug($genre),
            'description' =>''
        ]);

        return response()->json([
            'status' => 200
        ]);
    }

}
