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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware'=>'admin'], function(){

    Route::resource('/admin/users', 'AdminUsersController', ['as' => 'admin']);
    Route::resource('/admin/posts', 'AdminPostsController', ['as' => 'admin']);
    Route::resource('/admin/categories','AdminCategoriesController', ['as' => 'admin']);
    Route::resource('/admin/media','AdminMediasController',['as' => 'admin']);
    Route::resource('/admin/comments', 'PostCommentsController',['as' => 'admin']);
    Route::resource('/admin/comment/replies','CommentRepliesController');
});

//Route::resource('/admin/users', 'AdminUsersController', ['as' => 'admin']); //placed in route group middleware above for security. Only users that ar logged and are admin and have a role of active will be allowed
Route::get('/admin', function(){
    return view('admin.index');
});

//route for post.blade.php. a single post

Route::get('/post/{id}',['as' => 'home.post', 'uses' => 'AdminPostsController@post']); //renamed post/{id} to home/post. since changed name, must direct changed name to controller using 'uses'

//route for commentReply. we already have a rote that caters for repplies. nut we dont want user to send request anywhere else using reply form

Route::group(['middleware'=>'auth'], function(){ //auth gives access to the user thats logged in
Route::post('comment/reply', 'CommentRepliesController@createReply');
});

//rote for bulk media delete

Route::delete('delete/media' ,'AdminMediasController@deleteMedia');