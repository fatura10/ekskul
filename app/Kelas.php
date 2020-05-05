<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;
use Session;

class Kelas extends Model
{
  protected $table = "tb_kelas";
  public $timestamps = false;
  public static function generateId ()
  {
    $number = date('ymd').sprintf('%04s',mt_rand(0, 9999));
    if (self::where('id_kelas',$number)->exists()) {
        return generateId();
    }
    return $number;
  }

  public static function validateForm($data)
  {
    $formValidate = [
      'nama' => 'required',
      'kapasitas' => 'required',
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
      $data["id_kelas"]=self::generateId();
      $data["created_dt"]=date("Y-m-d H:i:s");
      $data["created_user"]=SESSION::get('userData')['userData']['user_id'];
      //dd(self::insert($data));
      if (self::insert($data)) {
        return ["error"=>false,"message"=>"Tambah Kelas Berhasil"];
      }
      return ["error"=>"001","message"=>"Tambah Kelas Gagal"];
    }
    return ["error"=>"001","message"=>"Field ada yang kosong"];
  }

  public static function updateData($data,$id)
  {
    if (self::validateForm($data)) {
      $data["updated_dt"]=date("Y-m-d H:i:s");
      $data["updated_user"]=SESSION::get('userData')['userData']['id'];
      //dd(self::insert($data));
      if (self::where('id_kelas',$id)->update($data)) {
        return ["error"=>false,"message"=>"Edit Kelas Berhasil"];
      }
      return ["error"=>"001","message"=>"Edit Kelas Gagal"];
    }
    return ["error"=>"001","message"=>"Field ada yang kosong"];
  }
}
