@extends('laramanager::layouts.sub.default')

@section('title')
    {{ $link->title }}
@endsection

@section('breadcrumbs')
    <li><a href="{{ route('admin.laramanager-navigation-links.index') }}">Navigation Links</a></li>
    <li class="uk-disabled"><a>Edit</a></li>
    <li><span>@yield('title')</span></li>
@endsection

@section('default-content')

    <form action="{{ route('admin.laramanager-navigation-links.update', $link->id) }}" method="POST" class="uk-form uk-form-stacked">
        {{ csrf_field() }}
        {{ method_field('PUT') }}

        @include('laramanager::partials.elements.form.text', ['field' => ['name' => 'title', 'value' => $link->title]])
        @include('laramanager::partials.elements.form.text', ['field' => ['name' => 'uri', 'value' => $link->uri]])
        @include('laramanager::partials.elements.form.text', ['field' => ['name' => 'ordinal', 'value' => $link->ordinal]])
        @include('laramanager::partials.elements.form.select', ['field' => [
            'name' => 'laramanager_navigation_section_id',
            'options' => $sections->pluck('title', 'id')->toArray(),
            'value' => $link->laramanager_navigation_section_id
        ]])

        @include('laramanager::partials.elements.buttons.submit', ['submitText' => 'Update'])

    </form>

@endsection