<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your module. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

//Module Settings
Route::group(['prefix' => 'app/modules/'], function () {
    Route::get('{module}/settings', 'Auth0ModuleController@index');
    Route::post('{module}/settings', 'Auth0ModuleController@saveSettings');
});

//Authentication
//Route::get('login', 'Auth0ModuleController@login');
//Route::get('/admin/login', 'Auth0ModuleController@login');
//Route::get('/app/login', 'Auth0ModuleController@login');
Route::get('/auth0/callback', '\Auth0\Login\Auth0Controller@callback');
Route::get('/logout', function() {
    Auth::logout();
    return redirect('/');
});