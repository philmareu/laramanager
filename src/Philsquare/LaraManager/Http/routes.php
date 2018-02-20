<?php

use Illuminate\Support\Facades\Schema;
use Philsquare\LaraManager\Models\Redirect;
use Philsquare\LaraManager\Models\Resource;

Route::group(['namespace' => 'Philsquare\LaraManager\Http\Controllers', 'middleware' => 'web'], function()
{
    Route::get('admin/login', 'Auth\LoginController@showLoginForm');
    Route::post('admin/login', 'Auth\LoginController@login');
    Route::get('admin/logout', 'Auth\LoginController@logout');
    Route::get('admin/password/email', 'Auth\ForgotPasswordController@showLinkRequestForm');
    Route::post('admin/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::get('admin/password/reset/{token}', 'Auth\PasswordController@getReset');
    Route::post('admin/password/reset', 'Auth\PasswordController@postReset');
    Route::get('laramanager/install', 'Auth\InstallController@showInstallForm');
    Route::post('laramanager/install', 'Auth\InstallController@processInstall');

    if(Schema::hasTable('redirects'))
    {
        foreach(Redirect::all() as $redirect)
        {
            Route::get($redirect->from, 'RedirectsController@redirect');
        }
    }

    Route::get('feed/{type}', 'RssFeedsController@show');

    Route::group(['prefix' => 'admin', 'middleware' => 'admin', 'as' => 'admin.'], function()
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

        if(Schema::hasTable('laramanager_resources'))
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
        Route::get('errors', 'ErrorsController@index');
        Route::delete('errors/{id}', 'ErrorsController@destroy');
    });
});