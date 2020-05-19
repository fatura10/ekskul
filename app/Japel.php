<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;
use Session;

class Japel extends Model
{

    protected $table = "tb_jad";
    public $timestamps = false;
    public static function generateId ()
    {
      $number = date('ymd').sprintf('%04s',mt_rand(0, 9999));
      if (self::where('id_jadwal',$number)->exists()) {
          return generateId();
      }
      return $number;
    }

    public static function validateForm($data)
    {
      $formValidate = [
        "id_ekskul"=>'required',
        "starting_hour"=>'required',
        "finishing_hour"=>'required',
        "hari"=>'required'
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
        $data["id_jadwal"]=self::generateId();
        $data["created_dt"]=date("Y-m-d H:i:s");
        $data["created_user"]=SESSION::get('userData')['userData']['user_id'];
        //dd(self::insert($data));
        if ($data['finishing_hour']<$data['starting_hour']) {
          return ["error"=>"003","message"=>"Jam Mulai Tidak Boleh Lebih Besar dari Jam Berakhir"];
        }
        $queryExist = "SELECT * FROM tb_jad WHERE hari='Senin' AND '".$data['starting_hour']."' BETWEEN starting_hour AND finishing_hour";
        if(collect(\DB::select($queryExist))->count()>0){
          return ["error"=>"004","message"=>"Jadwal Sudah Tersedia"];
        }
        if (self::insert($data)) {
          return ["error"=>false,"message"=>"Tambah Jadwal Pelajaran Berhasil"];
        }
        return ["error"=>"001","message"=>"Tambah Jadwal Pelajaran Gagal"];
      }
      return ["error"=>"002","message"=>"Field ada yang kosong"];
    }

    public static function updateData($data,$id)
    {
      if (self::validateForm($data)) {
        $data["updated_dt"]=date("Y-m-d H:i:s");
        $data["updated_user"]=SESSION::get('userData')['userData']['user_id'];
        //dd(self::insert($data));
        if (self::where('id_jadwal',$id)->update($data)) {
          return ["error"=>false,"message"=>"Edit Jadwal Pelajaran Berhasil"];
        }
        return ["error"=>"001","message"=>"Edit Jadwal Pelajaran Gagal"];
      }
      return ["error"=>"001","message"=>"Field ada yang kosong"];
    }
}
