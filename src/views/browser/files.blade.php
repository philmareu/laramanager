@extends('laramanager::layouts.browser')

@section('title')
File Browser
@endsection

@section('content')

    <div id="upload-drop" class="uk-placeholder uk-text-center">
        <i class="uk-icon-cloud-upload uk-icon-medium uk-text-muted uk-margin-small-right"></i>
        Drag files here or <a class="uk-form-file">selecting one<input id="upload-select" type="file"></a>. (5Mb Max)
    </div>

    <div id="progressbar" class="uk-progress uk-hidden">
        <div class="uk-progress-bar" style="width: 0%;">...</div>
    </div>

    <div id="file-gallery" class="uk-grid" data-uk-grid-margin>
        @each('laramanager::browser.file', $images, 'file')
    </div>

    {!! $images->render() !!}
@endsection

@section('scripts')
    @include('laramanager::browser.scripts')
@endsection