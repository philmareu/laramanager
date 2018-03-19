@extends('laramanager::layouts.admin.default')

@section('title')
    Create
@endsection

@section('breadcrumbs')
    <li><a href="{{ route('admin.laramanager-navigation-links.index') }}">Navigation Links</a></li>
    <li><span>@yield('title')</span></li>
@endsection

@section('default-content')

    <form action="{{ route('admin.laramanager-navigation-links.store') }}" method="POST" class="uk-form uk-form-stacked">
        {{ csrf_field() }}

        @include('laramanager::partials.elements.form.text', ['field' => ['name' => 'title', 'id' => 'title']])
        @include('laramanager::partials.elements.form.text', ['field' => ['name' => 'uri']])
        @include('laramanager::partials.elements.form.text', ['field' => ['name' => 'ordinal']])
        @include('laramanager::partials.elements.form.select', ['field' => [
            'name' => 'laramanager_navigation_section_id',
            'options' => $sections->pluck('title', 'id')->toArray()
        ]])

        @include('laramanager::partials.elements.buttons.submit')

    </form>

@endsection