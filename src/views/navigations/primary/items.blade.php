@foreach($navigationSections as $navigationSection)

    <li class="uk-parent uk-margin">
        <a href="#" class="uk-text-uppercase uk-margin-left"><span uk-icon="icon: {{ $navigationSection->icon }};" class="uk-margin-small-right"></span>{{ $navigationSection->title }}</a>
        <ul class="uk-nav-sub uk-padding-remove">
            @foreach($navigationSection->links as $link)
                <li class="{{ $request->is($link->wildcardUris()) ? 'li-active li-active-background-default' : '' }} li-padding"><a href="{{ url($link->uri) }}">{{ $link->title }}</a></li>
            @endforeach
        </ul>
    </li>

@endforeach

{{--<li class="uk-parent uk-margin">--}}
    {{--<a href="#" class="uk-text-uppercase uk-margin-left"><span uk-icon="icon: grid;" class="uk-margin-small-right"></span>Reporting</a>--}}
    {{--<ul class="uk-nav-sub uk-padding-remove">--}}
        {{--<li class="{{ $segments[1] == 'dashboard' ? 'uk-active li-active-background-default' : '' }} li-padding"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>--}}

        {{--@each('laramanager::navigations.primary.item', config('laramanager.navigation.primary.reporting'), 'item')--}}
    {{--</ul>--}}
{{--</li>--}}


{{--<li class="uk-parent uk-margin">--}}
    {{--<a href="#" class="uk-text-uppercase uk-margin-left"><span uk-icon="icon: list;" class="uk-margin-small-right"></span>Resources</a>--}}
    {{--<ul class="uk-nav-sub uk-padding-remove">--}}
        {{--@foreach($resources as $resource)--}}
            {{--<li class="{{ $segments[1] == $resource->slug ? 'uk-active' : '' }} li-padding"><a href="{{ url('admin/' . $resource->slug) }}">{{ $resource->title }}</a></li>--}}
        {{--@endforeach--}}
        {{--@each('laramanager::navigations.primary.item', config('laramanager.navigation.primary.resources'), 'item')--}}
    {{--</ul>--}}
{{--</li>--}}

{{--<li class="uk-parent uk-margin">--}}
    {{--<a href="#" class="uk-text-uppercase uk-margin-left"><span uk-icon="icon: image;" class="uk-margin-small-right"></span>Uploads</a>--}}
    {{--<ul class="uk-nav-sub uk-padding-remove">--}}
        {{--<li class="{{ $segments[1] == 'images' ? 'uk-active li-active-background-default' : '' }} li-padding"><a href="{{ url('admin/images') }}">Images</a></li>--}}
        {{--@each('laramanager::navigations.primary.item', config('laramanager.navigation.primary.uploads'), 'item')--}}
    {{--</ul>--}}
{{--</li>--}}

{{--<li class="uk-parent uk-margin">--}}
    {{--<a href="#" class="uk-text-uppercase uk-margin-left"><span uk-icon="icon: settings;" class="uk-margin-small-right"></span>Settings</a>--}}
    {{--<ul class="uk-nav-sub uk-padding-remove">--}}
        {{--<li class="{{ $segments[1] == 'settings' ? 'uk-active li-active-background-default' : '' }} li-padding">--}}
            {{--<a href="{{ url('admin/settings') }}">Settings</a>--}}
        {{--</li>--}}

        {{--<li class="{{ $segments[1] == 'resources' ? 'uk-active li-active-background-default' : '' }} li-padding">--}}
            {{--<a href="{{ url('admin/resources') }}">Resources</a>--}}
        {{--</li>--}}

        {{--<li class="{{ $segments[1] == 'objects' ? 'uk-active li-active-background-default' : '' }} li-padding">--}}
            {{--<a href="{{ url('admin/objects') }}">Objects</a>--}}
        {{--</li>--}}

        {{--<li class="{{ $segments[1] == 'feeds' ? 'uk-active li-active-background-default' : '' }} li-padding">--}}
            {{--<a href="{{ url('admin/feeds') }}">Feeds</a>--}}
        {{--</li>--}}

        {{--<li class="{{ $segments[1] == 'redirects' ? 'uk-active li-active-background-default' : '' }} li-padding">--}}
            {{--<a href="{{ url('admin/redirects') }}">Redirects</a>--}}
        {{--</li>--}}

        {{--<li class="{{ $segments[1] == 'users' ? 'uk-active' : '' }} li-padding">--}}
            {{--<a href="{{ url('admin/users') }}">Users</a>--}}
        {{--</li>--}}

        {{--@each('laramanager::navigations.primary.item', config('laramanager.navigation.primary.systems'), 'item')--}}
    {{--</ul>--}}
{{--</li>--}}

