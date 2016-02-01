@extends('laramanager::objects.wrappers.create')

@section('form')

    <div class="uk-form-row">
        <span class="errors">{{ $errors->first('photos') }}</span>
        <label for="photos" class="uk-form-label">Photos</label>

        <div class="uk-placeholder {{ $errors->has('photos') ? 'uk-form-danger' : '' }}">
            <div id="images" class="uk-grid uk-grid-small uk-sortable" data-uk-sortable>
                @if(null !== old('photos'))

                @endif
            </div>
        </div>

        <button type="button" class="uk-button" data-uk-modal="{target:'#modal-image-browser-multiple'}"><i class="uk-icon-photo"></i> Browse</button>
    </div>

@endsection