@push('scripts-last')
<script>
    let editor = codemirror.fromTextArea(document.getElementById('markdown-{{ $field->id }}'), {
        mode: 'gfm',
        theme: "default"
    })

    editor.on('change', function(event) {
        document.getElementById('parsed-markdown-{{ $field->id }}').innerHTML = marked(editor.getValue());
        document.getElementById('markdown-value-{{ $field->id }}').value = editor.getValue();
    })

    UIkit.util.on('#modal-full', 'beforeshow', function () {

    });
</script>
@endpush