<?php


Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Route::post('/signup', ['uses' => 'UserController@signUp', 'as' => 'signup']);

Route::post('/login', ['uses' => 'UserController@logIn', 'as' => 'login']);

Route::post('/edit', ['uses' => 'PostController@editPost', 'as' => 'edit']);

Route::post('/createPost', ['uses' => 'PostController@createPost', 'as' => 'post.create', 'middleware' => 'auth']);

Route::post('/updateaccount', ['uses' => 'UserController@updateAccount', 'as' => 'account.save']);

Route::get('/deletePost/{post_id}', ['uses' => 'PostController@deletePost', 'as' => 'post.delete', 'middleware' => 'auth']);

Route::get('/home', ['uses' => 'PostController@getHome', 'as' => 'home', 'middleware' => 'auth']);

Route::get('/logout', ['uses' => 'UserController@logOut', 'as' => 'logout']);

Route::get('/account', ['uses' => 'UserController@getAccount', 'as' => 'account']);

Route::get('/userimage/{filename}',['uses' => 'UserController@getImage', 'as' => 'account.image']);

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function ()
{

});
