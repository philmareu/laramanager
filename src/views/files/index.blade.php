@extends('laramanager::layouts.default')

@section('title')
    Files
@endsection

@section('actions')
    <a href="{{ route('admin.resources.create') }}" class="uk-float-right"><i class="uk-icon-plus"></i> Add</a>
@endsection

@section('content')

    <div id="file-modal" class="uk-modal">
        <div class="uk-modal-dialog uk-modal-dialog-large">
            <a class="uk-modal-close uk-close"></a>
            <div class="modal-content">
            </div>
        </div>
    </div>

    <div id="upload-drop" class="uk-placeholder uk-text-center">
        <i class="uk-icon-cloud-upload uk-icon-medium uk-text-muted uk-margin-small-right"></i>
        Drag files here or <a class="uk-form-file">selecting one<input id="upload-select" type="file"></a>. (5Mb Max)
    </div>

    <div id="progressbar" class="uk-progress uk-hidden">
        <div class="uk-progress-bar" style="width: 0%;">...</div>
    </div>

    <div class="uk-grid-width-small-1-2 uk-grid-width-medium-1-4 uk-grid-width-large-1-6" id="files" data-uk-grid="{gutter: 10}">
        @each('laramanager::files.file', $files, 'file')
    </div>

@endsection

@section('scripts')
    <script>
        var FileBrowserModal = $('#file-modal');
        var spinnerHTML = '<i class="uk-icon-spinner uk-icon-spin"></i>';

        function getModal(uri) {

            updateModal('<div class="modal-spinner uk-text-center"><i class="uk-icon-spinner uk-icon-spin uk-icon-large"></i>');
            UIkit.modal(FileBrowserModal).show();

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

        $('#files').on('click', '.file', function(event) {
            var fileId = $(this).attr('data-laramanager-file-id');

            getModal('/admin/files/' + fileId + '/edit');
        });

        FileBrowserModal.on('submit', '#update-file', function(event) {

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
    </script>
@endsection