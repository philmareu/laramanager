<div id="markdown-parsed-{{ $field->id }}"></div>

<div id="markdown-{{ $field->id }}" class="uk-hidden">{{ $entity->{$field->slug} }}</div>

@push('scripts-last')
    <script>
        document.getElementById('markdown-parsed-{{ $field->id }}').innerHTML = marked(
            document.getElementById('markdown-' + {{ $field->id }}).innerHTML
        );
    </script>
@endpush