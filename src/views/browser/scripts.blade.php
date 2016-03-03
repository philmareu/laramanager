<script>

    $('.pagination').attr('class', 'uk-pagination');

    var progressbar = $("#progressbar"),
            bar         = progressbar.find('.uk-progress-bar'),
            settings    = {

                action: SITE_URL + '/admin/images/upload', // upload url

                allow : '*.(jpg|jpeg|gif|png)', // allow only pngs

                param: 'image',

                params: {_token: csrf, view: 'browser.image'},

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
                        $('#image-browser-images').prepend(response.data.html);
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

    var selectSingle = UIkit.uploadSelect($("#upload-select"), settings),
            dropSingle   = UIkit.uploadDrop($("#upload-drop"), settings);

    var ImageBrowser = $('#modal-image-browser');

    $('.opens-image-browser').on('click', function(event) {

        var button = $(this);
        var limit = button.data('limit');
        var imagesContainer = button.parents('.field-images').find('.images-container');
        var fieldName = button.parents('.field-images').find('input[name="images_field_name"]').val();

        if(limit == 1) {
            $('.uk-modal-footer').hide();
            setOneClick(imagesContainer);
        } else {
            var currentlySelectedImages = imagesContainer.html();
            ImageBrowser.find('#selected-images .images').html(currentlySelectedImages);
            setDoneButton(imagesContainer);
            setMultipleClicks(fieldName);
            $('.uk-modal-footer').show();
        }

        showImageBrowser();

    });

    function hideImageBrowser() {
        ImageBrowser.find('#selected-images .images').html('');
        UIkit.modal(ImageBrowser).hide();
    }

    function showImageBrowser() {
        UIkit.modal(ImageBrowser).show();
    }

    function setMultipleClicks(fieldName) {
        ImageBrowser.on('click', 'img.unselected-image', function(event) {

            var wrapper = $('<div>', {
                class: 'uk-width-1-2 uk-width-medium-1-4 uk-width-large-1-6 uk-margin-bottom'
            });

            var img = $(this);
            img.clone().appendTo(wrapper).toggleClass('unselected-image').toggleClass('selected-image');

            var input = $('<input>', {
                type: 'hidden',
                name: fieldName +'[]',
                value: img.attr('data-laramanager-file-id')
            }).appendTo(wrapper);

            $('#selected-images .images').append(wrapper);

        });
    }

    ImageBrowser.on('click', '.cancel', function() {
        ImageBrowser.off('click', '.done');
        ImageBrowser.off('click', 'img.unselected-image');
        hideImageBrowser();
    });

    function setDoneButton(imagesContainer) {
        ImageBrowser.one('click', '.done', function() {
            var selectedImages = ImageBrowser.find('#selected-images .images').html();
            imagesContainer.html(selectedImages);
            ImageBrowser.off('click', 'img.unselected-image');
            hideImageBrowser();
        });
    }

    function setOneClick(imagesContainer) {
        ImageBrowser.one('click', 'img.unselected-image', function(event) {
            var img = $(this).clone();
            imagesContainer.html(img);
            imagesContainer.parents('.field-images').find('.file_id').attr('value', img.attr('data-laramanager-file-id'));
            hideImageBrowser();
        });
    }


    ImageBrowser.find('#selected-images').on('click', 'img', function(event) {

        $(this).parent().remove();

    });

    $(function() {
        $(ImageBrowser).on('show.uk.modal', function() {
            UIkit.grid('#image-browser-images', {gutter: 10, animation: false});
        });
    });

</script>