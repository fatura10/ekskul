<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Nilai;

class NilaiController extends Controller
{
    public function saveNilai(Request $req)
    {
      dd($req->all());
    }
}
