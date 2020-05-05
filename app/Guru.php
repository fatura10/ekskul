<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;
use Session;
use App\User;
use Illuminate\Support\Facades\Hash;

class Guru extends Model
{
  protected $table = "tb_guru";
  public $timestamps = false;
  public static function generateId ()
  {
    $number = date('ymd').sprintf('%04s',mt_rand(0, 9999));
    if (self::where('id_guru',$number)->exists()) {
        return generateId();
    }
    return $number;
  }

  public static function validateForm($data)
  {
    $formValidate = [
      'nama_guru' => 'required',
      'nip' => 'required',
      'jns_kel' => 'required',
      'alamat' => 'required',
      'id_provinsi' => 'required',
      'id_kota' => 'required',
      'kode_pos' => 'required',
      'telepon' => 'required',
      'tempat_lahir' => 'required',
      'tgl_lahir' => 'required',
      'agama' => 'required',
      'email' => 'required',
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
      $data["id_guru"]=self::generateId();
      $data["created_dt"]=date("Y-m-d H:i:s");
      $data["created_user"]=SESSION::get('userData')['userData']['user_id'];
      //dd(self::insert($data));
      if (self::insert($data)) {
        $dataUser = [
          "id_user"=>$data["id_guru"],
          "emailVal"=>$data['email'],
          "password"=> Hash::make($data['nip']),
          "levelId"=>2
        ];
        User::insertData($dataUser);
        return ["error"=>false,"message"=>"Tambah Guru Berhasil"];
      }
      return ["error"=>"001","message"=>"Tambah Guru Gagal"];
    }
    return ["error"=>"002","message"=>"Field ada yang kosong"];
  }

  public static function updateData($data,$id)
  {
    if (self::validateForm($data)) {
      $data["updated_dt"]=date("Y-m-d H:i:s");
      $data["updated_user"]=SESSION::get('userData')['userData']['id'];
      //dd(self::insert($data));
      if (self::where('id_guru',$id)->update($data)) {
        return ["error"=>false,"message"=>"Edit Guru Berhasil"];
      }
      return ["error"=>"001","message"=>"Edit Guru Gagal"];
    }
    return ["error"=>"001","message"=>"Field ada yang kosong"];
  }
}
