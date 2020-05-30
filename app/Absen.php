<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;
use DateTime;
use App\Poin;

class Absen extends Model
{
  protected $table = 'tb_absen';
  public $timestamps = false;
  public static function generateId ()
  {
    $number = date('ymd').sprintf('%04s',mt_rand(0, 9999));
    if (self::where('id_absen',$number)->exists()) {
        return generateId();
    }
    return $number;
  }

  public static function time_to_decimal($time) {
      $timeArr = explode(':', $time);
      $decTime = ($timeArr[0]*60) + ($timeArr[1]) + ($timeArr[2]/60);

      return $decTime;
  }

  public static function validateForm($data)
  {
    $formValidate = [
      'id_siswa' => 'required',
      'id_guru' => 'required',
      'id_jadwal' => 'required',
    ];
    $validator = Validator::make($data,$formValidate );

    if ($validator->fails()) {
      return false;
    }
    return true;
  }

  public static function insertData($data,$starting)
  {
    if (self::validateForm($data)) {
      $data["id_absen"]=self::generateId();
      $data["absen_in"]=date("Y-m-d H:i:s");
      $data["date"]=date("Y-m-d");
      $data["created_dt"]=date("Y-m-d H:i:s");
      //dd(self::insert($data));
      if (self::insert($data)) {
        return ["error"=>false,"message"=>"Simpan Absen Berhasil","params"=>["id_absen"=>$data["id_absen"],"poin"=>$poin]];
      }
      return ["error"=>"001","message"=>"Simpan Absen Gagal"];
    }
    return ["error"=>"002","message"=>"Field ada yang kosong"];
  }

  public static function updateData($data,$id)
  {
    //if (self::validateForm($data)) {
      //dd(self::insert($data));
      if (self::where('id_absen',$id)->update($data)) {
        return ["error"=>false,"message"=>"Edit Guru Berhasil"];
      }
      return ["error"=>"001","message"=>"Edit Guru Gagal"];
    //}
    //return ["error"=>"001","message"=>"Field ada yang kosong"];
  }
}
