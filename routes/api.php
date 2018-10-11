<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    dd(123);
    return $request->user();
});

Route::group(['middleware' => ['api'], 'namespace' => 'Channels'], function () {

});

Route::group(['middleware' => ['api']], function () {
    Route::get('test', 'TestController@test');
});

Route::get('import', 'ExcelController@import');

Route::get('test1', 'ExcelController@test');

Route::get('test_1', 'TestController@test_1');