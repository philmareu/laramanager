@extends('laramanager::layouts.default')

@section('title')
    Images
@endsection

@section('content')

    <!-- This is the tabbed navigation containing the toggling elements -->
    <ul class="uk-tab" data-uk-tab="{connect:'#browser-tabs'}">
        <li><a href="">All</a></li>
        <li><a href="">Search</a></li>
        <li><a href="">Upload</a></li>
    </ul>

    <!-- This is the container of the content items -->
    <ul id="browser-tabs" class="uk-switcher uk-margin uk-tab-center">
        <li id="all-images">
            <div class="uk-grid-width-1-2 uk-grid-width-small-1-2 uk-grid-width-medium-1-4 uk-grid-width-large-1-6 image-browser-images uk-margin-bottom" id="images">
                @each('laramanager::browser.image', $images, 'image')
            </div>

            <div>
                {!! $images->render() !!}
            </div>
        </li>
        <li id="search-images">
            <form action="{{ url('admin/images/search') }}" method="POST" class="uk-form uk-form-horizontal search-images uk-margin-bottom">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="uk-form-icon">
                    <i class="uk-icon-search"></i>
                    <input type="text" name="term">
                </div>
                <input type="submit" name="search" value="Search" class="uk-button">
            </form>

            <div class="uk-overflow-container">
                <div class="image-browser-images uk-grid-width-1-2 uk-grid-width-small-1-2 uk-grid-width-medium-1-4 uk-grid-width-large-1-6 uk-margin-bottom" data-uk-observe data-uk-grid="{gutter: 10, animation: false}">
                </div>
            </div>
        </li>
        <li id="upload-images">
            <div id="upload-drop" class="uk-placeholder uk-text-center">
                <i class="uk-icon-cloud-upload uk-icon-medium uk-text-muted uk-margin-small-right"></i>
                Drag images here or <a class="uk-form-file">selecting one<input id="upload-select" type="file"></a>. (20Mb Max)
            </div>

            <div id="progressbar" class="uk-progress uk-hidden">
                <div class="uk-progress-bar" style="width: 0%;">...</div>
            </div>

            <div class="uk-overflow-container">
                <div class="image-browser-images uk-grid-width-1-2 uk-grid-width-small-1-2 uk-grid-width-medium-1-4 uk-grid-width-large-1-6" data-uk-observe data-uk-grid>
                </div>
            </div>
        </li>
    </ul>

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
        $('.disabled').attr('class', 'uk-disabled');
        $('.active').attr('class', 'uk-active');

        var ImageBrowserModal = $('#image-modal');
        var spinnerHTML = '<i class="uk-icon-spinner uk-icon-spin"></i>';

        $(function() {
            UIkit.grid('#images', {gutter: 10, animation: false});
        });

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

        $('.image-browser-images').on('click', 'img', function(event) {
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
                            console.log($('#upload-images').find('.image-browser-images'));
                            $('#upload-images').find('.image-browser-images').append(response.data.html);
                        }
                    },

                    allcomplete: function(response) {

                        bar.css("width", "100%").text("100%");

                        setTimeout(function(){
                            progressbar.addClass("uk-hidden");
                        }, 250);

//                        location.reload(true);
                    }
                };

        var selectSingle = UIkit.uploadSelect($("#upload-select"), settings),
                dropSingle   = UIkit.uploadDrop($("#upload-drop"), settings);

        var searchResultsImages = $('#search-images').find('.image-browser-images');

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
                    searchResultsImages.html('');
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
    </script>
@endsection