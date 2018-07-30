<script>
    var target = "{{ $field->data['target'] }}";

    $(function() {
        $('input[name="' + target + '"]').slugify({ slug: '#slug', type: "-" });
    });
</script>