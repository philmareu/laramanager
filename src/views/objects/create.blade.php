@extends('laramanager::layouts.admin.default')

@section('title')
    Create
@endsection

@section('breadcrumbs')
    <li><a href="{{ route('admin.objects.index') }}">Objects</a></li>
    <li><span>@yield('title')</span></li>
@endsection

@section('default-content')

    <form action="{{ route('admin.objects.store') }}" enctype="multipart/form-data" method="POST" class="uk-form uk-form-stacked">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        @include('laramanager::partials.elements.form.text', ['field' => ['name' => 'title', 'id' => 'title']])
        @include('laramanager::partials.elements.form.slug', ['field' => ['name' => 'slug', 'id' => 'slug', 'target' => 'title']])
        @include('laramanager::partials.elements.form.text', ['field' => ['name' => 'description']])

        @include('laramanager::partials.elements.buttons.submit')

    </form>

@endsection

@push('scripts-last')

    <script>
        $('#title').slugify({ slug: '#slug', type: '_' });
    </script>

@endpush