{{--<li class="uk-nav-header"><span uk-icon="icon: grid;" class="uk-margin-small-right"></span>Reporting</li>--}}
{{--<li class="{{ $segments[1] == 'dashboard' ? 'uk-active' : '' }}"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>--}}
{{--<li class="{{ $segments[1] == 'errors' ? 'uk-active' : '' }}"><a href="{{ url('admin/errors') }}"><i class="uk-icon-exclamation uk-icon-justify"></i> Errors</a></li>--}}
{{--@each('laramanager::navigations.primary.item', config('laramanager.navigation.primary.reporting'), 'item')--}}

{{--<li class="uk-nav-header"><span uk-icon="icon: list;" class="uk-margin-small-right"></span>Resources</li>--}}
{{--@foreach($resources as $resource)--}}
    {{--<li class="{{ $segments[1] == $resource->slug ? 'uk-active' : '' }}"><a href="{{ url('admin/' . $resource->slug) }}"><i class="{{ $resource->icon }} uk-icon-justify"></i> {{ $resource->title }}</a></li>--}}
{{--@endforeach--}}
{{--@each('laramanager::navigations.primary.item', config('laramanager.navigation.primary.resources'), 'item')--}}

{{--<li class="uk-nav-header"><span uk-icon="icon: image;" class="uk-margin-small-right"></span>Uploads</li>--}}
{{--<li class="{{ $segments[1] == 'images' ? 'uk-active' : '' }}"><a href="{{ url('admin/images') }}"><i class="uk-icon-file-picture-o uk-icon-justify"></i> Images</a></li>--}}
{{--@each('laramanager::navigations.primary.item', config('laramanager.navigation.primary.uploads'), 'item')--}}


{{--<li class="uk-nav-header"><span uk-icon="icon: settings;" class="uk-margin-small-right"></span>System</li>--}}
{{--<li class="{{ $segments[1] == 'settings' ? 'uk-active' : '' }}">--}}
    {{--<a href="{{ url('admin/settings') }}"><i class="uk-icon-gears uk-icon-justify"></i> Settings</a>--}}
{{--</li>--}}

{{--<li class="{{ $segments[1] == 'resources' ? 'uk-active' : '' }}">--}}
    {{--<a href="{{ url('admin/resources') }}"><i class="uk-icon-cubes uk-icon-justify"></i> Resources</a>--}}
{{--</li>--}}

{{--<li class="{{ $segments[1] == 'objects' ? 'uk-active' : '' }}">--}}
    {{--<a href="{{ url('admin/objects') }}"><i class="uk-icon-cube uk-icon-justify"></i> Objects</a>--}}
{{--</li>--}}

{{--<li class="{{ $segments[1] == 'feeds' ? 'uk-active' : '' }}">--}}
    {{--<a href="{{ url('admin/feeds') }}"><i class="uk-icon-rss uk-icon-justify"></i> Feeds</a>--}}
{{--</li>--}}

{{--<li class="{{ $segments[1] == 'redirects' ? 'uk-active' : '' }}">--}}
    {{--<a href="{{ url('admin/redirects') }}"><i class="uk-icon-refresh uk-icon-justify"></i> Redirects</a>--}}
{{--</li>--}}

{{--<li class="{{ $segments[1] == 'users' ? 'uk-active' : '' }}">--}}
    {{--<a href="{{ url('admin/users') }}"><i class="uk-icon-users uk-icon-justify"></i> Users</a>--}}
{{--</li>--}}

{{--@each('laramanager::navigations.primary.item', config('laramanager.navigation.primary.systems'), 'item')--}}

{{--<li class="uk-nav-divider"></li>--}}

{{--<li class="uk-nav-header">Support</li>--}}
{{--<li class="{{ $segments[1] == 'resources' ? 'uk-active' : '' }}">--}}
    {{--<a href="{{ url('admin/resources') }}"><i class="uk-icon-life-bouy uk-icon-justify"></i> Report Issue</a>--}}
{{--</li>--}}

{{--<li class="uk-parent {{ in_array($segments[1], ['resources']) ? 'uk-active' : '' }}">--}}
{{--<a href="#" class="uk-text-large"><i class="uk-icon-gears uk-icon-justify"></i>System</a>--}}
{{--<ul class="uk-nav-sub">--}}
{{--<li class="{{ $segments[1] == 'resources' ? 'uk-active' : '' }}">--}}
{{--<a href="{{ url('admin/resources') }}">Resources</a>--}}
{{--</li>--}}
{{--</ul>--}}
{{--</li>--}}