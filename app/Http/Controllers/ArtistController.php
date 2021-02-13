<?php

namespace App\Http\Controllers;

use App\Models\Artists\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function artistProfile()
    {
        $artist = Auth::user()->artist;
//        dd(Auth::user()->artist);
        $data = [
            'name' => $artist->name,
            'description' =>$artist->description,
            'image'=>$artist->image,
            'videos' =>  $artist->videos->map(function($video){
                return[
                    'url' => $video->url
                ];
            }),
        ];

        return response()->json([
            'data' => $data,
            'status' => 200
        ]);
    }

}
