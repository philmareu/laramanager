@extends('laramanager::objects.wrappers.create')

@section('form')

    <div class="uk-form-row field-images">

        <label for="data[photos]" class="uk-form-label">Photos</label>

        <div class="uk-placeholder {{ $errors->has('data[file_ids]') ? 'uk-form-danger' : '' }}">
            <div class="uk-grid uk-grid-small uk-sortable images-container" data-uk-sortable>
            </div>
        </div>

        <input type="hidden" name="images_field_name" value="data[file_ids]">
        <button type="button" class="uk-button opens-image-browser" data-limit="3"><i class="uk-icon-photo"></i> Browse</button>
    </div>

@endsection