<div id="images" class="uk-grid uk-grid-small">
    @foreach($entity->{$field->data['method']} as $image)
        @include('laramanager::browser.image', ['image' => $image])
    @endforeach
</div>