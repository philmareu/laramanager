@extends('laramanager::layouts.default')

@section('title')
    {{ $title or 'Edit' }}
@endsection

@section('content')

    <form action="{{ route('admin.' . $resource . '.update', $entity->id) }}" enctype="multipart/form-data" method="POST" class="uk-form uk-form-stacked">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="PUT">

        @foreach($fields as $field)

            @include('laramanager::fields.' . $field['type'] . '.field', ['field' => array_merge($field, ['value' => $entity->{$field['name']}])])

        @endforeach

        <div class="uk-form-row">
            <div class="uk-width-1-6">
                @include('laraform::elements.form.submit', ['value' => 'Update'])
            </div>
        </div>

    </form>

    @include('laramanager::browser.modals.single')

    @include('laramanager::browser.modals.multiple')

@endsection

@section('scripts')

    @if($hasWysiwyg)
        <script src="{{ asset('vendor/laramanager/js/ckeditor/ckeditor.js') }}"></script>
    @endif

    @foreach($fields as $field)

        @if(view()->exists('laramanager::fields.' . $field['type'] . '/scripts'))
            @include('laramanager::fields.' . $field['type'] . '/scripts', $field)
        @endif

    @endforeach

    <script>

        var ImageBrowserMultiple = $('#modal-image-browser-multiple');

        ImageBrowserMultiple.on('show.uk.modal', function() {

            var i = $('#images').html();

            ImageBrowserMultiple.find('#image-list .images').html(i);


        });

        ImageBrowserMultiple.on('click', 'img.unselected-image', function(event) {
            var wrapper = $('<div>', {
                class: 'uk-width-1-2 uk-width-medium-1-4 uk-width-large-1-6 uk-margin-bottom'
            });

            var img = $(this).clone().toggleClass('unselected-image').toggleClass('selected-image').appendTo(wrapper);

            $('#image-list .uk-grid').append(wrapper);

        });

        ImageBrowserMultiple.on('click', '.cancel', function() {
            UIkit.modal(ImageBrowserMultiple).hide();
            $('#image-list .images').html('');
        });

        ImageBrowserMultiple.on('click', '.done', function() {
            UIkit.modal(ImageBrowserMultiple).hide();

            var selectedImages = ImageBrowserMultiple.find('#image-list .images').html();
            $('#images').html(selectedImages);
            $('#image-list .images').html('');
        });

        ImageBrowserMultiple.on('click', 'img.selected-image', function(event) {

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

@endsection