@include('laramanager::browser.scripts')

<script>
    $('#modal-image-browser-single').on('click', 'img.select-image', function(event) {

        var imagesContainer = $('#images');
        var wrapper = $('<div>', {
            class: 'image'
        });

        var img = $(this).clone().appendTo(wrapper);
        var input = $('<input>', {
            type: 'hidden',
            name: 'files[]',
            value: img.attr('data-laramanager-file-id')
        }).appendTo(wrapper);

        wrapper.appendTo(imagesContainer);

        UIkit.modal("#modal-image-browser-single").hide();

    });
</script>