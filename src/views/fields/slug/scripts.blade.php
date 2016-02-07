<script>
    var target = "{{ $field->slug }}";

    $(function() {
        $('input[name=" + target + "]').slugify({ slug: '#slug', type: "-" });
    });
</script>