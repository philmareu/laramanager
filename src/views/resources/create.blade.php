@extends('laramanager::layouts.sub.default')

@section('title')
    Create
@endsection

@section('breadcrumbs')
    <li><a href="{{ route('admin.resources.index') }}">Resources</a></li>
    <li><span>@yield('title')</span></li>
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

        @include('laramanager::partials.elements.buttons.submit')

    </form>

@endsection

@push('scripts-last')

    <script>
        $('#title').slugify({ slug: '#slug', type: '_' });
    </script>

@endpush