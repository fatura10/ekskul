<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;
use Session;

class Nilai extends Model
{
  protected $table = "tb_nilai";
  public $timestamps = false;
  public static function generateId ()
  {
    $number = date('ymd').sprintf('%04s',mt_rand(0, 9999));
    if (self::where('id_nilai',$number)->exists()) {
        return generateId();
    }
    return $number;
  }
  public static function validateForm($data)
  {
    $formValidate = [
        'nilai' => 'required',
        'id_siswa' => 'required',
        'id_jadwal' => 'required'
    ];
    $validator = Validator::make($data,$formValidate );

    if ($validator->fails()) {
      return false;
    }
    return true;
  }

  public static function insertData($data)
  {
    if (self::validateForm($data)) {
      $data["id"]=self::generateId();
      $data["created_dt"]=date("Y-m-d H:i:s");
      $data["created_user"]=SESSION::get('userData')['userData']['user_id'];
      //dd(self::insert($data));
      if (self::insert($data)) {
        return ["error"=>false,"message"=>"Tambah Siswa Berhasil"];
      }
      return ["error"=>"001","message"=>"Tambah Siswa Gagal"];
    }
    return ["error"=>"001","message"=>"Field ada yang kosong"];
  }
}
