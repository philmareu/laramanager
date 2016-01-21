<?php

Route::group(['namespace' => 'Philsquare\LaraManager\Http\Controllers'], function()
{
    Route::get('admin/auth/login', 'Auth\AuthController@getLogin');
    Route::post('admin/auth/login', 'Auth\AuthController@postLogin');
    Route::get('admin/auth/logout', 'Auth\AuthController@getLogout');
    Route::get('admin/auth/password/email', 'Auth\PasswordController@getEmail');
    Route::post('admin/auth/password/email', 'Auth\PasswordController@postEmail');
    Route::get('admin/auth/password/reset/{token}', 'Auth\PasswordController@getReset');
    Route::post('admin/auth/password/reset', 'Auth\PasswordController@postReset');

    Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function()
    {
        Route::get('/', 'AdminController@findHome');

        if(! is_null(config('laramanager.resources')))
        {
            foreach(config('laramanager.resources') as $resource => $meta)
            {
                Route::resource($resource, 'ResourcesController');
            }

//            Route::post('uploads/resource', 'ResourcesController@uploads');
            Route::post('delete-file', 'ResourcesController@deleteFile');
        }

        Route::get('images/browser', 'FilesController@imageBrowser');
        Route::post('files/upload', 'FilesController@upload');

    });
});