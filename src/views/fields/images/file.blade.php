@if($file)

    <div class="uk-width-1-2 uk-width-medium-1-4 uk-width-large-1-6 uk-margin-bottom">
        <img src="{{ url('images/medium/' . $file->filename) }}" alt=""
             data-laramanager-file-id="{{ $file->id }}"
             data-laramanager-filename="{{ $file->filename }}"
             class="unselected-image">
        <input type="hidden" name="{{ $field->slug }}[]" value="{{ $file->id }}">
    </div>

@endif