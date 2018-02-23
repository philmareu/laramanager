{{--@inject('image', 'Philsquare\LaraManager\Models\LaramanagerImage')--}}
{{--<div class="uk-form-row field-images">--}}

    {{--<label for="{{ $field->slug }}" class="uk-form-label">{{ $field->title }}</label>--}}

    {{--<div class="uk-placeholder {{ $errors->has($field->slug) ? 'uk-form-danger' : '' }}">--}}
        {{--<div class="uk-grid uk-grid-small uk-sortable images-container" data-uk-sortable>--}}

            {{--@if(null !== old($field->slug))--}}
                {{--@foreach(old($field->slug) as $imageId)--}}
                    {{--@include('laramanager::fields.images.image', ['image' => $image->find($imageId)])--}}
                {{--@endforeach--}}
            {{--@elseif(isset($entity) && $entity->{$field->data['method']}->count())--}}
                {{--@foreach($entity->{$field->data['method']} as $image)--}}
                    {{--@include('laramanager::fields.images.image', ['image' => $image])--}}
                {{--@endforeach--}}
            {{--@endif--}}
        {{--</div>--}}
    {{--</div>--}}

    {{--<input type="hidden" name="images_field_name" value="{{ $field->slug }}">--}}
    {{--<button type="button" class="uk-button opens-image-browser" data-limit="3"><i class="uk-icon-photo"></i> Browse</button>--}}
{{--</div>--}}

<images-field :field="{{ $field }}"
             :selected-image="selectedImage"
             :active-field="activeField" v-on:open-browser="openBrowser"></images-field>