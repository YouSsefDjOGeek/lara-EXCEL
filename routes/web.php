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
*/



//Auth::routes();


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});



Route::group( ['middleware' => 'admin.user'], function()
{

    Route::get('/', function () {
        return redirect(url('/admin'));
    });
    Route::get('/admin/files', 'FileController@index')->name('browseFiles');
    Route::get('/admin/files/upload', 'FileController@create')->name('UploadFiles');
    Route::post('/admin/files/upload/storeFile', 'FileController@store')->name('storeFile');

    Route::get('/admin/showFile/{id}', 'FileController@show')->name('showFile');
    Route::get('/admin/files/comparefiles/{file1}/{file2}', 'FileController@compareFiles')->name('compareFiles');
    Route::get('/admin/deleteFile/{id}', 'FileController@destroy')->name('deleteFile');


});
