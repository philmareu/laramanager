@extends('laramanager::layouts.sub.default')

@section('title')
    Create
@endsection

@section('breadcrumbs')
    <li><a href="{{ route('admin.feeds.index') }}">Feeds</a></li>
    <li><span>@yield('title')</span></li>
@endsection

@section('page-content')

    <div class="uk-alert uk-alert-warning">
        Please note that your model requires the "RssFeedInterface" before you can create the feed.
    </div>

    <form action="{{ route('admin.feeds.store') }}" enctype="multipart/form-data" method="POST" class="uk-form uk-form-stacked">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        @include('laramanager::partials.elements.form.text', ['field' => ['name' => 'title']])
        @include('laramanager::partials.elements.form.textarea', ['field' => ['name' => 'description']])
        @include('laramanager::partials.elements.form.text', ['field' => ['name' => 'url']])
        @include('laramanager::partials.elements.form.slug', ['field' => ['name' => 'slug']])
        @include('laramanager::partials.elements.form.text', ['field' => ['name' => 'model']])
        @include('laramanager::partials.elements.form.text', ['field' => ['name' => 'language', 'value' => 'en-US']])
        @include('laramanager::partials.elements.form.text', ['field' => ['name' => 'copyright', 'value' => 'Copyright ' . date('Y') . ', ']])
        @include('laramanager::partials.elements.form.text', ['field' => ['name' => 'ttl', 'value' => '720']])

        @include('laramanager::partials.elements.buttons.submit')

    </form>

@endsection