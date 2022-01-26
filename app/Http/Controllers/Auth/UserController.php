<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function show()
    {
        $title = 'Profile user';
        $user = Auth::user();
        return view('user.show', compact(
            'title',
            'user'
        ));
    }
}
