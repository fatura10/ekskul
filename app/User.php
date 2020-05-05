<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Validator;
use Session;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'tb_user';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function generateId ()
    {
      $number = date('ymd').sprintf('%04s',mt_rand(0, 9999));
      if (self::where('id_user',$number)->exists()) {
          return generateId();
      }
      return $number;
    }

    public static function validateForm($data)
    {
      $formValidate = [
        "emailVal"=>'required',
        "password"=>'required',
        "levelId"=>'required'
      ];
      $validator = Validator::make($data,$formValidate );

      if ($validator->fails()) {
        return false;
      }
      return true;
    }

    public static function insertData ($data)
    {
      if (self::validateForm($data)) {
        //$data["id_user"]=self::generateId();
        $data["created_dt"]=date("Y-m-d H:i:s");
        $data["created_user"]=SESSION::get('userData')['userData']['user_id'];
        //dd(self::insert($data));
        if (self::insert($data)) {
          return ["error"=>false,"message"=>"Tambah User Berhasil"];
        }
        return ["error"=>"001","message"=>"Tambah User Gagal"];
      }
      return ["error"=>"002","message"=>"Field ada yang kosong"];
      return User::create($data);
    }
}
