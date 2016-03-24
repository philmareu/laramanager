@if($object->data('file_ids') == "")

    <p>No Images</p>

@else

    <div class="uk-grid uk-margin-bottom" data-uk-grid>
        @foreach($object->files('file_ids') as $image)
            <div class="uk-width-1-2 uk-width-medium-1-3 uk-width-large-1-4 uk-margin-large-bottom">
                <a href="{{ url('images/large/' . $image->filename) }}" data-uk-lightbox="{group:'post'}">
                    <img src="{{ url('images/small/' . $image->filename) }}" alt="{{ $image->alt }}">
                </a>
            </div>
        @endforeach
    </div>

@endif