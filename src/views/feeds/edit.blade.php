@extends('laramanager::layouts.admin.default')

@section('title')
    {{ $feed->title }}
@endsection

@section('breadcrumbs')
    <li><a href="{{ route('admin.feeds.index') }}">Feeds</a></li>
    <li class="uk-disabled"><a>Edit</a></li>
    <li><span>@yield('title')</span></li>
@endsection

@section('default-content')

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

        @include('laramanager::partials.elements.buttons.submit', ['submitText' => 'Update'])

    </form>

@endsection

@push('scripts-last')

    <script>
        $('#title').slugify({ slug: '#slug', type: '_' });
    </script>

@endpush