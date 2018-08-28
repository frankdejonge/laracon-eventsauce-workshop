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

use Illuminate\Contracts\Auth\Guard;

Route::get('/', function (Guard $guard) {
    return $guard->check()
        ? redirect()->route('shelter.index')
        : view('welcome');
});

Auth::routes();

Route::get('/home', function () {
    return redirect(route('shelter.index'));
})->name('home');
