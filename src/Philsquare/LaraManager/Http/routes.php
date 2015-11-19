<?php

Route::group(['namespace' => 'Philsquare\LaraManager\Http\Controllers'], function()
{
    get('admin/auth/login', 'Auth\AuthController@getLogin');
    post('admin/auth/login', 'Auth\AuthController@postLogin');
    get('admin/auth/logout', 'Auth\AuthController@getLogout');

    Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function()
    {
        foreach(config('laramanager.resources') as $resource => $meta)
        {
            resource($resource, 'ResourcesController');
        }
    });
});