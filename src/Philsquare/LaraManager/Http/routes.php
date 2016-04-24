<?php

use Illuminate\Support\Facades\Schema;
use Philsquare\LaraManager\Models\Redirect;
use Philsquare\LaraManager\Models\Resource;

Route::group(['namespace' => 'Philsquare\LaraManager\Http\Controllers'], function()
{
    Route::get('admin/auth/login', 'Auth\AuthController@getLogin');
    Route::post('admin/auth/login', 'Auth\AuthController@postLogin');
    Route::get('admin/auth/logout', 'Auth\AuthController@getLogout');
    Route::get('admin/auth/password/email', 'Auth\PasswordController@getEmail');
    Route::post('admin/auth/password/email', 'Auth\PasswordController@postEmail');
    Route::get('admin/auth/password/reset/{token}', 'Auth\PasswordController@getReset');
    Route::post('admin/auth/password/reset', 'Auth\PasswordController@postReset');

    if(Schema::hasTable('redirects'))
    {
        foreach(Redirect::all() as $redirect)
        {
            Route::get($redirect->from, 'RedirectsController@redirect');
        }
    }

    Route::get('feed/{type?}', 'RssFeedsController@show');

    Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function()
    {
        Route::get('/', 'AdminController@index');
        Route::get('dashboard', 'AdminController@dashboard');
        Route::get('images/browser', 'ImagesController@imageBrowser');
        Route::post('images/upload', 'ImagesController@upload');
        Route::get('images', 'ImagesController@index');
        Route::post('images/search', 'ImagesController@search');
        Route::resource('images', 'ImagesController', ['except' => ['create', 'store', 'destroy']]);

        // Redirects
        Route::resource('redirects', 'RedirectsController');

        // RSS Feeds
        Route::resource('feeds', 'RssFeedsController', ['except' => ['show']]);

        // Users
        Route::resource('users', 'UsersController', ['except' => ['show']]);

        if(Schema::hasTable('resources'))
        {
            foreach(Resource::all() as $resource)
            {
                Route::resource($resource->slug, 'ResourcesController');

                Route::get('objects/{resource}/{resourceId}/{objects}/create', 'ResourceObjectsController@create');
                Route::post('objects/{resource}/{resourceId}/{objects}', 'ResourceObjectsController@store');
                Route::get('objects/{resource}/{resourceId}/{id}/edit', 'ResourceObjectsController@edit');
                Route::put('objects/{resource}/{resourceId}/{id}', 'ResourceObjectsController@update');
                Route::put('objects/reorder', 'ResourceObjectsController@reorder');
                Route::delete('objects/{id}', ['before' => 'ajax', 'uses' => 'ResourceObjectsController@destroy']);
            }
        }

        Route::post('uploads/resource', 'ResourcesController@uploads');


        Route::get('resources/fields/getOptions/{type}', 'ResourceFieldController@getOptions');
        Route::get('resources/{resources}/fields/{fields}/edit', 'ResourceFieldController@edit');
        Route::put('resources/{resources}/fields/{fields}/edit', 'ResourceFieldController@update');
        Route::get('resources/{resources}/fields', 'ResourceFieldController@index');
        Route::get('resources/{resources}/fields/create', 'ResourceFieldController@create');
        Route::post('resources/{resources}/fields/create', 'ResourceFieldController@store');
        Route::delete('resources/{resources}/fields/{fields}', 'ResourceFieldController@destroy');
        Route::resource('resources', 'ResourceManagerController');

        Route::resource('objects', 'ObjectsController');
        Route::resource('settings', 'SettingsController');

        // Errors
        Route::get('not-founds', 'NotFoundExceptionsController@index');
        Route::delete('not-founds/{id}', 'NotFoundExceptionsController@destroy');
    });
});
