<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|

Route::get('/', function () {
    return view('welcome');
});
*/

//User
Route::get('/user/sign-up','App\Http\Controllers\UserAuthController@signUpPAge');
Route::post('/user/sign-up','App\Http\Controllers\UserAuthController@signUpProcess');
Route::get('/user/sign-in','App\Http\Controllers\UserAuthController@signInPAge');
Route::post('/user/sign-in','App\Http\Controllers\UserAuthController@signInProcess');
Route::get('/user/sign-out','App\Http\Controllers\UserAuthController@signOut');

//whrecord
Route::group(
    ['prefix'=>'whrecord'],function(){
        Route::get('/','App\Http\Controllers\WarehouwRecordController@statePage');
        Route::get('/merchandise','App\Http\Controllers\WarehouwRecordController@merchandisePage');
        Route::get('/restock','App\Http\Controllers\WarehouwRecordController@inPage');
        Route::post('/restock','App\Http\Controllers\WarehouwRecordController@inAddProcess');
        Route::post('/restock/restock-revision','App\Http\Controllers\WarehouwRecordController@inReAction');
        Route::post('/restock/revision','App\Http\Controllers\WarehouwRecordController@inReProcess');
        Route::post('/restock/delete','App\Http\Controllers\WarehouwRecordController@inDelProcess');
        Route::get('/shipment','App\Http\Controllers\WarehouwRecorDController@outPage');
        Route::post('/shipment','App\Http\Controllers\WarehouwRecorDController@outAddProcess');
    }
);