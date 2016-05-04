<?php namespace Philsquare\LaraManager\Http\Controllers; 

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Philsquare\LaraManager\Form\FormProcessor;
use Philsquare\LaraManager\Form\Uploader;
use Philsquare\LaraManager\Http\Requests\UpdateImageRequest;
use Philsquare\LaraManager\Http\Requests\UploadImageRequest;
use Philsquare\LaraManager\Models\Image;
use Philsquare\LaraManager\Repositories\ImageRepository;

class ImagesController extends Controller {

    protected $imageRepository;

    protected $uploader;

    public function __construct(ImageRepository $imageRepository, Uploader $uploader)
    {
        $this->imageRepository = $imageRepository;
        $this->uploader = $uploader;
    }

    public function index(Request $request)
    {
        $images = $this->imageRepository->getPaginated();

        if($request->ajax()) return $this->jsonResponse([
            'images' => view('laramanager::browser.images', compact('images'))->render()
        ]);

        return view('laramanager::images.index', compact('images'));
    }

    public function edit($imageId)
    {
        $image = $this->imageRepository->getById($imageId);

        return $this->jsonResponse([
            'html' => [
                'form' => view('laramanager::images.edit', compact('image'))->render()
            ]
        ]);
    }

    public function update(UpdateImageRequest $request, $imageId)
    {
        return $this->imageRepository->update($imageId, $request->all());
    }

    public function search(Request $request)
    {
        $images = $this->imageRepository->search($request->term);

        if($request->ajax()) return response()->json([
            'images' => view('laramanager::browser.images', compact('images'))->render()
        ]);

        return view('laramanager::images.index', compact('images'));
    }

    public function imageBrowser(Request $request)
    {
        return view('laramanager::browser.wysiwyg')
            ->with('funcNum', $request->has('CKEditorFuncNum') ? $request->get('CKEditorFuncNum') : '')
            ->with('images', $this->imageRepository->getPaginated());
    }

    public function upload(UploadImageRequest $request)
    {
        $upload = $this->uploader->upload($request->file('image'), storage_path('app/laramanager/images'));

        $image = $this->imageRepository->create($upload->toArray());

        return $this->jsonResponse(array_merge([
            'html' => view('laramanager::' . $request->get('view'), compact('image'))->render(),
            ], $image->toArray()));
    }

    /**
     * @param $output
     * @return \Illuminate\Http\JsonResponse
     */
    private function jsonResponse($output)
    {
        return response()->json($output);
    }

}