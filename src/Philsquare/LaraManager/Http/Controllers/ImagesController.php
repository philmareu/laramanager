<?php namespace Philsquare\LaraManager\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Philsquare\LaraManager\Form\FormProcessor;
use Philsquare\LaraManager\Form\Uploader;
use Philsquare\LaraManager\Http\Requests\UpdateImageRequest;
use Philsquare\LaraManager\Http\Requests\UploadImageRequest;
use Philsquare\LaraManager\Models\LaramanagerImage;
use Philsquare\LaraManager\Repositories\ImageRepository;

class ImagesController extends Controller {

    /**
     * The Image Repository
     *
     * @var ImageRepository
     */
    protected $imageRepository;

    /**
     * The Uploader handles uploading of files
     *
     * @var Uploader
     */
    protected $uploader;

    /**
     * Create a new images controller instance
     *
     * @param ImageRepository $imageRepository
     * @param Uploader $uploader
     */
    public function __construct(ImageRepository $imageRepository, Uploader $uploader)
    {
        $this->imageRepository = $imageRepository;
        $this->uploader = $uploader;
    }

    /**
     * This provides the gallery of images
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     * @throws \Exception
     * @throws \Throwable
     */
    public function index(Request $request)
    {
        $images = $this->imageRepository->getPaginated(25);

        if($request->ajax()) return $images;

        return view('laramanager::images.index', compact('images'));
    }

    /**
     * Update image from form
     *
     * @param UpdateImageRequest $request
     * @param $imageId
     * @return mixed
     */
    public function update(UpdateImageRequest $request, $imageId)
    {
        return $this->imageRepository->update($imageId, $request->all());
    }

    /**
     * Returns images from search results
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     * @throws \Exception
     * @throws \Throwable
     */
    public function search(Request $request)
    {
        $images = $this->imageRepository->search($request->term);

        if($request->ajax()) return response()->json([
            'images' => view('laramanager::browser.images', compact('images'))->render()
        ]);

        return view('laramanager::images.index', compact('images'));
    }

    /**
     * Show image browser in the WYSIWYG editor
     *
     * @param Request $request
     * @return mixed
     */
    public function imageBrowser(Request $request)
    {
        return view('laramanager::browser.wysiwyg')
            ->with('funcNum', $request->has('CKEditorFuncNum') ? $request->get('CKEditorFuncNum') : '')
            ->with('images', $this->imageRepository->getPaginated());
    }

    /**
     * Upload and save image information
     *
     * @param UploadImageRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     * @throws \Throwable
     */
    public function store(UploadImageRequest $request)
    {
        $upload = $this->uploader->upload($request->file('image'), storage_path('app/laramanager/images'));

        return $this->imageRepository->create($upload->toArray());
    }

}