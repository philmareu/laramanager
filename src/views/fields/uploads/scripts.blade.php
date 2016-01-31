@include('laramanager::browser.scripts')

<script>

    var name = "{{ $field['name'] }}";

    $('#modal-image-browser-single').on('click', 'img.select-image', function(event) {

        var imagesContainer = $('#images');
        var wrapper = $('<div>', {
            class: 'image uk-width-1-6'
        });

        var img = $(this).clone().appendTo(wrapper);
        var input = $('<input>', {
            type: 'hidden',
            name: name + '[]',
            value: img.attr('data-laramanager-file-id')
        }).appendTo(wrapper);
        var button = $('<button>', {
            type: 'button',
            class: 'uk-button uk-button-danger uk-width-1-1 delete'
        }).text('Remove').appendTo(wrapper);

        wrapper.appendTo(imagesContainer);

        UIkit.modal("#modal-image-browser-single").hide();
    });

    $('#images').on('click', '.delete', function(event) {
        $(this).parent().remove();
    })
</script>