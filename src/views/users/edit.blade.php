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

    <form action="{{ route('admin.users.update', $user->id) }}" enctype="multipart/form-data" method="POST" class="uk-form uk-form-stacked">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="PUT">

        @include('laramanager::partials.elements.form.text', ['field' => ['name' => 'name', 'value' => $user->name]])
        @include('laramanager::partials.elements.form.email', ['field' => ['name' => 'email', 'value' => $user->email]])
        @include('laramanager::partials.elements.form.password', ['field' => ['name' => 'password']])
        @include('laramanager::partials.elements.form.checkbox', ['field' => ['name' => 'is_admin', 'checked' => $user->is_admin]])

        <div class="uk-form-row">
            <button type="submit" class="uk-button uk-button-primary uk-width-1-1 uk-width-medium-1-3 uk-width-large-1-6">Update</button>
        </div>

    </form>

@endsection

@push('scripts-last')

    <script>
        $('#title').slugify({ slug: '#slug', type: '_' });
    </script>

@endpush