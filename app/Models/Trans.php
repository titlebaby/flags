<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trans extends Model
{
    //
    public static function findData($id_num) {
       return  self::where(['id'=>$id_num])->first();
    }
}
