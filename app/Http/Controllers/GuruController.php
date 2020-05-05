<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Guru;
use App\Provinsi;
use App\Kota;
use App\Japel;
use Session;
use App\Http\Controllers\AbsenController;
use Illuminate\Support\Facades\DB;

class GuruController extends Controller
{
    public function guruData($idGuru=null)
    {
      $dataProvinsi=Provinsi::get();
      if ($idGuru!=null) {
        $dataKota = Kota::get();
        $dataGuru = Guru::select('tb_guru.*')
                    ->where('tb_guru.id_guru',$idGuru)
                    ->first();
        return compact('dataGuru','dataKota');
      }
      $dataGuru = Guru::select('a.nama as prov_nm','b.nama as kota_nm','tb_guru.*')
                  ->join('provinsi as a','a.id_provinsi','tb_guru.id_provinsi')
                  ->join('kota as b','b.id_kota','tb_guru.id_kota')
                  ->get();

      return compact('dataGuru','dataProvinsi');
    }
    public function getList(Request $req)
    {
      $dataEkskul = Guru::where('nama_guru', 'like', $req->input('nama').'%')->get();
      return response()->json($dataEkskul);
    }
    public function index()
    {
      return view('page.guru',$this->guruData());
    }

    public function tambahGuru(Request $req)
    {
      $data = [
        'nama_guru' => $req->nama_guru,
        'nip' => $req->nip,
        'jns_kel' => $req->jns_kel,
        'alamat' => $req->alamat,
        'id_provinsi' => $req->id_provinsi,
        'id_kota' => $req->id_kota,
        'kode_pos' => $req->kode_pos,
        'telepon' => $req->telepon,
        'tempat_lahir' => $req->tempat_lahir,
        'tgl_lahir' => $req->tgl_lahir,
        'agama' => $req->agama,
        'email' => $req->email,
      ];
      return redirect()->back()->with(Guru::insertData($data));
    }
    public function editGuru(Request $req)
    {
      $data = [
        'nama_guru' => $req->nama_guru,
        'nip' => $req->nip,
        'jns_kel' => $req->jns_kel,
        'alamat' => $req->alamat,
        'id_provinsi' => $req->id_provinsi,
        'id_kota' => $req->id_kota,
        'kode_pos' => $req->kode_pos,
        'telepon' => $req->telepon,
        'tempat_lahir' => $req->tempat_lahir,
        'tgl_lahir' => $req->tgl_lahir,
        'agama' => $req->agama,
        'email' => $req->email,
      ];

      return redirect()->back()->with(Guru::updateData($data,$req->id_guru));
    }
    public function getDetail(Request $req)
    {
      return response()->json($this->guruData($req->input('id_guru')));
    }
    public function indexGuru()
    {
      $id_guru = SESSION::get('userData')['userData']['user_id'];

      $query = "SELECT a.`id_jadwal`,a.`id_mapel`,a.id_guru,e.`id_absen`,a.`jam`, a.hari,b.`nama_guru`,c.`mapel`,d.`nama`,
                TIME (SUBTIME (TIME(NOW()),TIME(e.`absen_in`))) absen_in,TIME(e.`absen_out`)absen_out ,
                a.`starting_hour`, a.`finishing_hour`,DATE_FORMAT(NOW(),'%d %M %Y') AS datenow,g.`poin`
                FROM tb_japel a
                JOIN tb_guru b ON a.`id_guru`=b.`id_guru`
                JOIN tb_mapel c ON c.`id_mapel` = a.`id_mapel`
                JOIN tb_kelas d ON d.`id_kelas` = a.`id_kelas`
                LEFT JOIN tb_absen e ON e.`id_jadwal`=a.`id_jadwal`
                LEFT JOIN tb_poin g ON g.`id_absen` = e.`id_absen`
                JOIN tb_hari f ON f.`nama` = a.`hari`
                WHERE f.`id_hari`=DAYOFWEEK(NOW()) AND DATE_FORMAT(NOW(), '%H:%i:%s')  BETWEEN a.`starting_hour`
                AND a.`finishing_hour` AND a.`id_guru`=$id_guru and ISNULL(e.absen_out)=1";
      $absenData = collect(\DB::select($query))->first();
      //WHERE f.`id_hari`=DAYOFWEEK('2019-12-30') AND DATE_FORMAT('2019-12-30 09:00:00', '%H:%i:%s')  BETWEEN a.`starting_hour`
      //dd($absenData);
      $dataJapel = Japel::select("a.nama_guru","b.nama","c.mapel","tb_japel.*","d.nama_guru")
                          ->join('tb_guru as a','a.id_guru','tb_japel.id_guru')
                          ->join('tb_kelas as b','b.id_kelas','tb_japel.id_kelas')
                          ->join('tb_mapel as c','c.id_mapel','tb_japel.id_mapel')
                          ->join('tb_guru as d','d.id_guru','tb_japel.id_guru')
                          ->where('tb_japel.id_guru',$id_guru)
                          ->get();
      $AbsenController = new AbsenController();
      $dataAbsen = $AbsenController->getDataAbsen(["id_guru"=>$id_guru]);
      return view('page.absenGuru',compact('absenData','dataJapel','dataAbsen'));
    }
}
