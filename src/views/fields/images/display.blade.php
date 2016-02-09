@inject('file', 'Philsquare\LaraManager\Models\File')

@if(is_array(unserialize($entity->{$field->slug})))
    <div id="images" class="uk-grid uk-grid-small">
        @foreach(unserialize($entity->{$field->slug}) as $fileId)
            @include('laramanager::fields.images.file', ['file' => $file->find($fileId)])
        @endforeach
    </div>
@else

<p>No Images Selected</p>

@endif