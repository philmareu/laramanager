<script>

    $('.pagination').attr('class', 'uk-pagination');

    var progressbar = $("#progressbar"),
            bar         = progressbar.find('.uk-progress-bar'),
            settings    = {

                action: SITE_URL + '/admin/files/upload', // upload url

                allow : '*.(jpg|jpeg|gif|png)', // allow only pngs

                param: 'file',

                params: {_token: csrf},

                loadstart: function() {
                    bar.css("width", "0%").text("0%");
                    progressbar.removeClass("uk-hidden");
                },

                progress: function(percent) {
                    percent = Math.ceil(percent);
                    bar.css("width", percent+"%").text(percent+"%");
                },

                complete: function(response, xhr) {

                    bar.css("width", "0%").text("0%");
                    response = $.parseJSON(response);

                    if(response.status == 'ok') {
                        $('#file-gallery').prepend(response.data.html);
                    }
                },

                allcomplete: function(response) {

                    bar.css("width", "100%").text("100%");

                    setTimeout(function(){
                        progressbar.addClass("uk-hidden");
                    }, 250);

//                    location.reload(true);
                }
            };

    var select = UIkit.uploadSelect($("#upload-select"), settings),
            drop   = UIkit.uploadDrop($("#upload-drop"), settings);

    var ImageBrowserMultiple = $('#modal-image-browser-multiple');

    ImageBrowserMultiple.on('show.uk.modal', function() {

        var i = $('#images').html();

        ImageBrowserMultiple.find('#image-list .images').html(i);


    });

    ImageBrowserMultiple.on('click', 'img.unselected-image', function(event) {

        console.log(name);

        var wrapper = $('<div>', {
            class: 'uk-width-1-2 uk-width-medium-1-4 uk-width-large-1-6 uk-margin-bottom'
        });

        var img = $(this);
        img.clone().appendTo(wrapper).toggleClass('unselected-image').toggleClass('selected-image');

        var input = $('<input>', {
            type: 'hidden',
            name: 'photos[]',
            value: img.attr('data-laramanager-file-id')
        }).appendTo(wrapper);

        $('#selected-images .images').append(wrapper);

    });

    ImageBrowserMultiple.on('click', '.cancel', function() {
        UIkit.modal(ImageBrowserMultiple).hide();
        $('#selected-images .images').html('');
    });

    ImageBrowserMultiple.on('click', '.done', function() {
        UIkit.modal(ImageBrowserMultiple).hide();

        var selectedImages = ImageBrowserMultiple.find('#selected-images .images').html();
        $('#images').html(selectedImages);
        $('#selected-images .images').html('');
    });

    ImageBrowserMultiple.find('#selected-images').on('click', 'img', function(event) {

        $(this).parent().remove();

    });

    $('#modal-image-browser-single').on('click', 'img.select-image', function(event) {

        var img = $(this).clone();
        var field = $('.field-image');

        field.find('.image').html(img);
        field.find('.file_id').attr('value', img.attr('data-laramanager-file-id'));

        UIkit.modal("#modal-image-browser-single").hide();

    });

</script>