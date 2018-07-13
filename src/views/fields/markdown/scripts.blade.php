<script>
    _.forEach(document.getElementsByClassName('field-markdown'), function(field) {
        codemirror.fromTextArea(field, {
            mode: 'gfm',
            theme: "default",
            extraKeys: {"Enter": "newlineAndIndentContinueMarkdownList"}
        })
    });
</script>