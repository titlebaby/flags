<?php

namespace App\Http\Controllers;


use App\Models\Articles;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    //
    public function test(Request $request){
$num = $request->get('num');

      // $order = Users::find(1)->articles;
//        $order = Articles::updateData();
        DB::beginTransaction();
        $res = Users::getK1(90);

        $aa = [10,20];
        $ee = array_rand($aa,1);
        var_dump($num);
        $res->user_number -=$num;
        var_dump($res->save());
//        $order->article_label="test1234";
//        $order->save();

        //$res = Users::getK();
        DB::commit();
        var_dump($res->toArray());
    }

    public function test_1(){
        DB::beginTransaction();
        $res = Users::getK1(31);

        $res->user_number -=20;
        var_dump($res->save());
        //$res = Users::getK();
        DB::commit();

    }
}
