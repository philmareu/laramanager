<script src="{{ asset('vendor/laramanager/js/ckeditor/ckeditor.js') }}"></script>

<script>
    CKEDITOR.replace('editor', {
        customConfig: '/vendor/laramanager/js/ckeditor.js',
        filebrowserImageBrowseUrl: SITE_URL + '/admin/images/browser'
    });
</script>