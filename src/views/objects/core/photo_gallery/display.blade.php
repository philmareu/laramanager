@if($object->data('file_ids') == "")

    <p>No Images</p>

@else

    <div class="uk-grid" data-uk-grid>
        @foreach($object->images('file_ids') as $image)
            <div class="uk-width-1-2 uk-width-1-4@s">
                <a href="{{ url('images/original/' . $image->filename) }}" data-uk-lightbox="{group:'post'}">
                    <img src="{{ url('images/image-browser/' . $image->filename) }}" alt="{{ $image->alt }}">
                </a>
            </div>
        @endforeach
    </div>

@endif