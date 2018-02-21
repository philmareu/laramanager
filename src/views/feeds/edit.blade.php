@extends('laramanager::layouts.default')

@section('title')
    Edit Object
@endsection

@section('content')

    <form action="{{ route('admin.feeds.update', $feed->id) }}" enctype="multipart/form-data" method="POST" class="uk-form uk-form-stacked">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="PUT">

        @include('laramanager::partials.elements.form.text', ['field' => ['name' => 'title', 'value' => $feed->title]])
        @include('laramanager::partials.elements.form.textarea', ['field' => ['name' => 'description', 'value' => $feed->description]])
        @include('laramanager::partials.elements.form.text', ['field' => ['name' => 'url', 'value' => $feed->url]])
        @include('laramanager::partials.elements.form.slug', ['field' => ['name' => 'slug', 'value' => $feed->slug]])
        @include('laramanager::partials.elements.form.text', ['field' => ['name' => 'model', 'value' => $feed->model]])
        @include('laramanager::partials.elements.form.text', ['field' => ['name' => 'language', 'value' => $feed->language]])
        @include('laramanager::partials.elements.form.text', ['field' => ['name' => 'copyright', 'value' => $feed->copyright]])
        @include('laramanager::partials.elements.form.text', ['field' => ['name' => 'ttl', 'value' => $feed->ttl]])

        <div class="uk-form-row">
            <button type="submit" class="uk-button uk-button-primary uk-width-1-1 uk-width-medium-1-3 uk-width-large-1-6">Update</button>
        </div>

    </form>

@endsection

@push('scripts-last')

    <script>
        $('#title').slugify({ slug: '#slug', type: '_' });
    </script>

@endpush