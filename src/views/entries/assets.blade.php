@if($resource->fields->contains('type', 'wysiwyg'))
    <script src="{{ asset('vendor/laramanager/js/ckeditor/ckeditor.js') }}"></script>
@endif

@foreach($resource->fields as $field)

    @if(view()->exists('laramanager::fields.' . $field->type . '.scripts'))
        @include('laramanager::fields.' . $field->type . '.scripts', (array) $field)
    @endif

@endforeach