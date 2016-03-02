<?php namespace Philsquare\LaraManager\Http\Controllers; 

use Philsquare\LaraManager\Models\Error;

class NotFoundExceptionsController extends Controller {

    protected $error;

    public function __construct(Error $error)
    {
        $this->error = $error;
    }

    public function index()
    {
        $errors = $this->error->where('exception', 'NotFoundHttpException')->get();

        return view('laramanager::errors.not_found.index', compact('errors'));
    }

}