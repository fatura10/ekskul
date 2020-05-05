<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kota;

class KotaController extends Controller
{
    public function getKota(Request $req)
    {
      return response()->json(Kota::where('id_provinsi',$req->id_provinsi)->get());
    }
}
