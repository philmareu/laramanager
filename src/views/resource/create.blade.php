@extends('laramanager::layouts.default')

@section('title')
    {{ $title or 'Create' }}
@endsection

@section('content')

    <form action="{{ route('admin.' . $resource . '.store') }}" enctype="multipart/form-data" method="POST" class="uk-form uk-form-stacked">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        @foreach($fields as $field)

            @include('laraform::elements.form.' . $field['type'], compact('field'))

        @endforeach

        <div class="uk-form-row">
            @include('laraform::elements.form.submit')
        </div>

    </form>

@endsection

@section('scripts')

    @if($hasWysiwyg)
        <script src="{{ asset('vendor/laramanager/js/ckeditor/ckeditor.js') }}"></script>
    @endif

    @foreach($fields as $field)

        @if($field['type'] == 'wysiwyg')

            <script>
                CKEDITOR.replace( '{{ $field['id'] }}', {
                    customConfig: '/vendor/laramanager/js/ckeditor.js'
                });
            </script>

        @endif

    @endforeach

@endsection