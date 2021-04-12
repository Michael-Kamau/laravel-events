<?php

namespace App\Http\Controllers;

use App\Models\Artists\Artist;
use App\Models\Videos\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $artist = Artist::findOrFail($request->input('artistId'));


        $artist->videos()->create([
            'url' => $request->input('video'),
            'description' => ''
        ]);

        return response()->json([
            'data' => 'created',
            'status' => 201
        ]);
    }


    /**
     * delete a video
     *
     * @param $id
     * @return void
     */

    public function delete($id)
    {
        $video = Video::findOrFail($id);

        $video->delete();

    }

}
