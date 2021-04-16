<?php

namespace App\Http\Controllers;

use App\Models\Artists\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ArtistController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $artists = Artist::all()->map(function($artist){
        return[
            'id' => $artist->id,
            'name' => $artist->name,
            'description' =>$artist->description,
            'image'=>$artist->image,
            'genres' =>  $artist->genres->map(function($genre){
                return[
                    'id' => $genre->id,
                    'name' => $genre->name
                ];
            }),
            'videos' =>  $artist->videos->map(function($video){
                return[
                    'url' => $video->url,
                    'id' =>$video->id
                ];
            }),
        ];
    });

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
        $data = [
            'id' => $artist->id,
            'name' => $artist->name,
            'description' =>$artist->description,
            'image'=>$artist->image,
            'genres' =>  $artist->genres->map(function($genre){
                return[
                    'id' => $genre->id,
                    'name' => $genre->name
                ];
            }),
            'videos' =>  $artist->videos->map(function($video){
                return[
                    'url' => $video->url,
                    'id' =>$video->id
                ];
            }),
        ];

        return response()->json([
            'data' => $data,
            'status' => 200
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $artistId = $request->input('id');
        $name = $request->input('name');
        $description = $request->input('description');
        $genres = $request->input('genres');


        $artist = Artist::where('id', $artistId)->first();

        if ($artist->user->id == Auth::id()) {
            $artist->name = $name;
            $artist->description = $description;

            $artist->genres()->sync($genres);

            $artist->save();
        }


        return response()->json([
            'status' => 200
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function editImage(Request $request)
    {
        $artistId = $request->input('id');
        $image = $request->input('image');

        $artist = Artist::where('id', $artistId)->first();


        if ($artist->user->id == Auth::id()) {
            File::delete('images/artistImages/'.$artist->image);
            $artist->image = $this->saveImage($image);
            $artist->save();
        }


        return response()->json([
            'status' => 200
        ]);
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

        $path = public_path() . '/images/artistImages/' . $filename;

//        dd($path);

        file_put_contents($path, $decoded);

        return $filename;
    }

    function str_contains(string $haystack, string $needle): bool
    {
        return '' === $needle || false !== strpos($haystack, $needle);
    }

}
