@extends('laramanager::layouts.default')

@section('title')
    Edit Redirect
@endsection

@section('content')

    @if(session()->has('errors'))
        <div class="uk-alert uk-alert-danger" data-uk-alert>
            Oops. It looks like a few fields were not completed properly.
            <a href="#" class="uk-alert-close uk-close"></a>
        </div>
    @endif

    <form action="{{ route('admin.redirects.update', $redirect->id) }}" enctype="multipart/form-data" method="POST" class="uk-form uk-form-stacked">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="PUT">

        @include('laraform::elements.form.text', ['field' => ['name' => 'from', 'value' => $redirect->from]])
        @include('laraform::elements.form.text', ['field' => ['name' => 'to', 'value' => $redirect->to]])
        @include('laraform::elements.form.select', ['field' => ['name' => 'type', 'options' => ['301' => '301 Permanent', '302' => '302 Temporary'], 'value' => $redirect->type]])

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