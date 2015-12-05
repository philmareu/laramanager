{{--<ul class="uk-nav uk-nav-side uk-nav-parent-icon" data-uk-nav>--}}
    {{--@each('laramanager::navigations.primary.items', config('laramanager.navigation.primary'), 'item')--}}
{{--</ul>--}}


<ul class="uk-nav uk-nav-side uk-nav-parent-icon" data-uk-nav data-uk-sticky>
    <li class="{{ $segments[1] == 'events' ? 'uk-active' : '' }}"><a href="{{ url('admin/events') }}">Events</a></li>
    <li class="{{ $segments[1] == 'partners' ? 'uk-active' : '' }}"><a href="{{ url('admin/partners') }}">Partners</a></li>
    <li class="{{ $segments[1] == 'users' ? 'uk-active' : '' }}"><a href="{{ url('admin/users') }}">Users</a></li>
    <li class="uk-parent {{ in_array($segments[1], ['bands', 'band-genres']) ? 'uk-active' : '' }}">
        <a href="#">Bands</a>
        <ul class="uk-nav-sub">
            <li><a href="{{ url('admin/bands') }}">Bands</a></li>
            <li><a href="{{ url('admin/band-genres') }}">Band Genres</a></li>
        </ul>
    </li>
    <li class="uk-parent {{ in_array($segments[1], ['posts', 'post-categories']) ? 'uk-active' : '' }}">
        <a href="#">Posts</a>
        <ul class="uk-nav-sub">
            <li><a href="{{ url('admin/posts') }}">Posts</a></li>
            <li><a href="{{ url('admin/post-categories') }}">Post Categories</a></li>
        </ul>
    </li>
</ul>