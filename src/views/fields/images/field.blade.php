<div class="uk-form-row field-images">

    <label for="{{ $field->slug }}" class="uk-form-label">{{ $field->title }}</label>

    <div class="uk-placeholder {{ $errors->has($field->slug) ? 'uk-form-danger' : '' }}">
        <div class="uk-grid uk-grid-small uk-sortable images-container" data-uk-sortable>

            @if(null !== old('photos'))
                @foreach(old('photos') as $fileId)
                    @include('laramanager::fields.uploads.file', ['file' => \Philsquare\LaraManager\Models\File::find($fileId)])
                @endforeach
            @elseif(isset($field['value']) && $field['value'] != "")
                @foreach(unserialize($field['value']) as $fileId)

                    @include('laramanager::fields.uploads.file', ['file' => \Philsquare\LaraManager\Models\File::find($fileId)])

                @endforeach
            @endif
        </div>
    </div>

    <input type="hidden" name="images_field_name" value="{{ $field->slug }}">
    <button type="button" class="uk-button opens-image-browser" data-limit="3"><i class="uk-icon-photo"></i> Browse</button>
</div>