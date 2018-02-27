@extends('laramanager::layouts.sub.default')

@section('title')
    Create
@endsection

@section('breadcrumbs')
    <li><a href="{{ route('admin.laramanager-navigation-sections.index') }}">Navigation Sections</a></li>
    <li><span>@yield('title')</span></li>
@endsection

@section('page-content')

    <form action="{{ route('admin.laramanager-navigation-sections.store') }}" method="POST" class="uk-form uk-form-stacked">
        {{ csrf_field() }}

        @include('laramanager::partials.elements.form.text', ['field' => ['name' => 'title']])
        @include('laramanager::partials.elements.form.text', ['field' => ['name' => 'icon', 'label' => 'Icon (https://getuikit.com/docs/icon)']])
        @include('laramanager::partials.elements.form.text', ['field' => ['name' => 'ordinal']])

        @include('laramanager::partials.elements.buttons.submit')

    </form>

@endsection