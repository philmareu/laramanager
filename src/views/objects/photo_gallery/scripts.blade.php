<script>
    var progressbar = $("#progressbar"),
            bar         = progressbar.find('.uk-progress-bar'),
            settings    = {

                action: SITE_URL + '/admin/files/upload', // upload url

                allow : '*.(jpg|jpeg|gif|png)',

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

                    response = $.parseJSON(response);

                    if(response.status == 'ok') {
                        $('#file-gallery').append(response.data.html);

                        $('<input>', {
                            type: 'hidden',
                            name: 'data[images][]',
                            value: response.data.file.filename
                        }).appendTo('#file-gallery');
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

//    $('#file-gallery').on('click', '.delete-file', function(event) {
//        event.preventDefault();
//
//        var file = $(this).parents('.file');
//        var fileId = $(this).attr('data-laraform-file-id');
//
//        $.ajax({
//            url: SITE_URL + '/admin/delete-file',
//            type: 'POST',
//            data: {_token: csrf, id: fileId},
//            success: function(response) {
//                if(response.status == 'ok') {
//                    file.remove();
//                }
//            }
//        })
//    });
</script>