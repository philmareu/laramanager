@extends('laramanager::layouts.sub.auth')

@section('title')
    Request Password Link
@endsection

@section('page-content')

    <form class="uk-form uk-text-left" role="form" method="POST" action="{{ url('admin/password/email') }}">
        {{ csrf_field() }}

        <div class="uk-text-danger">
            {{ $errors->first('email') }}
        </div>
        <div class="uk-inline uk-width-1-1">
            <span class="uk-form-icon" uk-icon="icon: mail"></span>
            <input class="uk-input" type="email" name="email" placeholder="Email" value="{{ old('email') }}">
        </div>

        <button class="uk-button uk-button-primary uk-width-1-1 uk-margin" type="submit">Request Reset Link</button>

        <div class="uk-form-row"><a href="{{ url('admin/login') }}"><span uk-icon="icon: arrow-left;" class="uk-margin-small-right"></span>Back</a></div>

    </form>

@endsection