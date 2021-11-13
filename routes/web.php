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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
  Route::get('/', 'PostController@index')->name('posts.index');


  Route::resource('posts', 'PostController')->except('index');
  Route::get('/posts/show/{id}', 'PostController@show')->name('show');

  Route::get('/posts/edit/{id}', 'PostController@showEdit')->name('edit');
Route::post('/posts/update', 'PostController@exeUpdate')->name('update');
Route::post('/posts/delete/{id}', 'PostController@exeDelete')->name('delete');

// Route::post('/posts/{post}/like', 'LikeController@like');

Route::resource('comments', 'CommentController');

Route::get('/comment/{id}', 'CommentController@show')->name('show');

});

