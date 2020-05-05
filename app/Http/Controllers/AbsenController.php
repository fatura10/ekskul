<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Absen;
use Illuminate\Support\Facades\DB;

class AbsenController extends Controller
{
    public function index()
    {
      $dataAbsen = $this->getDataAbsen();
      return view('page.historyAbsen',compact('dataAbsen'));
    }

    public function getDataAbsen($params=null)
    {
      if (isset($params)) {
        $query="SELECT b.`hari`,b.`starting_hour`,b.`finishing_hour`,c.`nama_guru`,d.`mapel`, a.`id_absen`,a.`id_guru`,a.`id_jadwal`,
              TIME(a.`absen_in`) absen_in, TIME(a.`absen_out`) absen_out, a.`date`
              FROM tb_absen a
              JOIN tb_japel b ON a.`id_jadwal`=b.id_jadwal
              JOIN tb_guru c ON a.`id_guru` = c.`id_guru`
              JOIN tb_mapel d ON b.id_mapel = d.`id_mapel`";
              if (isset($params['startDate'])) {
                $query .= "where a.id_guru='".$params['id_guru']."' and date between '".$params['startDate']."' and '".$params['endDate']."' ";
              } else {
                $query .= "where a.id_guru='".$params['id_guru']."'";
              }
        return DB::select($query);
      }
      $query="SELECT b.`hari`,b.`starting_hour`,b.`finishing_hour`,c.`nama_guru`,d.`mapel`, a.`id_absen`,a.`id_guru`,a.`id_jadwal`,
            TIME(a.`absen_in`) absen_in, TIME(a.`absen_out`) absen_out, a.`date`
            FROM tb_absen a
            JOIN tb_japel b ON a.`id_jadwal`=b.id_jadwal
            JOIN tb_guru c ON a.`id_guru` = c.`id_guru`
            JOIN tb_mapel d ON b.id_mapel = d.`id_mapel`";
      return DB::select($query);
    }

    public function absenIn(Request $req)
    {
      $data=[
        "id_guru"=>$req->id_guru,
        "id_jadwal"=>$req->id_jadwal,
      ];
      return Absen::insertData($data,$req->starting_hour);
    }

    public function absenOut (Request $req)
    {
      return Absen::updateData(["absen_out"=>date("Y-m-d H:i:s")],$req->input('id_absen'));
    }
}
