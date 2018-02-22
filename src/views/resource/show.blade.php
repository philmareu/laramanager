@extends('laramanager::layouts.sub.default')

@section('title')
    {{ $resource->title . ' > View' }}
@endsection

@section('page-content')

    <div class="uk-grid">
        <div class="uk-width-1-2">
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
        </div>
        <div class="uk-width-1-2">
            @if(method_exists($entity, 'objects'))
                <h2>Objects</h2>

                <div  uk-sortable="handle: .uk-accordion-title">
                    <ul uk-accordion>
                        @foreach($entity->objects as $object)
                            <li>
                                <a class="uk-accordion-title" href="#"><span uk-icon="icon: move;" class="uk-margin-small-right"></span>{{ $object->title }} - {{ $object->pivot->label }}</a>
                                <div class="uk-accordion-content">
                                    <div id="object-{{ $object->pivot->id }}">
                                        <div class="admin-objects">
                                            @if(view()->exists('vendor.laramanager.objects.' . $object->slug . '.display'))
                                                @include('vendor.laramanager.objects.' . $object->slug . '.display')
                                            @else
                                                @include('laramanager::objects.core.' . $object->slug . '.display')
                                            @endif
                                        </div>
                                    </div>

                                    <a href="{{ url('admin/' . $resource->slug . '/object/' . $entity->id . '/' . $object->pivot->id . '/edit') }}" class="uk-float-rigdht"><span uk-icon="icon: pencil;"></span> Edit</a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

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
                                            @if(view()->exists('vendor.laramanager.objects.' . $object->slug . '.display'))
                                                @include('vendor.laramanager.objects.' . $object->slug . '.display')
                                            @else
                                                @include('laramanager::objects.core.' . $object->slug . '.display')
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ url('admin/' . $resource->slug . '/object/' . $entity->id . '/' . $object->pivot->id . '/edit') }}" class="uk-float-rigdht"><span uk-icon="icon: pencil;"></span> Edit</a>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="uk-inline">
                    <button class="uk-button uk-button-default" type="button">Add Object</button>
                    <div uk-dropdown="mode: click">
                        @foreach($objects as $object)
                            <li><a href="{{ url('admin/' . $resource->slug . '/object/' . $entity->id . '/' . $object->id . '/create') }}">{{ $object->title }}</a></li>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>

@endsection

@push('scripts-last')

    <script>

        var id = "{{ $entity->id }}";
        var resource = "{{ $resource->slug }}";

        // Form confirmation
        $('a.confirm').on('click', function(e){

            e.preventDefault();

            var removemsg	= $(this).attr('title');

            if (confirm(removemsg))
            {
                $.ajax({
                    url: SITE_URL + '/admin/' + resource + '/' + id,
                    type: 'POST',
                    data: {_method: 'DELETE', _token: csrf},
                    success: function(response) {
                        if(response.status == 'ok') {
                            window.location = SITE_URL + '/admin/' + resource;
                        }
                    }
                });
            }
        });

        $('#objects').on('change.uk.sortable', function(event, object, element, action) {
            var ids = [];

            $('.object').each(function(index) {
                var object = $(this);
                ids.push(object.attr('data-laramanager-objectable-id'));
            });

            $.ajax({
                url: SITE_URL + '/admin/' + resource + '/objects/reorder',
                type: 'PUT',
                data: {ids: ids, _token: csrf},
                success: function(response) {
                    console.log('reordered');
                }
            });
        });
    </script>

@endpush