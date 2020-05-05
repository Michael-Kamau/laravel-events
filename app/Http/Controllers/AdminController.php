<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * get all the users for a particular account type.
     *
     * @param $type
     * @return void
     */
    public function getUsers($type)
    {
        $users = User::role($type)->get();

        return $users;
    }


}
