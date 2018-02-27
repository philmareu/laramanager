@extends('laramanager::layouts.sub.default')

@section('title')
    Edit
@endsection

@section('breadcrumbs')
    <li><a href="{{ route('admin.resources.index') }}">Resources</a></li>
    <li class="uk-disabled"><a>{{ $resource->title }}</a></li>
    <li><span>@yield('title')</span></li>
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

        @include('laramanager::partials.elements.buttons.submit', ['submitText' => 'Update'])

    </form>

@endsection