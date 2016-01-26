@extends('laramanager::layouts.default')

@section('title')
    {{ $title }}
@endsection

@section('content')

    @foreach($fields as $field)
        <div class="uk-margin-bottom">
            @include('laramanager::fields.' . $field['type'] . '.display')
        </div>
    @endforeach

    <form action="{{ url('admin/' . $resource . '/' . $entity->id) }}" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="DELETE">

        <a href="{{ URL::to('admin/' . $resource . '/' . $entity->id . '/edit') }}" class="btn btn-primary">Edit</a>
        <a href="#" class="btn btn-danger confirm" title="Are you sure? This will delete all related objects." class="btn btn-primary">Delete</a>
    </form>

    <hr/>

    @foreach($entity->objects as $object)

        <div class="uk-panel uk-panel-box uk-margin-bottom" id="item_{{ $object->pivot->id }}">
            <h3 class="uk-panel-title">
                {{ $object->pivot->label }}
            </h3>
            <div id="object-{{ $object->pivot->id }}">
                <a href="{{ url('admin/objects/' . $resource . '/' . $entity->id . '/' . $object->pivot->id . '/edit') }}" class="uk-button">Edit</a>

                <div class="admin-objects">
                    @if(view()->exists('vendor/laramanager/objects/' . $object->slug . '/display'))
                        @include('vendor/laramanager/objects/' . $object->slug . '/display')
                    @else
                        @include('laramanager::objects/' . $object->slug . '/display')
                    @endif
                </div>
            </div>
        </div>
    @endforeach

    <div class="uk-button-dropdown" data-uk-dropdown>

        <button class="uk-button">Add Object</button>

        <div class="uk-dropdown uk-dropdown-small">
            <ul class="uk-nav uk-nav-dropdown">
                @foreach($objects as $object)
                    <li><a href="{{ url('admin/objects/' . $resource . '/' . $entity->id . '/' . $object->id . '/create') }}">{{ $object->title }}</a></li>
                @endforeach
            </ul>
        </div>

    </div>

@endsection

@section('scripts')

    <script>
        // Form confirmation
        $('a.confirm').on('click', function(e){

            e.preventDefault();

            var form = $(this).parents('form');
            var removemsg	= $(this).attr('title');

            if (confirm(removemsg))
            {
                form.submit();
            }
        });
    </script>

@endsection