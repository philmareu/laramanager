<div id="images" class="uk-grid uk-grid-small uk-sortable" data-uk-sortable>
    @if(isset($field['value']) && $field['value'] != "")
        @foreach(unserialize($field['value']) as $fileId)

            @include('laramanager::fields.uploads.file', ['file' => \Philsquare\LaraManager\Models\File::find($fileId)])

        @endforeach
    @endif
</div>

<button type="button" class="uk-button" data-uk-modal="{target:'#modal-image-browser-multiple'}">Browse</button>