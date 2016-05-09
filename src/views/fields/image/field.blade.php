@inject('image', 'Philsquare\LaraManager\Models\Image')

<div class="uk-form-row field-images">
    <label for="{{ $field->slug }}" class="uk-form-label">{{ $field->title }}</label>

    <div class="uk-placeholder {{ $errors->has($field->slug) ? 'uk-form-danger' : '' }}">
        <div class="uk-grid uk-grid-small uk-sortable images-container" data-uk-sortable>

            @if(null !== old($field->slug))
                @include('laramanager::browser.image', ['image' => $image->find(old($field->slug))])
            @elseif(isset($entity) && $entity->{$field->data['method']})
                @include('laramanager::browser.image', ['image' => $entity->{$field->data['method']}])
            @endif

        </div>
    </div>

    <input type="hidden" name="{{ $field->slug }}" value="{{ $entity->{$field->slug} or ''}}" id="{{ $field->id }}" class="file_id">
    <button type="button" class="uk-button opens-image-browser" data-limit="1"><i class="uk-icon-photo"></i> Browse</button>

</div>