<?php namespace Philsquare\LaraManager\Http\Controllers; 

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Philsquare\LaraForm\Services\FormProcessor;
use Philsquare\LaraManager\Http\Requests\UploadFileRequest;
use Philsquare\LaraManager\Http\Requests\UploadImageRequest;
use Philsquare\LaraManager\Models\File;

class FilesController extends Controller {

    protected $formProcessor;

    public function __construct(FormProcessor $formProcessor)
    {
        $this->formProcessor = $formProcessor;
    }

    public function imageBrowser(Request $request)
    {
        $funcNum = $request->get('CKEditorFuncNum');

        $files = File::all();
        return view('laramanager::browser.files', compact('files', 'funcNum'));
    }

    public function upload(UploadFileRequest $request)
    {
        $filename = $this->formProcessor->processFile($request->file('file'), 'files');

        $file = File::create(['filename' => $filename, 'type' => 'image']);

        $output['status'] = 'ok';
        $output['data'] = [
            'html' => view('laramanager::browser.file', compact('file'))->render(),
            'file' => $file
        ];

        return response()->json($output);
    }

}