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

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home','HomeController@index')->name('home');
Route::get('/profile','HomeController@profile')->name('profile');
Route::get('/security','HomeController@security')->name('security');
Route::post('/savedSecurity','HomeController@savedSecurity')->name('savedSecurity');

Route::post('/homeForm','HomeController@form')->name('form');
Route::get('/listProducts','HomeController@listProducts')->name('listProducts');
Route::get('/listForm','HomeController@listForm')->name('listForm');
Route::post('/formProducts','HomeController@formProducts')->name('formProducts');
Route::get('/delete/{id}','HomeController@delete')->name('delete');
Route::get('/edit/{id}','HomeController@edit')->name('edit');

