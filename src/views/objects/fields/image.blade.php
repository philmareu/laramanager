<div class="uk-form-row field-images">

    <label for="data[{{ $name }}]" class="uk-form-label">{{ $label }}</label>

    <div class="uk-placeholder {{ $errors->has('data[' . $name . ']') ? 'uk-form-danger' : '' }}">
        <div class="uk-grid uk-grid-small uk-sortable images-container" data-uk-sortable>
            @if($object->file($name))
                <div class="uk-width-1-2 uk-width-medium-1-4 uk-width-large-1-6 uk-margin-bottom">
                    <img src="{{ url('images/medium/' . $object->file($name)->filename) }}" alt=""/>
                    <input type="hidden" name="data[file_id]" value="{{ $object->data($name) }}">
                </div>
            @endif
        </div>
    </div>

    <input type="hidden" name="data[{{ $name }}]" value="{{ $object->data($name) }}" class="file_id">
    <button type="button" class="uk-button opens-image-browser" data-limit="1"><i class="uk-icon-photo"></i> Browse</button>
</div>