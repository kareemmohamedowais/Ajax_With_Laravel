<?php

use App\Http\Controllers\Usercontroller;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('users')->controller(Usercontroller::class)->group(function(){
    Route::get('/','index')->name('users.index');
    Route::get('/create','create')->name('users.create');
    Route::post('/store','store')->name('users.store');

    Route::post('get-cities','getCities')->name('users.getCities');
});

