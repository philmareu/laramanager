@inject('file', 'Philsquare\LaraManager\Models\File')
<div id="images" class="uk-grid uk-grid-small">
    @foreach(unserialize($entity->{$field->slug}) as $fileId)
        @include('laramanager::fields.images.file', ['file' => $file->find($fileId)])
    @endforeach
</div>