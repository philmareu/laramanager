<script>
    var target = "#" + "{{ $target }}";
    var slug = "#" + "{{ $id }}";
    var type = "{{ $delimiter or "-" }}";

    console.log(type);

    $(function() {
        $(target).slugify({ slug: slug, type: type });
    });
</script>