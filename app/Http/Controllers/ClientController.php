<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Club;

class ClientController extends Controller
{
    public function clubs()
    {
        $clubs = Club::all();
        $data = array(
            'clubs' => $clubs
        );
        return view('home')->with($data);
    }

    public function club_show($id)
    {
        $club = club::find($id);
        $data = array(
            'club' => $club
        );
        return view('club-show')->with($data);
    }
}
