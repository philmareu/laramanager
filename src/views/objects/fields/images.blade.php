<div class="uk-form-row field-images">

    <label for="data[{{ $name }}]" class="uk-form-label">{{ $label }}</label>

    <div class="uk-placeholder {{ $errors->has('data[file_ids]') ? 'uk-form-danger' : '' }}">
        <div class="uk-grid uk-grid-small uk-sortable images-container" data-uk-sortable>
            @foreach($object->files($name) as $image)
                <div class="uk-width-1-2 uk-width-medium-1-4 uk-width-large-1-6 uk-margin-bottom">
                    <img src="{{ url('images/image-browser/' . $image->filename) }}" alt="{{ $image->alt }}">
                    <input type="hidden" name="data[{{ $name }}][]" value="{{ $image->id }}">
                </div>
            @endforeach
        </div>
    </div>

    <input type="hidden" name="images_field_name" value="data[{{ $name }}]">
    <button type="button" class="uk-button opens-image-browser" data-limit="3"><i class="uk-icon-photo"></i> Browse</button>
</div>