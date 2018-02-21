@extends('laramanager::layouts.browser')

@section('title')
File Browser
@endsection

@section('content')

    <!-- This is the tabbed navigation containing the toggling elements -->
    <ul class="uk-tab" data-uk-tab="{connect:'#browser-tabs'}">
        <li><a href="">All</a></li>
        <li><a href="">Search</a></li>
        <li><a href="">Upload</a></li>
    </ul>

    <!-- This is the container of the content items -->
    <ul id="browser-tabs" class="uk-switcher uk-margin uk-tab-center">
        <li id="all-images">
            <div id="file-gallery" class="image-browser-images uk-grid-width-1-2 uk-grid-width-small-1-2 uk-grid-width-medium-1-4 uk-grid-width-large-1-6 uk-margin-bottom" data-uk-grid="{gutter: 10, animation: false}">
                @each('laramanager::browser.image', $images, 'image')
            </div>

            <div>
                {!! $images->appends(['CKEditorFuncNum' => $funcNum])->render() !!}
            </div>
        </li>
        <li id="search-images">
            <form action="{{ url('admin/images/search') }}" method="POST" class="uk-form uk-form-horizontal search-images uk-margin-bottom">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="uk-form-icon">
                    <span uk-icon="icon: search;"></span>
                    <input type="text" name="term">
                </div>
                <input type="submit" name="search" value="Search" class="uk-button">
            </form>

            <div class="uk-overflow-container">
                <div class="image-browser-images uk-grid-width-1-2 uk-grid-width-small-1-2 uk-grid-width-medium-1-4 uk-grid-width-large-1-6 uk-margin-bottom" data-uk-observe data-uk-grid="{gutter: 10, animation: false}">
                </div>
            </div>
        </li>
        <li id="upload-images">
            <div id="upload-drop" class="uk-placeholder uk-text-center">
                <i class="uk-icon-cloud-upload uk-icon-medium uk-text-muted uk-margin-small-right"></i>
                Drag images here or <a class="uk-form-file">selecting one<input id="upload-select" type="file"></a>. (20Mb Max)
            </div>

            <div id="progressbar" class="uk-progress uk-hidden">
                <div class="uk-progress-bar" style="width: 0%;">...</div>
            </div>

            <div class="uk-overflow-container">
                <div class="image-browser-images uk-grid-width-1-2 uk-grid-width-small-1-2 uk-grid-width-medium-1-4 uk-grid-width-large-1-6 uk-margin-bottom" data-uk-observe data-uk-grid>
                </div>
            </div>
        </li>
    </ul>
@endsection

@push('scripts-last')
    @include('laramanager::browser.scripts')
@endpush