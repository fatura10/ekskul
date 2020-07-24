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
          "nilai"=>($req->nilai[$i]==null?0:$req->nilai[$i]),
          "id_ekskul"=>$req->id_jadwal
        ];
        print_r($dataInsert);
        if (!Nilai::insertData($dataInsert)['error']) {
          $insertVal = $insertVal+1;
        }
      }
      if ($insertVal==count($req->nilai)) {
        return redirect()->back()->with(["error"=>false,"message"=>"Tambah Nilai Berhasil"]);
      }
      return redirect()->back()->with(["error"=>"001","message"=>"Tambah Nilai Gagal"]);
    }
    public function reportNilai (Request $req)
    {
      $queryEkskul = "SELECT DATE_FORMAT(DATE,'%d %M %Y') tglLatihan,DATE tglLatihan2, c.`nama`,b.`starting_hour`, b.`finishing_hour`,b.`hari`,b.`id_jadwal`,b.id_ekskul
        FROM tb_absen a
        JOIN tb_jad b ON a.`id_jadwal` = b.`id_jadwal`
        JOIN tb_ekskul c ON b.`id_ekskul` = c.`id_ekskul`
        GROUP BY DATE,c.`nama`,b.`starting_hour`,b.`finishing_hour`,b.`hari`,b.`id_jadwal`,b.`id_ekskul`";
        $dataEkskul =  DB::select($queryEkskul);
        $listEkskul = Ekskul::get();
      return view('page.reportNilai',compact('dataEkskul','listEkskul'));
    }
}
