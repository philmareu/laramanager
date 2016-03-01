@inject('image', 'Philsquare\LaraManager\Models\Image')
<div class="uk-form-row field-images">

    <label for="{{ $field->slug }}" class="uk-form-label">{{ $field->title }}</label>

    <div class="uk-placeholder {{ $errors->has($field->slug) ? 'uk-form-danger' : '' }}">
        <div class="uk-grid uk-grid-small uk-sortable images-container" data-uk-sortable>

            @if(null !== old($field->slug))
                @foreach(old($field->slug) as $imageId)
                    @include('laramanager::fields.images.image', ['image' => $image->find($imageId)])
                @endforeach
            @elseif(isset($entity) && $entity->{$field->slug} != "" && is_array(unserialize($entity->{$field->slug})))
                @foreach(unserialize($entity->{$field->slug}) as $imageId)
                    @include('laramanager::fields.images.image', ['image' => $image->find($imageId)])
                @endforeach
            @endif
        </div>
    </div>

    <input type="hidden" name="images_field_name" value="{{ $field->slug }}">
    <button type="button" class="uk-button opens-image-browser" data-limit="3"><i class="uk-icon-photo"></i> Browse</button>
</div>