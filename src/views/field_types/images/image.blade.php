@if($image)

    <div class="uk-width-1-2 uk-width-medium-1-4 uk-width-large-1-6 uk-margin-bottom">
        <img src="{{ url('images/medium/' . $image->filename) }}" alt="{{ $image->alt }}"
             data-laramanager-file-id="{{ $image->id }}"
             data-laramanager-filename="{{ $image->filename }}"
             class="unselected-image">
        <input type="hidden" name="{{ $field->slug }}[]" value="{{ $image->id }}">
    </div>

@endif