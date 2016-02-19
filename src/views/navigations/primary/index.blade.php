<ul class="uk-nav uk-nav-side uk-nav-parent-icon" data-uk-nav data-uk-sticky="{top:60}">

    <li class="{{ $segments[1] == 'dashboard' ? 'uk-active' : '' }}"><a href="{{ url('admin/dashboard') }}" class="uk-text-large"><i class="uk-icon-dashboard uk-icon-justify"></i>Dashboard</a></li>

    @foreach($resources as $resource)
        <li class="{{ $segments[1] == $resource->slug ? 'uk-active' : '' }}"><a href="{{ url('admin/' . $resource->slug) }}" class="uk-text-large"><i class="{{ $resource->icon }} uk-icon-justify"></i>{{ $resource->title }}</a></li>
    @endforeach

{{--    @each('laramanager::navigations.primary.items', config('laramanager.navigation.primary'), 'item')--}}

    <li class="uk-parent {{ in_array($segments[1], ['resources']) ? 'uk-active' : '' }}">
        <a href="#" class="uk-text-large"><i class="uk-icon-gears uk-icon-justify"></i></a>
        <ul class="uk-nav-sub">
            <li class="{{ $segments[1] == 'resources' ? 'uk-active' : '' }}">
                <a href="{{ url('admin/resources') }}">Resources</a>
            </li>
        </ul>
    </li>

</ul>