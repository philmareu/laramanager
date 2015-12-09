<script>
    var allow = "{{ $allow }}";
    var validation = "{{ $validation }}";

    var progressbar = $("#progressbar"),
            bar         = progressbar.find('.uk-progress-bar'),
            settings    = {

                action: SITE_URL + '/admin/uploads/resource', // upload url

                allow : allow, // allow only pngs

                param: 'file',

                params: {_token: csrf, validation: validation},

                loadstart: function() {
                    bar.css("width", "0%").text("0%");
                    progressbar.removeClass("uk-hidden");
                },

                progress: function(percent) {
                    percent = Math.ceil(percent);
                    bar.css("width", percent+"%").text(percent+"%");
                },

                complete: function(response) {
                    console.log(response);
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
</script>