<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ekskul;
use App\Pelatih;
use App\Japel;
use App\Kelas;

class EkskulController extends Controller
{
    public function index()
    {
      $dataEkskul = Ekskul::get();
      return view('page.ekskul',compact('dataEkskul'));
    }

    public function detailEkskul(Request $req)
    {
      $dataEkskul = Ekskul::where('id_ekskul',$req->input('id_ekskul'))->first();
      $dataPelatih = Pelatih::select('a.nama_guru')->join('tb_guru as a','a.id_guru','tb_pel_ekskul.id_user')->get();
      $dataJadwal = Japel::where('id_ekskul',$req->input('id_ekskul'))->get();
      return view('page.detailEkskul',compact('dataEkskul','dataPelatih','dataJadwal'));
    }

    public function anggotaEkskul (Request $req)
    {
      $dataEkskul = Ekskul::where('id_ekskul',$req->input('id_ekskul'))->first();
      $dataKelas = Kelas::get();
      return view('page.anggotaEkskul',compact('dataEkskul','dataKelas'));
    }

    public function tambahPelatih(Request $req)
    {
      $data = [
        'id_user'=>$req->id_guru,
        'id_ekskul'=>$req->id_ekskul
      ];
      return redirect()->back()->with(Pelatih::insertData($data));
    }

    public function absenEkskul()
    {
      return view('page.absenEkskul');
    }

    public function nilaiEkskul()
    {
      return view('page.nilaiEkskul');
    }

    public function tambahEkskul(Request $req)
    {
      $data = [
        'nama' => $req->nama,
        'alamat' => $req->alamat,
        'tgl_gabung' => $req->tgl_gabung,
        'telepon' => $req->telepon
      ];
      //dd(Siswa::insertData($data));
        return redirect()->back()->with(Ekskul::insertData($data));
    }
}
