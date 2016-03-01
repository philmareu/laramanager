<div class="uk-panel uk-panel-box" data-uk-sticky="{top:60}">
    <h3 class="uk-panel-title">LaraManager by Philsquare</h3>
    <ul class="uk-nav uk-nav-side uk-nav-parent-icon" data-uk-nav>
        <li class="uk-nav-divider"></li>

        <li class="uk-nav-header">Reporting</li>
        <li class="{{ $segments[1] == 'dashboard' ? 'uk-active' : '' }}"><a href="{{ url('admin/dashboard') }}"><i class="uk-icon-dashboard uk-icon-justify"></i> Dashboard</a></li>
        <li class="{{ $segments[1] == 'not-founds' ? 'uk-active' : '' }}"><a href="{{ url('admin/not-founds') }}"><i class="uk-icon-exclamation uk-icon-justify"></i> 404s</a></li>
        <li class="uk-nav-divider"></li>

        <li class="uk-nav-header">Resources</li>
        @foreach($resources as $resource)
            <li class="{{ $segments[1] == $resource->slug ? 'uk-active' : '' }}"><a href="{{ url('admin/' . $resource->slug) }}"><i class="{{ $resource->icon }} uk-icon-justify"></i> {{ $resource->title }}</a></li>
        @endforeach
        <li class="{{ $segments[1] == 'files' ? 'uk-active' : '' }}"><a href="{{ url('admin/files') }}"><i class="uk-icon-file uk-icon-justify"></i> Files</a></li>
        <li class="uk-nav-divider"></li>

        {{--    @each('laramanager::navigations.primary.items', config('laramanager.navigation.primary'), 'item')--}}

        <li class="uk-nav-header">System</li>
        <li class="{{ $segments[1] == 'resources' ? 'uk-active' : '' }}">
            <a href="{{ url('admin/resources') }}"><i class="uk-icon-cubes uk-icon-justify"></i> Resources</a>

        </li>

        <li class="{{ $segments[1] == 'objects' ? 'uk-active' : '' }}">
            <a href="{{ url('admin/objects') }}"><i class="uk-icon-cube uk-icon-justify"></i> Objects</a>
        </li>
        <li class="uk-nav-divider"></li>

        <li class="uk-nav-header">Support</li>
        <li class="{{ $segments[1] == 'resources' ? 'uk-active' : '' }}">
            <a href="{{ url('admin/resources') }}"><i class="uk-icon-life-bouy uk-icon-justify"></i> Report Issue</a>
        </li>

        {{--<li class="uk-parent {{ in_array($segments[1], ['resources']) ? 'uk-active' : '' }}">--}}
            {{--<a href="#" class="uk-text-large"><i class="uk-icon-gears uk-icon-justify"></i>System</a>--}}
            {{--<ul class="uk-nav-sub">--}}
                {{--<li class="{{ $segments[1] == 'resources' ? 'uk-active' : '' }}">--}}
                    {{--<a href="{{ url('admin/resources') }}">Resources</a>--}}
                {{--</li>--}}
            {{--</ul>--}}
        {{--</li>--}}

    </ul>
</div>