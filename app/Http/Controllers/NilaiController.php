<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Nilai;

class NilaiController extends Controller
{
    public function saveNilai(Request $req)
    {
      $insertVal=0;
      for ($i=0; $i < count($req->nilai); $i++) {
        $dataInsert = [
          "id_siswa"=>$req->id_siswa[$i],
          "id_nilai"=>($req->nilai[$i]==null?0:$req->nilai[$i]),
          "id_jadwa"=>$req->id_jadwal
        ];
        print_r($dataInsert);
        if (!Nilai::insertData($dataInsert)['error']) {
          $insertVal = $insertVal+1;
        }
      }
      if ($insertVal==count($req->nilai)) {
        //return redirect()->back()->with(["error"=>false,"message"=>"Tambah Nilai Berhasil"]);
      }
      //return redirect()->back()->with(["error"=>"001","message"=>"Tambah Nilai Gagal"]);
    }
}
