<?php

namespace App\Http\Controllers;

use App\Models\Terms\Term;
use App\User;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('terms');;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function userRoles()
    {

//        Auth::user()->addRole('event-manager');

//         dd(Auth::User()->Roles()->pluck('name'));


        return (Auth::User()->Roles()->pluck('name'));
    }

    /**
     * Show the application terms and conditions.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function terms()
    {
        $terms= Term::all();

        return response()->json([
            'data' => $terms,
            'status' => 200
        ]);
    }
}
