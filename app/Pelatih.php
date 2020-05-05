<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;
use Session;

class Pelatih extends Model
{
  protected $table = "tb_pel_ekskul";
  public $timestamps = false;
  public static function generateId ()
  {
    $number = date('ymd').sprintf('%04s',mt_rand(0, 9999));
    if (self::where('id_pel',$number)->exists()) {
        return generateId();
    }
    return $number;
  }
  public static function validateForm($data)
  {
    $formValidate = [
      'id_user' => 'required',
      'id_ekskul' => 'required',
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
      $data["id_pel"]=self::generateId();
      //dd(self::insert($data));
      if (self::insert($data)) {
        return ["error"=>false,"message"=>"Tambah Kelas Berhasil"];
      }
      return ["error"=>"001","message"=>"Tambah Kelas Gagal"];
    }
    return ["error"=>"001","message"=>"Field ada yang kosong"];
  }
}
