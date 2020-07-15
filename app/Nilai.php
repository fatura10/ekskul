<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
