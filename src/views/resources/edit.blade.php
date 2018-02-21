@extends('laramanager::layouts.sub.default')

@section('title')
    Edit Resource
@endsection

@section('page-content')

    <form action="{{ route('admin.resources.update', $resource->id) }}" enctype="multipart/form-data" method="POST" class="uk-form uk-form-stacked">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="PUT">

        @include('laramanager::partials.elements.form.text', ['field' => ['name' => 'title', 'id' => 'title', 'value' => $resource->title]])
        @include('laramanager::partials.elements.form.slug', ['field' => ['name' => 'slug', 'id' => 'slug', 'target' => 'title', 'value' => $resource->slug]])
        @include('laramanager::partials.elements.form.text', ['field' => ['name' => 'namespace', 'value' => $resource->namespace]])
        @include('laramanager::partials.elements.form.text', ['field' => ['name' => 'model', 'value' => $resource->model]])
        @include('laramanager::partials.elements.form.text', ['field' => ['name' => 'order_column', 'value' => 0, 'value' => $resource->order_column]])
        @include('laramanager::partials.elements.form.select', ['field' => ['name' => 'order_direction', 'options' => ['asc' => 'asc', 'desc' => 'desc'], 'value' => $resource->order_direction]])

        <div class="uk-form-row">
            <button type="submit" class="uk-button uk-button-primary uk-width-1-1 uk-width-medium-1-3 uk-width-large-1-6">Update</button>
        </div>

    </form>

@endsection