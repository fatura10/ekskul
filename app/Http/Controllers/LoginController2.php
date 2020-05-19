<?php

namespace App\Http\Controllers\Login;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
}
