<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kelas;

class KelasController extends Controller
{
    public function index()
    {
      $dataKelas = Kelas::get();
      return view('page.kelas',compact('dataKelas'));
    }
    public function tambahKelas(Request $req)
    {
      //dd($req->all());
      $data = [
        'nama' => $req->jenjang."-".$req->kelas,
        'kapasitas' => $req->kapasitas,
        'proyektor' => $req->proyektor,
        'papan_tulis' => $req->papan_tulis,
        'ac' => $req->ac,
        'sound_system' => $req->sound_system,
        'komputer' => $req->komputer,
      ];
      //dd(Siswa::insertData($data));
        return redirect()->back()->with(Kelas::insertData($data));
    }
    public function editKelas(Request $req)
    {
      $data = [
        'nama' => $req->jenjang."-".$req->kelas,
        'kapasitas' => $req->kapasitas,
        'proyektor' => $req->proyektor,
        'papan_tulis' => $req->papan_tulis,
        'ac' => $req->ac,
        'sound_system' => $req->sound_system,
        'komputer' => $req->komputer,
      ];
      return redirect()->back()->with(Kelas::updateData($data,$req->id_kelas));
    }
    public function getDetail(Request $req)
    {
      return response()->json(Kelas::where('id_kelas',$req->input('id_kelas'))->first());
    }
}
