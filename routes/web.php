<?php

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
Route::get('/', function () {
    $title = "上传";
    return view('mabo0001',['title' => "上传"]);
});

//上传文件行为
Route::post('upload', 'UploadController@index');
#Auth::routes();

#Route::get('/home', 'HomeController@index');
#Route::get('/home', 'HomeController@index')->name('home');
