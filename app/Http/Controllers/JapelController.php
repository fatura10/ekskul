<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mapel;
use App\Kelas;
use App\Guru;
use App\Japel;

class JapelController extends Controller
{
  public $jam = [
    ["start"=>"08:00:00","end"=>"09:00:00"],
    ["start"=>"09:00:00","end"=>"10:00:00"],
    ["start"=>"10:00:00","end"=>"11:00:00"],
    ["start"=>"11:00:00","end"=>"12:00:00"],
    ["start"=>"13:00:00","end"=>"14:00:00"],
    ["start"=>"14:00:00","end"=>"15:00:00"]
  ];
    public function index()
    {
      $dataKelas = Kelas::get();
      $dataMapel = Mapel::get();
      $dataGuru = Guru::get();
      $dataJapel = Japel::select("a.nama_guru","b.nama","c.mapel","tb_japel.*","d.nama_guru")
                          ->join('tb_guru as a','a.id_guru','tb_japel.id_guru')
                          ->join('tb_kelas as b','b.id_kelas','tb_japel.id_kelas')
                          ->join('tb_mapel as c','c.id_mapel','tb_japel.id_mapel')
                          ->join('tb_guru as d','d.id_guru','tb_japel.id_guru')
                          ->get();
      return view('page.jadwalPelajaran',compact('dataMapel','dataKelas','dataGuru','dataJapel'));
    }

    public function tambahJadwal(Request $req)
    {
      $data = [
        "id_ekskul"=>$req->id_ekskul,
        "starting_hour"=>$req->starting_hour,
        "finishing_hour"=>$req->finishing_hour,
        "hari"=>$req->hari
      ];
      return redirect()->back()->with(Japel::insertData($data));
    }

    public function getDetail(Request $req)
    {
      $dataJapel = Japel::select('b.nama','tb_japel.*')->where('id_jadwal',$req->id_jadwal)
                   ->join('tb_kelas as b','b.id_kelas','tb_japel.id_kelas')
                   ->first();
      return response()->json($dataJapel);
    }

    public function editJapel(Request $req)
    {

      $explode = explode('|',$req->id_kelas);
      $data = [
        "id_mapel"=>$req->id_mapel,
        "id_guru"=>$req->id_guru,
        "id_kelas"=>$explode[0],
        "jurusan"=>explode("-",$explode[1])[1],
        "jenjang"=>explode("-",$explode[1])[0],
        "starting_hour"=>$this->jam[$req->jam]['start'],
        "finishing_hour"=>$this->jam[$req->jam]['end'],
        "hari"=>$req->hari
      ];
      return redirect()->back()->with(Japel::updateData($data,$req->id_jadwal));
    }
}
