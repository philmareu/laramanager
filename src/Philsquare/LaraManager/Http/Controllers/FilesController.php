<?php namespace Philsquare\LaraManager\Http\Controllers; 

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Philsquare\LaraForm\Services\FormProcessor;
use Philsquare\LaraManager\Http\Requests\UpdateFileRequest;
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

    public function edit($fileId)
    {
        $file = $this->file->findOrFail($fileId);
        $output['data']['html'] = view('laramanager::files.edit', compact('file'))->render();
        return response()->json($output);
    }

    public function update(UpdateFileRequest $request, $fileId)
    {
        $file = $this->file->findOrFail($fileId);
        if($file->filename != $request->get('filename'))
        {
            if(Storage::has('files/' . $file->filename)) return response()->json(['errors' => ['Filename Exists']]);

            Storage::move('files/' . $file->filename, 'files/' . $request->get('filename'));
        }

        $file->update($request->all());

        $output['data'] = [
            'file' => $file,
            'url' => url('images/original/' . $file->filename)
        ];

        return response()->json($output);
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