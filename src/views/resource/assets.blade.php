@if($resource->fields->contains('type', 'html'))
    <link rel="stylesheet" href="{{ asset('vendor/laramanager/vendor/codemirror-5.14.2/lib/codemirror.css') }}">

    <script src="{{ asset('vendor/laramanager/vendor/codemirror-5.14.2/lib/codemirror.js') }}"></script>
    <script src="{{ asset('vendor/laramanager/vendor/codemirror-5.14.2/mode/markdown/markdown.js') }}"></script>
    <script src="{{ asset('vendor/laramanager/vendor/codemirror-5.14.2/addon/mode/overlay.js') }}"></script>
    <script src="{{ asset('vendor/laramanager/vendor/codemirror-5.14.2/mode/xml/xml.js') }}"></script>
    <script src="{{ asset('vendor/laramanager/vendor/codemirror-5.14.2/mode/gfm/gfm.js') }}"></script>
    <script src="{{ asset('vendor/laramanager/vendor/marked-0.3.5/marked.min.js') }}"></script>
@endif

@if($resource->fields->contains('type', 'wysiwyg'))
    <script src="{{ asset('vendor/laramanager/js/ckeditor/ckeditor.js') }}"></script>
@endif

@foreach($resource->fields as $field)

    @if(view()->exists('laramanager::fields.' . $field->type . '.scripts'))
        @include('laramanager::fields.' . $field->type . '.scripts', (array) $field)
    @endif

@endforeach