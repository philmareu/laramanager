@extends('laramanager::layouts.default')

@section('title')
    Files
@endsection

@section('actions')
    <a href="{{ route('admin.resources.create') }}" class="uk-float-right"><i class="uk-icon-plus"></i> Add</a>
@endsection

@section('content')

    <div id="upload-drop" class="uk-placeholder uk-text-center">
        <i class="uk-icon-cloud-upload uk-icon-medium uk-text-muted uk-margin-small-right"></i>
        Drag files here or <a class="uk-form-file">selecting one<input id="upload-select" type="file"></a>. (5Mb Max)
    </div>

    <div id="progressbar" class="uk-progress uk-hidden">
        <div class="uk-progress-bar" style="width: 0%;">...</div>
    </div>

    <div class="uk-grid-width-small-1-2 uk-grid-width-medium-1-4 uk-grid-width-large-1-6" data-uk-grid="{gutter: 10}">
        @each('laramanager::files.file', $files, 'file')
    </div>

@endsection

@section('scripts')

@endsection