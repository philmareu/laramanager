<script>
    var target = "#" + "{{ $target }}";
    var slug = "#" + "{{ $id }}";
    var type = "{{ $delimiter or "-" }}";

    $(function() {
        $(target).slugify({ slug: slug, type: type });
    });
</script>