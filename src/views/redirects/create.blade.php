@extends('laramanager::layouts.sub.default')

@section('title')
    Create
@endsection

@section('breadcrumbs')
    <li><a href="{{ route('admin.redirects.index') }}">Redirects</a></li>
    <li><span>@yield('title')</span></li>
@endsection

@section('page-content')

    <form action="{{ route('admin.redirects.store') }}" enctype="multipart/form-data" method="POST" class="uk-form uk-form-stacked">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        @include('laramanager::partials.elements.form.text', ['field' => ['name' => 'from']])
        @include('laramanager::partials.elements.form.text', ['field' => ['name' => 'to']])
        @include('laramanager::partials.elements.form.select', ['field' => ['name' => 'type', 'options' => ['301' => '301 Permanent', '302' => '302 Temporary']]])

        @include('laramanager::partials.elements.buttons.submit')

    </form>

@endsection