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
Route::post('uploadMobileMag', 'UploadController1@UploadMobieMag');
Route::post('uploadBaseMag',   'UploadController1@UploadBaseMag');
Route::post('uploadCord','uploadController1@uploadCord');

Route::get('excel/export','ExcelController1@export');
Route::get('excel/import','ExcelController1@import');


// 在这一行下面
Route::get('admin/upload', 'Admin\UploadController@index');

// 添加如下路由
Route::post('admin/upload/file', 'Admin\UploadController@uploadFile');
Route::delete('admin/upload/file', 'Admin\UploadController@deleteFile');
Route::post('admin/upload/folder', 'Admin\UploadController@createFolder');
Route::delete('admin/upload/folder', 'Admin\UploadController@deleteFolder');






#Auth::routes();

#Route::get('/home', 'HomeController@index');
#Route::get('/home', 'HomeController@index')->name('home');
