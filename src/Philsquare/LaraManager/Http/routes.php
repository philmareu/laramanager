<?php

Route::group(['namespace' => 'Philsquare\LaraManager\Http\Controllers'], function()
{
    get('admin/auth/login', 'Auth\AuthController@getLogin');
    post('admin/auth/login', 'Auth\AuthController@postLogin');
    get('admin/auth/logout', 'Auth\AuthController@getLogout');
    get('admin/auth/password/email', 'Auth\PasswordController@getEmail');
    post('admin/auth/password/email', 'Auth\PasswordController@postEmail');
    get('admin/auth/password/reset/{token}', 'Auth\PasswordController@getReset');
    post('admin/auth/password/reset', 'Auth\PasswordController@postReset');

    Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function()
    {
        get('/', function() { return redirect(config('laramanager.home_uri')); });

        foreach(config('laramanager.resources') as $resource => $meta)
        {
            resource($resource, 'ResourcesController');
        }
    });
});