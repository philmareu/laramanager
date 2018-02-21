@extends('laramanager::layouts.sub.default')

@section('title')
    Create Resource
@endsection

@section('page-content')

    <form action="{{ route('admin.resources.store') }}" enctype="multipart/form-data" method="POST" class="uk-form uk-form-stacked">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        @include('laramanager::partials.elements.form.text', ['field' => ['name' => 'title', 'id' => 'title']])
        @include('laramanager::partials.elements.form.slug', ['field' => ['name' => 'slug', 'id' => 'slug', 'label' => 'Table name', 'target' => 'title']])
        @include('laramanager::partials.elements.form.text', ['field' => ['name' => 'namespace']])
        @include('laramanager::partials.elements.form.text', ['field' => ['name' => 'model']])
        @include('laramanager::partials.elements.form.text', ['field' => ['name' => 'order_column', 'value' => 0]])
        @include('laramanager::partials.elements.form.select', ['field' => ['name' => 'order_direction', 'options' => ['asc' => 'asc', 'desc' => 'desc']]])

        <div class="uk-form-row">
            <button type="submit" class="uk-button uk-button-primary uk-width-1-1 uk-width-medium-1-3 uk-width-large-1-6">Save</button>
        </div>

    </form>

@endsection

@push('scripts-last')

    <script>
        $('#title').slugify({ slug: '#slug', type: '_' });
    </script>

@endpush