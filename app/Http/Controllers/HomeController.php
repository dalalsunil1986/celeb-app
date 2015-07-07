<?php

namespace App\Http\Controllers;

use App\Src\Album\AlbumRepository;
use App\Src\Track\TrackRepository;
use Vinkla\Instagram\InstagramManager;

class HomeController extends Controller
{

    public function dashboard()
    {
        return '<h1> Welcome </h1>';
    }

}
