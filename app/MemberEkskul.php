<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;
use Session;

class MemberEkskul extends Model
{
  protected $table = "tb_member_ekskul";
  public $timestamps = false;
  public static function generateId ()
  {
    $number = date('ymd').sprintf('%04s',mt_rand(0, 9999));
    if (self::where('id_member',$number)->exists()) {
        return generateId();
    }
    return $number;
  }

  public static function validateForm($data)
  {
    $formValidate = [
        'id_ekskul' => 'required',
        'id_siswa' => 'required',

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
      $data["id_member"]=self::generateId();
      $data["created_dt"]=date("Y-m-d H:i:s");
      $data["created_user"]=SESSION::get('userData')['userData']['user_id'];
      //dd(self::insert($data));
      if (self::insert($data)) {
        return ["error"=>false,"message"=>"Tambah Anggota Berhasil"];
      }
      return ["error"=>"001","message"=>"Tambah Anggota Gagal"];
    }
    return ["error"=>"001","message"=>"Field ada yang kosong"];
  }

  public static function updateData($data,$id)
  {
    if (self::validateForm($data)) {
      $data["updated_dt"]=date("Y-m-d H:i:s");
      $data["updated_user"]=SESSION::get('userData')['userData']['user_id'];
      //dd(self::insert($data));
      if (self::where('id',$id)->update($data)) {
        return ["error"=>false,"message"=>"Edit Anggota Berhasil"];
      }
      return ["error"=>"001","message"=>"Edit Anggota Gagal"];
    }
    return ["error"=>"001","message"=>"Field ada yang kosong"];
  }
}
