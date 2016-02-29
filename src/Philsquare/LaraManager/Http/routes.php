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

    Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function()
    {
        Route::get('/', 'AdminController@index');
        Route::get('dashboard', 'AdminController@dashboard');
        Route::post('files/upload', 'FilesController@upload');
        Route::resource('files', 'FilesController', ['except' => ['create', 'store', 'destroy']]);

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
        Route::get('images/browser', 'FilesController@imageBrowser');


        Route::get('resources/fields/getOptions/{type}', 'ResourceFieldController@getOptions');
        Route::get('resources/{resources}/fields/{fields}/edit', 'ResourceFieldController@edit');
        Route::put('resources/{resources}/fields/{fields}/edit', 'ResourceFieldController@update');
        Route::get('resources/{resources}/fields', 'ResourceFieldController@index');
        Route::get('resources/{resources}/fields/create', 'ResourceFieldController@create');
        Route::post('resources/{resources}/fields/create', 'ResourceFieldController@store');
        Route::delete('resources/{resources}/fields/{fields}', 'ResourceFieldController@destroy');
        Route::resource('resources', 'ResourceManagerController');

        Route::resource('objects', 'ObjectsController');
    });
});