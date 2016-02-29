<?php namespace Philsquare\LaraManager\Http\Controllers; 

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Philsquare\LaraForm\Services\FormProcessor;
use Philsquare\LaraManager\Http\Requests\UploadFileRequest;
use Philsquare\LaraManager\Http\Requests\UploadImageRequest;
use Philsquare\LaraManager\Models\File;

class FilesController extends Controller {

    protected $formProcessor;

    protected $file;

    public function __construct(FormProcessor $formProcessor, File $file)
    {
        $this->formProcessor = $formProcessor;
        $this->file = $file;
    }

    public function index()
    {
        $files = File::latest()->paginate(30);
        return view('laramanager::files.index', compact('files'));
    }

    public function edit()
    {

    }

    public function update()
    {

    }

    public function imageBrowser(Request $request)
    {
        $funcNum = $request->has('CKEditorFuncNum') ? $request->get('CKEditorFuncNum') : '';

        $images = File::latest()->paginate(10);
        return view('laramanager::browser.files', compact('images', 'funcNum'));
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