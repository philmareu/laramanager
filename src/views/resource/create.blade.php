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
            <div class="uk-width-1-6">
                @include('laraform::elements.form.submit')
            </div>
        </div>

    </form>

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

@endsection