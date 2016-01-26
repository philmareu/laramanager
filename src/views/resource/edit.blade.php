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

@endsection

@section('scripts')

    @if($hasWysiwyg)
        <script src="{{ asset('vendor/laramanager/js/ckeditor/ckeditor.js') }}"></script>
    @endif

    @foreach($fields as $field)

        @if(view()->exists('laramanager::resource.scripts.fields.' . $field['type']))
            @include('laramanager::resource.scripts.fields.' . $field['type'], $field)
        @endif

    @endforeach

    <script>
        $('#modal-image-browser-multiple').on('click', 'img.select-image', function(event) {

            var img = $(this).parent().addClass('selected-file');

            $('#image-list .uk-grid').append(img);

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