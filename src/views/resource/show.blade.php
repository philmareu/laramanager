@extends('laramanager::layouts.default')

@section('title')
    {{ $title or 'Show' }}
@endsection

@section('content')

    @foreach($fields as $field)
        @if(isset($field['list']) && $field['list'] === true)
            <td>
                @include('laramanager::resource.displays.fields.' . $field['type'])
            </td>
        @endif
    @endforeach

    @foreach($entity->objects as $object)

        {{ $object->pivot->ordinal }}

    @endforeach

    <div class="uk-button-dropdown" data-uk-dropdown>

        <button class="uk-button">Add Object</button>

        <div class="uk-dropdown uk-dropdown-small">
            <ul class="uk-nav uk-nav-dropdown">
                <li><a href="{{ url('admin/objects/' . $resource . '/' . $entity->id . '/1/create') }}">Text</a></li>
                <li><a href="">WYSIWYG</a></li>
            </ul>
        </div>

    </div>

@endsection

@section('scripts')

@endsection