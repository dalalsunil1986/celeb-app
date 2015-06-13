<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get Authenticated Users Profile
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();

        // get the books uploaded by this user
        $books = $user->books()->with(['meta'])->get();

        return view('modules.user.profile', compact('user', 'books'));
    }
}
