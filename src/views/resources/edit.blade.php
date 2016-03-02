@extends('laramanager::layouts.default')

@section('title')
    Edit Resource
@endsection

@section('content')

    @if(session()->has('errors'))
        <div class="uk-alert uk-alert-danger" data-uk-alert>
            Oops. It looks like a few fields were not completed properly.
            <a href="#" class="uk-alert-close uk-close"></a>
        </div>
    @endif

    <form action="{{ route('admin.resources.update', $resource->id) }}" enctype="multipart/form-data" method="POST" class="uk-form uk-form-stacked">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="PUT">

        @include('laraform::elements.form.text', ['field' => ['name' => 'title', 'id' => 'title', 'value' => $resource->title]])
        @include('laraform::elements.form.slug', ['field' => ['name' => 'slug', 'id' => 'slug', 'target' => 'title', 'value' => $resource->slug]])
        @include('laraform::elements.form.text', ['field' => ['name' => 'namespace', 'value' => $resource->namespace]])
        @include('laraform::elements.form.text', ['field' => ['name' => 'model', 'value' => $resource->model]])
        @include('laraform::elements.form.text', ['field' => ['name' => 'order_column', 'value' => 0, 'value' => $resource->order_column]])
        @include('laraform::elements.form.select', ['field' => ['name' => 'order_direction', 'options' => ['asc' => 'asc', 'desc' => 'desc'], 'value' => $resource->order_direction]])
        @include('laraform::elements.form.text', ['field' => ['name' => 'icon', 'value' => $resource->icon]])

        <div class="uk-form-row">
            <button type="submit" class="uk-button uk-button-primary uk-width-1-1 uk-width-medium-1-3 uk-width-large-1-6">Update</button>
        </div>

    </form>

@endsection