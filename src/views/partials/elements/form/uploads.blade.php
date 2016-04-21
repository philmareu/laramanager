@extends('laramanager::partials.wrappers.form')

@section('field')

    <div id="upload-drop" class="uk-placeholder uk-text-center">
        <i class="uk-icon-cloud-upload uk-icon-medium uk-text-muted uk-margin-small-right"></i>
        Drag files here or <a class="uk-form-file">selecting one<input id="upload-select" type="file"></a>. (5Mb Max)
    </div>

    <div id="file-gallery" class="uk-grid">
        @if(isset($field['value']))
            @each('laraform::elements.form.displays.file', $field['value'], 'file')
        @endif
    </div>

    <div id="progressbar" class="uk-progress uk-hidden">
        <div class="uk-progress-bar" style="width: 0%;">...</div>
    </div>

@overwrite