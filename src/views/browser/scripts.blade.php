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
                        $('#upload-images').find('.image-browser-images').append(response.data.html);
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
            img.clone().appendTo(wrapper).toggleClass('unselected-image').toggleClass('selected-image').attr('style', '');

            var input = $('<input>', {
                type: 'hidden',
                name: fieldName +'[]',
                value: img.attr('data-laramanager-image-id')
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
            var img = $(this).clone().attr('style', '');
            imagesContainer.html(img);
            imagesContainer.parents('.field-images').find('.file_id').attr('value', img.attr('data-laramanager-image-id'));
            hideImageBrowser();
        });
    }


    ImageBrowser.find('#selected-images').on('click', 'img', function(event) {

        $(this).parent().remove();

    });

    $(function() {

        var allImagesPanelImages = $('#all-images').find('.image-browser-images');
        var searchResultsImages = $('#search-images').find('.image-browser-images');

        $(ImageBrowser).on('show.uk.modal', function() {

            if(allImagesPanelImages.find('div').length == 0) {
                $.ajax({
                    type: 'GET',
                    url: SITE_URL + '/admin/images',
                    success: function(response) {
                        allImagesPanelImages.html(response.images);
                        UIkit.grid(allImagesPanelImages, {gutter: 10, animation: false});
                    }
                });
            }
        });

        $('.load-more').on('click', function(event) {
            event.preventDefault();

            var page = $('.page-number');
            var nextPage = parseInt(page.text()) + 1;

            $.ajax({
                type: 'GET',
                url: SITE_URL + '/admin/images?page=' + nextPage,
                success: function(response) {
                    allImagesPanelImages.append(response.images);
                    page.text(nextPage);
                }
            })
        });

        $('form.search-images').on('submit', function(event) {
            event.preventDefault();

            var form = $(this);
            var data = form.serialize();
            var action = form.attr('action');

            $.ajax({
                type: 'POST',
                url: action,
                data: data,
                success: function(response) {
                    if(response.images == "") {
                        searchResultsImages.html("No Images Found.");
                    } else {
                        searchResultsImages.append(response.images);
                    }
                },
                complete: function(response, status) {

                }
            })
        });
    });

</script>