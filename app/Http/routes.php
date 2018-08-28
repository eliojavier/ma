<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['prefix' => 'api'], function(){
    Route::post('users/enterpriseIsValid','ApiUserController@checkEnterprise');
    Route::resource('categories','ApiCategoryController');
    Route::resource('users','ApiUserController');
    Route::get('users/search','ApiUserController@search');

    Route::get('posts/detail/{id}','ApiPostController@detail');
    Route::get('posts/search','ApiPostController@search');
});


Route::auth();
Route::get('/','PagesController@welcome');
Route::get('/home', ['as' => 'home', 'uses' => 'PagesController@home']);
Route::get('/terms', ['as' => 'terms-and-conditions', 'uses' => 'PagesController@terms']);

Route::get('/privacy',  'PagesController@privacy');


Route::get('posts/{posts}',['as' => 'posts.show', 'uses' => 'PostController@show']);

Route::resource('profile','ProfileController',['only' => ['index', 'update', 'edit']]);
Route::get('pages/{page}','PagesController@page');

/**
 * Dashboard/Admin panel routes.
 */
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'AdminController@index');
    Route::get('ajax/posts',[ 'as' => 'datatable.posts', 'uses' => 'PostController@getPostsForAdminView']);
    Route::resource('posts','PostController');
    Route::resource('tags','TagController');
    Route::resource('categories','CategoryController');
    Route::resource('users','UserController');
    Route::resource('slider','SliderController');
    Route::resource('media','MediaController');
    Route::post('slider/{slider}/pictures',[ 'as' => 'add_pictures_to_slider', 'uses' => 'SliderController@addPictures']);
    Route::resource('videos','YoutubeController',
        ['only' => ['index','update']]);
});
Route::resource('collaborators','CollaboratorController');
Route::post('avatar',[
    'as' => 'addAvatar',
    'uses' => 'MediaController@addAvatar'
]);
Route::post('share',['uses' => 'PostController@share', 'as' => 'count.shares']);
Route::post('likes',['uses' => 'PostController@likes', 'as' => 'count.likes']);
Route::post('addTags',['uses' => 'ProfileController@addTags', 'as' => 'add.tags']);
Route::post('removeTags',['uses' => 'ProfileController@removeTags', 'as' => 'remove.tags']);
Route::post('changePassword',['uses' => 'ProfileController@changePassword', 'as' => 'change.password']);

Route::get('search','PagesController@search');
Route::get('searchText', 'PagesController@searchText');

//Social Login
Route::get('/login/{provider?}',[
    'uses' => 'SocialController@getSocialAuth',
    'as'   => 'auth.getSocialAuth'
]);
