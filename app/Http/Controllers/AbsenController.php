<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Absen;
use Illuminate\Support\Facades\DB;

class AbsenController extends Controller
{
    public function absenIn(Request $req)
    {
      $data=[
        "id_siswa"=>$req->id_siswa,
        "id_pel"=>$req->id_pel,
        "id_jadwal"=>$req->id_jadwal,
      ];
      return Absen::insertData($data);
    }

    public function absenOut (Request $req)
    {
      return Absen::updateData(["status"=>($req->status==0?1:0)],$req->input('id_absen'));
    }
}
