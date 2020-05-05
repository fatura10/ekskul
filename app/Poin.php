<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poin extends Model
{
  protected $table = 'tb_poin';
  public $timestamps = false;
  public static function generateId ()
  {
    $number = date('ymd').sprintf('%04s',mt_rand(0, 9999));
    if (self::where('id_poin',$number)->exists()) {
        return generateId();
    }
    return $number;
  }
}
