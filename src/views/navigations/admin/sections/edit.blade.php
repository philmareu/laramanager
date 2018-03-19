@extends('laramanager::layouts.admin.default')

@section('title')
    {{ $section->title }}
@endsection

@section('breadcrumbs')
    <li><a href="{{ route('admin.laramanager-navigation-sections.index') }}">Navigation Sections</a></li>
    <li class="uk-disabled"><a>Edit</a></li>
    <li><span>@yield('title')</span></li>
@endsection

@section('default-content')

    <form action="{{ route('admin.laramanager-navigation-sections.update', $section->id) }}" method="POST" class="uk-form uk-form-stacked">
        {{ csrf_field() }}
        {{ method_field('PUT') }}

        @include('laramanager::partials.elements.form.text', ['field' => ['name' => 'title', 'value' => $section->title]])
        @include('laramanager::partials.elements.form.text', ['field' => ['name' => 'icon', 'label' => 'Icon (https://getuikit.com/docs/icon)', 'value' => $section->icon]])
        @include('laramanager::partials.elements.form.text', ['field' => ['name' => 'ordinal', 'value' => $section->ordinal]])

        @include('laramanager::partials.elements.buttons.submit', ['submitText' => 'Update'])

    </form>

@endsection