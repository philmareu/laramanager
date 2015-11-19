<?php

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function()
{
    get('/', function() {
        return view('laraform::email', ['name' => 'testing']);
    });
});