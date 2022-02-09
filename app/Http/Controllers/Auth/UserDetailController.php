<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserDetailController extends Controller
{
    public function show()
    {
        $title = 'Profile saya';
        $user = Auth::user();
        return view('user.show', compact(
            'title',
            'user'
        ));
    }
}
