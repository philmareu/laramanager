<script>
    var target = "#" + "{{ $target }}";
    var slug = "#" + "{{ $id }}";

    $(function() {
        $(target).slugify({ slug: slug, type: "-" });
    });
</script>