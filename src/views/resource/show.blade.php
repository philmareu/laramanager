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

    {{--{{ Form::open(array('route' => array('admin.pages.destroy', $page->id), 'method' => 'DELETE')) }}--}}
    {{--<div class="btn-group">--}}
        {{--<a href="{{ URL::to('course/' . $page->module->course->slug . '/' . $page->module->slug . '/' . $page->slug) }}" class="btn btn-primary">Preview</a>--}}
        {{--<a href="{{ URL::to('admin/pages/' . $page->id . '/edit') }}" class="btn btn-primary">Settings</a>--}}

        {{--<a href="#" class="btn btn-danger confirm" title="Are you sure? This will delete all related objects and activities." class="btn btn-primary">Delete</a>--}}
    {{--</div>--}}
    {{--{{ Form::close() }}--}}

    @foreach($entity->objects as $object)

        <div class="panel-default" id="item_{{ $object->pivot->id }}">
            <h3 class="uk-panel-title">
                {{ $object->title }} - Title?
            </h3>
            <div id="object-{{ $object->pivot->id }}">
                <div class="panel-body">
                    <div class="btn-group">
                        <a href="{{ url('admin/objects/' . $resource . '/' . $entity->id . '/' . $object->pivot->id . '/edit') }}" class="btn btn-warning">Edit Object</a>
                    </div>

                    <hr>

                    <div class="admin-objects">
                        @if(view()->exists('vendor/laramanager/objects/' . $object->slug . '/display'))
                            @include('vendor/laramanager/objects/' . $object->slug . '/display')
                        @else
                            @include('laramanager::objects/' . $object->slug . '/display')
                        @endif
                    </div>
                </div>
            </div>
        </div>
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