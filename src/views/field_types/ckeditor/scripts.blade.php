<script>
    var id = "editor";

    console.log(ckeditor)

    ckeditor
        .create( document.querySelector( '#editor' ) )
        .then( editor => {
            console.log( editor );
        } )
        .catch( error => {
            console.error( error );
        } );

    // CKEDITOR.replace(id, {
    //     customConfig: '/vendor/laramanager/js/ckeditor.js',
    //     filebrowserImageBrowseUrl: SITE_URL + '/admin/images/browser',
    // });

</script>
