<?php

namespace App\Http\Controllers;


use App\Models\Users;
use Illuminate\Http\Request;

class TestController extends Controller
{
    //
    public function test(){

       $res = Users::find(1)->articles;
        //$res = Users::getK();
       var_dump($res->toArray());
    }
}
