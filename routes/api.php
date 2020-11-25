<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//sample
// Route::get('/' ,function(){
//    return "ok";
// });


//resource full Controller
// Route::resource('/post', 'api\UserController');

// resource full controller route define
//  GET|HEAD  | api/post                    | post.index          | App\Http\Controllers\api\UserController@index               
//  POST      | api/post                    | post.store          | App\Http\Controllers\api\UserController@store                    
//  GET|HEAD  | api/post/create             | post.create         | App\Http\Controllers\api\UserController@create                   
//  GET|HEAD  | api/post/{post}             | post.show           | App\Http\Controllers\api\UserController@show                     
//  PUT|PATCH | api/post/{post}             | post.update         | App\Http\Controllers\api\UserController@update                   
//  DELETE    | api/post/{post}             | post.destroy        | App\Http\Controllers\api\UserController@destroy                 
//  GET|HEAD  | api/post/{post}/edit        | post.edit           | App\Http\Controllers\api\UserController@edit                            


//how to write a proper api
Route::group(['prefix' => 'v1', 'namespace' => 'api'], function(){
        
            Route::get('/user' ,'UserController@index');

            Route::post('/login' ,'LoginController@index');
            
});