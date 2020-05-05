<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;
use Session;


class Mapel extends Model
{
  protected $table = "tb_mapel";
  public $timestamps = false;
  public static function generateId ()
  {
    $number = date('ymd').sprintf('%04s',mt_rand(0, 9999));
    if (self::where('id_mapel',$number)->exists()) {
        return generateId();
    }
    return $number;
  }

  public static function validateForm($data)
  {
    $formValidate = [
      'mapel' => 'required',
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
      $data["id_mapel"]=self::generateId();
      $data["created_dt"]=date("Y-m-d H:i:s");
      $data["created_user"]=SESSION::get('userData')['userData']['user_id'];
      //dd(self::insert($data));
      if (self::insert($data)) {
        return ["error"=>false,"message"=>"Tambah Mata Pelajaran Berhasil"];
      }
      return ["error"=>"001","message"=>"Tambah Mata Pelajaran Gagal"];
    }
    return ["error"=>"002","message"=>"Field ada yang kosong"];
  }

  public static function updateData($data,$id)
  {
    if (self::validateForm($data)) {
      //dd(self::insert($data));
      if (self::where('id_mapel',$id)->update($data)) {
        return ["error"=>false,"message"=>"Edit Mata Pelajaran Berhasil"];
      }
      return ["error"=>"001","message"=>"Edit Mata Pelajaran Gagal"];
    }
    return ["error"=>"001","message"=>"Field ada yang kosong"];
  }
}
