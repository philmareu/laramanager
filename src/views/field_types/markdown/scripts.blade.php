@push('scripts-last')
<script>

    UIkit.util.on('#modal-markdown-{{ $field->id }}', 'shown', function () {

        let editor = codemirror.fromTextArea(document.getElementById('markdown-{{ $field->id }}'), {
            mode: 'gfm',
            theme: "default",
            lineWrapping: true,
        })

        editor.focus()
        document.getElementById('parsed-markdown-{{ $field->id }}').innerHTML = marked(editor.getValue());

        editor.on('change', function(event) {
            document.getElementById('parsed-markdown-{{ $field->id }}').innerHTML = marked(editor.getValue());
            document.getElementById('markdown-value-{{ $field->id }}').value = editor.getValue();
        })
    });
</script>
@endpush
