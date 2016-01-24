<div class="uk-grid uk-margin-bottom" data-uk-grid>
    @foreach($object->data('images') as $filename)
        <div class="uk-width-1-2 uk-width-medium-1-3 uk-width-large-1-4 uk-margin-large-bottom">
            <a href="{{ url('images/large/' . $filename) }}" data-uk-lightbox="{group:'post'}">
                <img src="{{ url('images/small/' . $filename) }}" alt="">
            </a>
        </div>
    @endforeach
</div>