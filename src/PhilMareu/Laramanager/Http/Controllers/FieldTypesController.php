<?php

namespace PhilMareu\Laramanager\Http\Controllers;


use PhilMareu\Laramanager\Http\Requests\StoreFieldTypeRequest;
use PhilMareu\Laramanager\Http\Requests\UpdateFieldTypeRequest;
use PhilMareu\Laramanager\Models\LaramanagerFieldType;

class FieldTypesController extends Controller
{
    protected $fieldType;

    public function __construct(LaramanagerFieldType $fieldType)
    {
        $this->fieldType = $fieldType;
    }

    public function index()
    {
        $fieldTypes = $this->fieldType->all();

        return view('laramanager::field_types.index')
            ->with('fieldTypes', $fieldTypes);
    }

    public function create()
    {
        return view('laramanager::field_types.create');
    }

    public function store(StoreFieldTypeRequest $request)
    {
        $request->offsetSet('active', $request->filled('active'));
        $this->fieldType->create($request->all());

        return redirect('admin/field-types');
    }

    public function edit($fieldTypeId)
    {
        $fieldType = $this->fieldType->findOrFail($fieldTypeId);

        return view('laramanager::field_types.edit')
            ->with('fieldType', $fieldType);
    }

    public function update(UpdateFieldTypeRequest $request, $fieldTypeId)
    {
        $request->offsetSet('active', $request->filled('active'));
        $fieldType = $this->fieldType->findOrFail($fieldTypeId);
        $fieldType->update($request->all());
        
        return redirect('admin/field-types');
    }
}