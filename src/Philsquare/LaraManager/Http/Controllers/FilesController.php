<?php namespace Philsquare\LaraManager\Http\Controllers; 

class FilesController extends Controller {

    public function imageBrowser()
    {
        return view('laramanager::browser.images');
    }

}