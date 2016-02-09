@inject('file', 'Philsquare\LaraManager\Models\File')

@extends('laramanager::objects.wrappers.edit')

@section('form')

    <div class="uk-form-row field-images">

        <label for="data[photos]" class="uk-form-label">Photos</label>

        <div class="uk-placeholder {{ $errors->has('data[file_ids]') ? 'uk-form-danger' : '' }}">
            <div class="uk-grid uk-grid-small uk-sortable images-container" data-uk-sortable>
                @foreach($object->files('file_ids') as $file)
                    <div class="uk-width-1-2 uk-width-medium-1-4 uk-width-large-1-6 uk-margin-bottom">
                        <img src="{{ url('images/medium/' . $file->filename) }}" alt=""/>
                        <input type="hidden" name="data[file_ids][]" value="{{ $file->id }}">
                    </div>
                @endforeach
            </div>
        </div>

        <input type="hidden" name="images_field_name" value="data[file_ids]">
        <button type="button" class="uk-button opens-image-browser" data-limit="3"><i class="uk-icon-photo"></i> Browse</button>
    </div>

@endsection