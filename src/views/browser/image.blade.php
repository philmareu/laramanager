@if(isset($image))
    <div class="uk-width-1-2 uk-width-medium-1-4 uk-width-large-1-6">
        <img src="{{ url('images/image-browser/' . $image->filename) }}" alt=""
             data-laramanager-file-id="{{ $image->id }}"
             data-laramanager-filename="{{ $image->filename }}"
             class="unselected-image">
    </div>
@endif