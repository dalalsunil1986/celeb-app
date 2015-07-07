<?php

namespace App\Http\Controllers;

use App\Src\Album\AlbumRepository;
use App\Src\Track\TrackRepository;
use Illuminate\Support\Facades\Auth;
use Vinkla\Instagram\InstagramManager;

class HomeController extends Controller
{

    public function dashboard()
    {
        if (Auth::check()) {
            return '<a href="/admin">Admin Panel</a>';
        }

        return '<h1> Welcome </h1>';

    }

}
