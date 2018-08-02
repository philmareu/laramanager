<script>
    var id = "editor";

    CKEDITOR.replace(id, {
        customConfig: '/vendor/laramanager/js/ckeditor.js',
        filebrowserImageBrowseUrl: SITE_URL + '/admin/images/browser',
    });

</script>