<?php

namespace PhilMareu\Laramanager\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use PhilMareu\Laramanager\Form\FormProcessor;
use PhilMareu\Laramanager\Fields\FieldProcessor;
use PhilMareu\Laramanager\Models\File;
use PhilMareu\Laramanager\Models\LaramanagerObject;
use PhilMareu\Laramanager\Models\LaramanagerResource;
use PhilMareu\Laramanager\Repositories\EntriesRepository;
use PhilMareu\Laramanager\Repositories\ResourceRepository;

class EntriesController extends Controller
{
    protected $slug;

    protected $resource;

    protected $resourceRepository;

    protected $entryRepository;

    public function __construct(Request $request, ResourceRepository $resourceRepository, EntriesRepository $entriesRepository)
    {
        $this->slug = $request->segment(2);
        $this->resource = $resourceRepository->getBySlug($this->slug);
        $this->resourceRepository = $resourceRepository;
        $this->entriesRepository = $entriesRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('laramanager::entires.index.index')
            ->with('resource', $this->resource)
            ->with('entries', $this->entriesRepository->getList($this->resource));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $options = $this->resource->fields->filter(function($field) {
            return $field->type == 'relational';
        })->reduce(function($options, $field) {
            return array_merge($options, [$field->slug => $this->entriesRepository->getFieldOptions($field)]);
        }, []);

        return view('laramanager::entires.create')
            ->with('resource', $this->resource)
            ->with('options', $options);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->validationRules($this->resource));
        $entry = $this->entriesRepository->create($request, $this->resource);

        return redirect('admin/' . $this->resource->slug)->with('success', 'Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $entry = $this->entriesRepository->getById($id, $this->resource);

        return view('laramanager::entires.show')
            ->with('resource', $this->resource)
            ->with('entry', $entry)
            ->with('objects', LaramanagerObject::all());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $entry = $this->entriesRepository->getById($id, $this->resource);

        $options = $this->resource->fields->filter(function($field) {
            return $field->type == 'relational';
        })->reduce(function($options, $field) {
            return array_merge($options, [$field->slug => $this->entriesRepository->getFieldOptions($field)]);
        }, []);

        return view('laramanager::entires.edit')
            ->with('resource', $this->resource)
            ->with('entry', $entry)
            ->with('options', $options);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $entry = $this->entriesRepository->getById($id, $this->resource);
        $this->validate($request, $this->validationRules($this->resource, $entry));

        $this->entriesRepository->update($id, $request, $this->resource);

        return redirect()->back()->with('success', 'Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->entriesRepository->delete($id, $this->resource);

        return response()->json(['status' => 'ok']);
    }

    private function validationRules($resource, $entry = null)
    {
        return $resource->fields->reduce(function($rules, $field) use ($resource, $entry) {
            $rule = $field->validation;

            if($field->is_unique)
            {
                $rule .= '|unique:' . $resource->slug . ',' . $field->slug;

                if($entry) $rule .=  ',' . $entry->id;
            }

            if($field->is_required) $rule .= '|required';

            return array_merge($rules, [$field->slug => $rule]);
        }, []);
    }
}
