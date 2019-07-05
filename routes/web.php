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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/ca',function (){
    return view('chat.form');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home2/{id}', 'HomeController@agregar')->name('agregar');

Route::get('/cam/{queue}','MessagesController@cusumirMessage')->name('consumir');
Route::post('/cam2','MessagesController@queue')->name('inserta');
Route::get('/be_friend/{id}', 'HomeController@beFriend')->name('be_friend');
Route::get('/chat-privado/{id}','HomeController@privado')->name('privado');

