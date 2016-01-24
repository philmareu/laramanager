<div class="uk-margin-bottom" data-uk-grid>
    @foreach($object->data('images') as $filename)
        <div class="uk-width-1-2 uk-width-medium-1-3 uk-width-large-1-4">
            <a href="{{ url('images/gallery-large/' . $filename) }}" data-uk-lightbox="{group:'post'}">
                <img src="{{ url('images/post-gallery-small/' . $filename) }}" alt="">
            </a>
        </div>
    @endforeach
</div>