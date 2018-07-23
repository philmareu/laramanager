@extends('laramanager::layouts.admin.blank')

@section('title')
    {{ $resource->id }}
@endsection

@section('breadcrumbs')
    <li><a href="{{ route('admin.' . $resource->slug . '.index') }}">{{ $resource->title }}</a></li>
    <li><span>{{ $entry->id }}</span></li>
@endsection

@section('actions')
    <form action="{{ url('admin/' . $resource->slug . '/' . $entry->id) }}" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="DELETE">

        <a href="#" title="Are you sure? This will delete all related objects." class="uk-button uk-button-danger uk-button-small confirm">Delete</a>
    </form>
@endsection

@section('blank-content')

    <div uk-grid>
        <div class="uk-width-1-2@s">

            <div class="uk-card uk-card-default uk-card-small">
                <div class="uk-card-header">
                    <h3 class="uk-card-title">Default Fields <a href="{{ URL::to('admin/' . $resource->slug . '/' . $entry->id . '/edit') }}" class="uk-button uk-button-primary uk-button-small uk-float-right">Edit</a>
                    </h3>
                </div>
                <div class="uk-card-body">
                    @foreach($resource->fields as $key => $field)
                        <div class="uk-placeholder">
                            <div class="uk-form-label">{{ $field->title }}</div>
                            @include('laramanager::fields.' . $field->type . '.display')
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="uk-width-1-2@s">
            @if(method_exists($entry, 'objects'))
                <div class="uk-card uk-card-default uk-card-small">
                    <div class="uk-card-header">
                        <h3 class="uk-card-title">Objects</h3>
                    </div>

                    <div class="uk-card-body">
                        <div id="resource-objects" uk-sortable>
                            @foreach($entry->objects as $object)
                                <div data-laramanager-objectable-id="{{ $object->pivot->id }}" class="object">
                                    <button class="uk-button uk-button-default uk-width-1-1 uk-text-left uk-margin" type="button" uk-toggle="target: #toggle-object-{{ $object->pivot->id }}"><span uk-icon="icon: move;" class="uk-margin-small-right"></span>{{ $object->title }} - {{ $object->pivot->label }}</button>
                                    <div id="toggle-object-{{ $object->pivot->id }}" hidden>
                                        <div class="uk-placeholder">
                                            <div id="object-{{ $object->pivot->id }}" class="uk-margin">
                                                <div class="admin-objects">
                                                    @if(view()->exists('vendor.laramanager.objects.' . $object->slug . '.display'))
                                                        @include('vendor.laramanager.objects.' . $object->slug . '.display')
                                                    @else
                                                        @include('laramanager::objects.core.' . $object->slug . '.display')
                                                    @endif
                                                </div>
                                            </div>

                                            <a href="{{ url('admin/' . $resource->slug . '/object/' . $entry->id . '/' . $object->pivot->id . '/edit') }}" class="uk-button uk-button-default uk-width-1-1 uk-margin"><span uk-icon="icon: pencil;"></span> Edit</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="uk-inline">
                            <button class="uk-button uk-button-default" type="button">Add Object</button>
                            <div uk-dropdown="mode: click">
                                @foreach($objects as $object)
                                    <li><a href="{{ url('admin/' . $resource->slug . '/object/' . $entry->id . '/' . $object->id . '/create') }}">{{ $object->title }}</a></li>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

@endsection

@push('scripts-last')

    <script>

        let id = "{{ $entry->id }}";
        let resource = {!! $resource !!};

        UIkit.util.on('#resource-objects', 'stop', function (event, component) {
            let ids = [];

            $('.object').each(function(index) {
                let object = $(this);
                ids.push(object.attr('data-laramanager-objectable-id'));
            });
            
            $.ajax({
                url: SITE_URL + '/admin/' + resource.id + '/objects/reorder',
                type: 'PUT',
                data: {ids: ids.slice(0, ids.length - 1), _token: token},
                success: function(response) {
                    console.log('reordered');
                }
            });
        });

        // Form confirmation
        $('a.confirm').on('click', function(e){

            e.preventDefault();

            let removemsg = $(this).attr('title');

            if (confirm(removemsg))
            {
                $.ajax({
                    url: SITE_URL + '/admin/' + resource.slug + '/' + id,
                    type: 'POST',
                    data: {_method: 'DELETE', _token: token},
                    success: function(response) {
                        if(response.status === 'ok') {
                            window.location = SITE_URL + '/admin/' + resource.slug;
                        }
                    }
                });
            }
        });
    </script>

@endpush