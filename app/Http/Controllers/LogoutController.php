<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout(){
        session()->pull('user');
        Auth::logout();
        return redirect()->route('jet-filter.index');
    }
}
