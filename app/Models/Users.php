<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    //
    public function articles(){
        return $this->hasMany(Articles::class,'user_id','id');
    }
    public static function getK(){
       return Articles::query();
    }
    public static function getK1($user_number){
        return self::where(['user_number'=>$user_number])->first();
    }
}
