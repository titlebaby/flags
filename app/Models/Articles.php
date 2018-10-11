<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    //
    public static function updateData(){
        return  self::find(1);

    }

}
