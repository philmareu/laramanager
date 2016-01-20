<?php namespace Philsquare\LaraManager\Http\Controllers; 

use Illuminate\Http\Request;
use Laradev\Models\File;

class FilesController extends Controller {

    public function imageBrowser(Request $request)
    {
        $funcNum = $request->get('CKEditorFuncNum');

        $images = File::all();
        return view('laramanager::browser.images', compact('images', 'funcNum'));
    }

}