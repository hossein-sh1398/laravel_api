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
Route::post('article','ArticleController@store');
Route::get('article','ArticleController@create');
Route::POST('ajax','ArticleController@ajax');
Route::get('pay','PayController@pay');
Route::get('callback/pay','PayController@call_backpay');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::middleware('auth.basic')->get('/profile', function(){
return 'ff';
});

Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');
 
 Route::middleware('auth')->get('new',function(){
return 'hello hossein';
 });