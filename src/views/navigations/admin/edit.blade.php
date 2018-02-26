@extends('laramanager::layouts.sub.default')

@section('title')
    Update Navigation Link
@endsection

@section('page-content')

    <form action="{{ route('admin.laramanager-navigation-links.update', $link->id) }}" enctype="multipart/form-data" method="POST" class="uk-form uk-form-stacked">
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

        <div class="uk-form-row">
            <button type="submit" class="uk-button uk-button-primary uk-width-1-1 uk-width-medium-1-3 uk-width-large-1-6">Update</button>
        </div>

    </form>

@endsection