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

Auth::routes(['verify' => true]);

Route::group(['middleware' => ['auth','verified']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/retrieve/{id}', 'AjaxController@catch')->name('retrieve.chat');
    Route::post('/chats', 'AjaxController@store')->name('store.chat');
    Route::get('/chats/{id}', 'ChatController@show')->name('show.chat');
    Route::get('/post/{id}', 'PostController@show')->name('show.post');
    Route::post('/post', 'PostController@store')->name('store.post');
    Route::delete('/post/{id}', 'PostController@destroy')->name('delete.post');
    Route::post('/comment', 'CommentController@store')->name('store.comment');
    Route::delete('/comment/{id}', 'CommentController@destroy')->name('delete.comment');
    Route::get('/{name}', 'ProfileController@show')->name("show.profile");
    Route::get('/{name}/edit', 'ProfileController@edit')->name('edit.profile');
    Route::put('/{name}/update', 'ProfileController@update')->name('update.profile');
    Route::post('/like', 'LikeController@store')->name('store.like');
    Route::delete('/like/{id}', 'LikeController@destroy')->name('delete.like');
    Route::post('/follow', 'FollowController@store')->name('store.follow');
    Route::delete('/follow/{id}', 'FollowController@destroy')->name('delete.follow');
    Route::post('/reply', 'ReplyController@store')->name('store.reply');
    Route::delete('/reply/{id}', 'ReplyController@destroy')->name('delete.reply');
});





// Route::get('/profile', function () {
//     return view('profile.show');
// });