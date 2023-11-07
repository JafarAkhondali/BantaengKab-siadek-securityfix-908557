<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group(['middleware' => 'VerifyAPIKey'], function () {

    Route::get('/dtks', 'MainController@dtks');
    Route::get('/penduduk', 'MainController@penduduk');
    Route::get('/wilayah', 'MainController@wilayah');
    Route::get('/kepaladesa', 'MainController@wilayahKepala');
    Route::get('/profil', 'MainController@profilewilayah');
    Route::get('/perangkatdesa', 'MainController@perangkatdesa');
    Route::get('/rencana', 'MainController@rencana');
    Route::get('/realisasi', 'MainController@realisasi');
    Route::get('/regulasi', 'MainController@regulasi');
    Route::get('/aspirasi', 'MainController@aspirasi');
    Route::get('/bantuan', 'MainController@bantuan');
    Route::get('/blog', 'MainController@blog');
    Route::get('/blogcategori', 'MainController@blogcategori');
    Route::get('/disabilitas', 'MainController@disabilitas');
    Route::post('/aspirasi/store', 'MainController@store');

});

