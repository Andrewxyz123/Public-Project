<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return view('login');
});

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', function () {
    if(Auth::check()){
        return view('user-page');
    }
    return view('login');
});

Route::post('/login', 'App\Http\Controllers\UserController@login')->name('login');

Route::get('/logout', 'App\Http\Controllers\UserController@logout');

Route::post('/user-page-in', 'App\Http\Controllers\ParkingController@checkIn')->name('check-in');

Route::post('/user-page-out', 'App\Http\Controllers\ParkingController@checkOut')->name('check-out');

Route::get('/user-page', 'App\Http\Controllers\UserController@checkLogin');

//admin page
Route::post('/user-page', 'App\Http\Controllers\ParkingController@filterData')->name('date-filter');

//Export
Route::get('/export-parking', 'App\Http\Controllers\ParkingController@parkingExport')->name('export-parking');