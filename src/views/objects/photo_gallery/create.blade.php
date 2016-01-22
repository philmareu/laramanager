@extends('laramanager::objects.wrappers.create')

@section('form')

    <div id="upload-drop" class="uk-placeholder uk-text-center">
        <i class="uk-icon-cloud-upload uk-icon-medium uk-text-muted uk-margin-small-right"></i>
        Drag files here or <a class="uk-form-file">selecting one<input id="upload-select" type="file"></a>. (10Mb Max)
    </div>

    <div id="file-gallery" class="uk-grid">&nbsp;</div>

    <div id="progressbar" class="uk-progress uk-hidden">
        <div class="uk-progress-bar" style="width: 0%;">...</div>
    </div>

@endsection