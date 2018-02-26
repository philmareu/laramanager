@extends('laramanager::layouts.sub.default')

@section('title')
    Create Navigation Link
@endsection

@section('page-content')

    <form action="{{ route('admin.laramanager-navigation-links.store') }}" method="POST" class="uk-form uk-form-stacked">
        {{ csrf_field() }}

        @include('laramanager::partials.elements.form.text', ['field' => ['name' => 'title', 'id' => 'title']])
        @include('laramanager::partials.elements.form.text', ['field' => ['name' => 'uri']])
        @include('laramanager::partials.elements.form.text', ['field' => ['name' => 'ordinal']])
        @include('laramanager::partials.elements.form.select', ['field' => [
            'name' => 'laramanager_navigation_section_id',
            'options' => $sections->pluck('title', 'id')->toArray()
        ]])

        <div class="uk-form-row">
            <button type="submit" class="uk-button uk-button-primary uk-width-1-1 uk-width-medium-1-3 uk-width-large-1-6">Save</button>
        </div>

    </form>

@endsection