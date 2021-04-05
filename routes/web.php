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
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::get('Custom','App\Http\Controllers\ordersController@index');
Route::post('Custom-sortable','App\Http\Controllers\ordersController@update');










Route::get('post','App\Http\Controllers\PostController@index');
Route::post('post-sortable','App\Http\Controllers\PostController@update');
