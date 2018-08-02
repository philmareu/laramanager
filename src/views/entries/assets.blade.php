<script src="{{ asset('vendor/laramanager/js/ckeditor/ckeditor.js') }}"></script>

@foreach($resource->fields as $field)

    @if(view()->exists($field->fieldType->getViewPath('scripts')))
        @include($field->fieldType->getViewPath('scripts'), (array) $field)
    @endif

@endforeach