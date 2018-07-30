<div id="images" class="uk-child-width-1-2 uk-child-width-1-4@s" uk-grid>
    @foreach($entry->{$field->data['method']} as $image)
        @include('laramanager::browser.image', ['image' => $image])
    @endforeach
</div>