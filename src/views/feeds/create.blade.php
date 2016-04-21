@extends('laramanager::layouts.default')

@section('title')
    Create Feed
@endsection

@section('content')

    @if(session()->has('errors'))
        <div class="uk-alert uk-alert-danger" data-uk-alert>
            Oops. It looks like a few fields were not completed properly.
            <a href="#" class="uk-alert-close uk-close"></a>
        </div>
    @endif

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

        <div class="uk-form-row">
            <button type="submit" class="uk-button uk-button-primary uk-width-1-1 uk-width-medium-1-3 uk-width-large-1-6">Save</button>
        </div>

    </form>

@endsection