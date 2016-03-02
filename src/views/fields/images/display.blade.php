@inject('image', 'Philsquare\LaraManager\Models\Image')

@if(is_array(unserialize($entity->{$field->slug})))
    <div id="images" class="uk-grid uk-grid-small">
        @foreach(unserialize($entity->{$field->slug}) as $imageId)
            @include('laramanager::browser.image', ['image' => $image->find($imageId)])
        @endforeach
    </div>
@else

<p>No Images Selected</p>

@endif