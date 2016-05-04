@extends('laramanager::layouts.default')

@section('title')
    {{ $resource->title . '> View' }}
@endsection

@section('content')

    <h2>Primary Field Information</h2>
    <div class="uk-panel uk-panel-box uk-panel-box-primary uk-margin-bottom">
        @foreach($resource->fields as $key => $field)
            <div class="uk-margin-bottom">
                <div class="label uk-text-bold uk-margin-small-bottom">{{ $field->title }}</div>
                @include('laramanager::fields.' . $field->type . '.display')
            </div>
        @endforeach

        <form action="{{ url('admin/' . $resource->slug . '/' . $entity->id) }}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="DELETE">

            <a href="{{ URL::to('admin/' . $resource->slug . '/' . $entity->id . '/edit') }}" class="uk-button uk-button-primary">Edit</a>
            <a href="#" title="Are you sure? This will delete all related objects." class="uk-button uk-button-danger confirm">Delete</a>
        </form>
    </div>

    @if(method_exists($entity, 'objects'))
    <h2>Objects</h2>

    <div class="uk-accordion" data-uk-accordion="{showfirst: false}">

        <div id="objects" class="uk-sortable" data-uk-sortable>

            @foreach($entity->objects as $object)
                <div class="uk-panel uk-panel-box uk-panel-box-secondary uk-margin-bottom object" data-laramanager-objectable-id="{{ $object->pivot->id }}">
                    <h3 class="uk-accordion-title uk-panel-title">
                        <i class="uk-icon-bars"></i> {{ $object->title }} - {{ $object->pivot->label }}
                    </h3>
                    <div class="uk-accordion-content uk-margin-top uk-margin-bottom">
                        <div id="object-{{ $object->pivot->id }}">
                            <div class="admin-objects">
                                @if(view()->exists('vendor/laramanager/objects/' . $object->slug . '/display'))
                                    @include('vendor/laramanager/objects/' . $object->slug . '/display')
                                @else
                                    @include('laramanager::objects/' . $object->slug . '/display')
                                @endif
                            </div>
                        </div>
                    </div>
                    <a href="{{ url('admin/objects/' . $resource->slug . '/' . $entity->id . '/' . $object->pivot->id . '/edit') }}" class="uk-float-rigdht"><i class="uk-icon-pencil"></i> Edit</a>
                </div>
            @endforeach
        </div>
    </div>


    <div class="uk-button-dropdown" data-uk-dropdown>

        <button class="uk-button">Add Object</button>

        <div class="uk-dropdown uk-dropdown-small">
            <ul class="uk-nav uk-nav-dropdown">
            @foreach($objects as $object)
                    <li><a href="{{ url('admin/objects/' . $resource->slug . '/' . $entity->id . '/' . $object->id . '/create') }}">{{ $object->title }}</a></li>
                @endforeach
            </ul>
        </div>

    </div>
    @endif
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

        $('#objects').on('change.uk.sortable', function(event, object, element, action) {
            var ids = [];

            $('.object').each(function(index) {
                var object = $(this);
                ids.push(object.attr('data-laramanager-objectable-id'));
            });

            $.ajax({
                url: SITE_URL + '/admin/objects/reorder',
                type: 'PUT',
                data: {ids: ids, _token: csrf},
                success: function(response) {
                    console.log('reordered');
                }
            });
        });
    </script>

@endsection