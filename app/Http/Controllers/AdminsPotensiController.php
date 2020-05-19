<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminsPotensiController extends Controller
{
    public function index()
    {
        return view('admin.potensi.index');
    }
}
