@extends('laramanager::layouts.default')

@section('title')
    Create Resource
@endsection

@section('content')

    @if(session()->has('errors'))
        <div class="uk-alert uk-alert-danger" data-uk-alert>
            Oops. It looks like a few fields were not completed properly.
            <a href="#" class="uk-alert-close uk-close"></a>
        </div>
    @endif

    <form action="{{ route('admin.resources.store') }}" enctype="multipart/form-data" method="POST" class="uk-form uk-form-stacked">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        @include('laramanager::partials.elements.form.text', ['field' => ['name' => 'title', 'id' => 'title']])
        @include('laramanager::partials.elements.form.slug', ['field' => ['name' => 'slug', 'id' => 'slug', 'target' => 'title']])
        @include('laramanager::partials.elements.form.text', ['field' => ['name' => 'namespace']])
        @include('laramanager::partials.elements.form.text', ['field' => ['name' => 'model', 'value' => 'Models\\']])
        @include('laramanager::partials.elements.form.text', ['field' => ['name' => 'order_column', 'value' => 0]])
        @include('laramanager::partials.elements.form.select', ['field' => ['name' => 'order_direction', 'options' => ['asc' => 'asc', 'desc' => 'desc']]])
        @include('laramanager::partials.elements.form.text', ['field' => ['name' => 'icon', 'value' => 'uk-icon-']])

        <div class="uk-form-row">
            <button type="submit" class="uk-button uk-button-primary uk-width-1-1 uk-width-medium-1-3 uk-width-large-1-6">Save</button>
        </div>

    </form>

@endsection

@section('scripts')

    <script>
        $('#title').slugify({ slug: '#slug', type: '_' });
    </script>

@endsection