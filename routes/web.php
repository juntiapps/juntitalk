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
    if(Auth::id()){
        return redirect('/home');
    } else {
        return view('welcome');
    }  
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/home', 'HomeController@storePost')->name('store.post');
Route::post('/home', 'HomeController@storeComment')->name('store.comment');
Route::get('/{name}', 'ProfileController@show')->name("show.profile");
Route::get('/{name}/edit', 'ProfileController@edit')->name('edit.profile');
Route::put('/{name}/update', 'ProfileController@update')->name('update.profile');

// Route::get('/profile', function () {
//     return view('profile.show');
// });