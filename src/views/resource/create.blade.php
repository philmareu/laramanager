@extends('laramanager::layouts.default')

@section('title')
    {{ $resource->title or 'Create' }}
@endsection

@section('content')

    @if(session()->has('errors'))
        <div class="uk-alert uk-alert-danger" data-uk-alert>
            Oops. It looks like a few fields were not completed properly.
            <a href="#" class="uk-alert-close uk-close"></a>
        </div>
    @endif

    <form action="{{ route('admin.' . $resource->slug . '.store') }}" enctype="multipart/form-data" method="POST" class="uk-form uk-form-stacked">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        @foreach($resource->fields as $field)

            @include('laramanager::fields.' . $field->type . '.field', compact('field'))

        @endforeach

        <div class="uk-form-row">
            <button type="submit" class="uk-button uk-button-primary uk-width-1-1 uk-width-medium-1-3 uk-width-large-1-6">Save</button>
        </div>

    </form>

    @include('laramanager::browser.modal')

@endsection

@section('scripts')

    @if($hasWysiwyg)
        <script src="{{ asset('vendor/laramanager/js/ckeditor/ckeditor.js') }}"></script>
    @endif

    @foreach($resource->fields as $field)

        @if(view()->exists('laramanager::fields.' . $field->type . '.scripts'))
            @include('laramanager::fields.' . $field->type . '.scripts', (array) $field)
        @endif

    @endforeach

    @include('laramanager::browser.scripts')

@endsection