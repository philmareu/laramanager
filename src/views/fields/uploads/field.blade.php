<div class="uk-form-row">
    <span class="errors">{{ $errors->first($field['name']) }}</span>
    <label for="{{ $field['name'] }}" class="uk-form-label">{!! isset($field['label']) ? $field['label'] : ucwords(str_replace('_', ' ', $field['name'])) !!}</label>

    <div class="uk-placeholder {{ $errors->has($field['name']) ? 'uk-form-danger' : '' }}">
        <div id="images" class="uk-grid uk-grid-small uk-sortable" data-uk-sortable>

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

    <button type="button" class="uk-button" data-uk-modal="{target:'#modal-image-browser-multiple'}"><i class="uk-icon-photo"></i> Browse</button>
</div>