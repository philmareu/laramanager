<script>
    var id = "{{ $id }}";
    var resource = "{{ $resource }}";
    var entityId = "{{ $entity->id }}";

    CKEDITOR.replace(id, {
        customConfig: '/vendor/laramanager/js/ckeditor.js',
        filebrowserImageBrowseUrl: SITE_URL + '/admin/images/browser',
        filebrowserImageUploadUrl: SITE_URL + '/admin/upload/images/' + resource + '/' + entityId + '?_token=' + csrf
    });

</script>