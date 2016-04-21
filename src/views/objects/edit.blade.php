@extends('laramanager::layouts.default')

@section('title')
    Edit Object
@endsection

@section('content')

    @if(session()->has('errors'))
        <div class="uk-alert uk-alert-danger" data-uk-alert>
            Oops. It looks like a few fields were not completed properly.
            <a href="#" class="uk-alert-close uk-close"></a>
        </div>
    @endif

    <form action="{{ route('admin.objects.update', $object->id) }}" enctype="multipart/form-data" method="POST" class="uk-form uk-form-stacked">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="PUT">

        @include('laramanager::partials.elements.form.text', ['field' => ['name' => 'title', 'id' => 'title', 'value' => $object->title]])
        @include('laramanager::partials.elements.form.slug', ['field' => ['name' => 'slug', 'id' => 'slug', 'target' => 'title', 'value' => $object->slug]])
        @include('laramanager::partials.elements.form.text', ['field' => ['name' => 'description', 'value' => $object->description]])

        <div class="uk-form-row">
            <button type="submit" class="uk-button uk-button-primary uk-width-1-1 uk-width-medium-1-3 uk-width-large-1-6">Update</button>
        </div>

    </form>

@endsection

@section('scripts')

    <script>
        $('#title').slugify({ slug: '#slug', type: '_' });
    </script>

@endsection