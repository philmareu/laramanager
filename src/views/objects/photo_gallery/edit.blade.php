@extends('laramanager::objects.wrappers.edit')

@section('form')

    <div class="uk-form-row">
        <span class="errors">{{ $errors->first('photos') }}</span>
        <label for="photos" class="uk-form-label">Photos</label>

        <div class="uk-placeholder {{ $errors->has('photos') ? 'uk-form-danger' : '' }}">
            <div id="images" class="uk-grid uk-grid-small uk-sortable" data-uk-sortable>
                @foreach($object->files('file_ids') as $file)
                    <div class="uk-width-1-2 uk-width-medium-1-4 uk-width-large-1-6 uk-margin-bottom">
                        <img src="{{ url('images/medium/' . $file->filename) }}" alt=""/>
                        <input type="hidden" name="data[file_ids][]" value="{{ $file->id }}">
                    </div>
                @endforeach
            </div>
        </div>

        <button type="button" class="uk-button" data-uk-modal="{target:'#modal-image-browser-multiple'}"><i class="uk-icon-photo"></i> Browse</button>
    </div>

@endsection