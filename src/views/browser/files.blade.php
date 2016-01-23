@extends('laramanager::layouts.browser')

@section('title')
File Browser
@endsection

@section('content')

    <div id="upload-drop" class="uk-placeholder uk-text-center">
        <i class="uk-icon-cloud-upload uk-icon-medium uk-text-muted uk-margin-small-right"></i>
        Drag files here or <a class="uk-form-file">selecting one<input id="upload-select" type="file"></a>. (5Mb Max)
    </div>

    <div id="progressbar" class="uk-progress uk-hidden">
        <div class="uk-progress-bar" style="width: 0%;">...</div>
    </div>

    <div id="file-gallery" class="uk-grid">
        @each('laramanager::browser.file', $files, 'file')
    </div>

    {!! $files->render() !!}
@endsection

@section('scripts')
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

                        response = $.parseJSON(response);

//                        if(response.status == 'ok') {
//                            $('#file-gallery').append(response.data.html);
//                        }
                    },

                    allcomplete: function(response) {

                        bar.css("width", "100%").text("100%");

                        setTimeout(function(){
                            progressbar.addClass("uk-hidden");
                        }, 250);

                        location.reload(true);
                    }
                };

        var select = UIkit.uploadSelect($("#upload-select"), settings),
                drop   = UIkit.uploadDrop($("#upload-drop"), settings);
    </script>
@endsection