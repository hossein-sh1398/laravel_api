<?php

use Illuminate\Http\Request;
use  App\Http\Resources\v1\UserResource;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
 Route::prefix('v1')->namespace('Api\v1')->group(function(){
 Route::GET('courses','CourseController@index');
 Route::GET('courses/{course}','CourseController@single');
 Route::POST('courses','CourseController@store');
 Route::POST('login','UserController@login');
 Route::POST('register','UserController@register');
 Route::middleware('auth:api')->group(function () {
     Route::POST('comments','CommentController@store');
     Route::get('user',function(){
         return new UserResource(auth()->user());

     });
     Route::POST('upload/image','UploadController@image');
     Route::POST('buy/course/{course}','PayController@buy');
     Route::GET('pay/callback','PayController@call_back');
 });





















 Route::get('verta',function(){
   $v= new Verta();

   // return $v->timestamp(1333857600);
   // return $v->timestamp(1333857600)->format('y/m/d');
   // return $v->timestamp(1333857600)->format('y/m/d H:i:s'); convert timestamp to date time
   // return $v->timestamp; return timestamp
   // return $v->formatDate();
   //return $v->format('y/m/d','1333857600');
    return $v->now()->format('y/m/d');
 });
});
