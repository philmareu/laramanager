@extends('laramanager::layouts.default')

@section('title')
    Images
@endsection

@section('actions')
    <a href="{{ route('admin.resources.create') }}" class="uk-float-right"><i class="uk-icon-plus"></i> Add</a>
@endsection

@section('content')

    <div id="upload-drop" class="uk-placeholder uk-text-center">
        <i class="uk-icon-cloud-upload uk-icon-medium uk-text-muted uk-margin-small-right"></i>
        Drag images here or <a class="uk-form-file">selecting one<input id="upload-select" type="file"></a>. (5Mb Max)
    </div>

    <div id="progressbar" class="uk-progress uk-hidden">
        <div class="uk-progress-bar" style="width: 0%;">...</div>
    </div>

    <div class="uk-grid-width-1-2 uk-grid-width-small-1-2 uk-grid-width-medium-1-4 uk-grid-width-large-1-6" id="images">
        @each('laramanager::images.image', $images, 'image')
    </div>

    {!! $images->render() !!}

    <div id="image-modal" class="uk-modal">
        <div class="uk-modal-dialog uk-modal-dialog-large">
            <a class="uk-modal-close uk-close"></a>
            <div class="modal-content">
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $('.pagination').attr('class', 'uk-pagination');
        var ImageBrowserModal = $('#image-modal');
        var spinnerHTML = '<i class="uk-icon-spinner uk-icon-spin"></i>';
        UIkit.grid('#images', {gutter: 10});
        function getModal(uri) {

            updateModal('<div class="modal-spinner uk-text-center"><i class="uk-icon-spinner uk-icon-spin uk-icon-large"></i>');
            UIkit.modal(ImageBrowserModal).show();

            $.ajax({
                type: "GET",
                url: SITE_URL + uri,
                success: function(response) {
                    updateModal(response.data.html);
                },
                error: function(response, status, error) {
                    if(response.status == 401) {
                        window.location = SITE_URL + '/admin/auth/login';
                    }
                }
            });
            return false;

        }

        function updateModal(html) {
            $('.modal-content').html( html );
        }

        $('#images').on('click', '.image', function(event) {
            var imageId = $(this).attr('data-laramanager-image-id');

            getModal('/admin/images/' + imageId + '/edit');
        });

        ImageBrowserModal.on('submit', '#update-image', function(event) {

            event.preventDefault();
            var form = $(this);
            var data = form.serialize();
            var button = form.find('input[type=submit]');
            button.val('Updating...');

            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: data,
                success: function load(response) {
                    if(response.errors) {
                        alert(response.errors)
                    }

                    $('.url').html(response.data.url);
                    button.val('Update');
                },
                error: function(response, status, error) {
                    if(response.status == 401) {
                        window.location = SITE_URL + '/admin/auth/login';
                    }
                }
            });

        });

        var progressbar = $("#progressbar"),
                bar         = progressbar.find('.uk-progress-bar'),
                settings    = {

                    action: SITE_URL + '/admin/images/upload', // upload url

                    allow : '*.(jpg|jpeg|gif|png)', // allow only pngs

                    param: 'image',

                    params: {_token: csrf, view: 'images.image'},

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

                        if(response.status == 'ok') {

                        }
                    },

                    allcomplete: function(response) {

                        bar.css("width", "100%").text("100%");

                        setTimeout(function(){
                            progressbar.addClass("uk-hidden");
                        }, 250);

                        location.reload(true);
                    }
                };

        var selectSingle = UIkit.uploadSelect($("#upload-select"), settings),
                dropSingle   = UIkit.uploadDrop($("#upload-drop"), settings);
    </script>
@endsection