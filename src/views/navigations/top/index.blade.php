<nav class="uk-navbar">
    <a href="{{ url() }}" target="_blank" class="uk-navbar-brand">{{ config('laramanager.site_title') }}</a>
    <div class="uk-navbar-flip">
        <ul class="uk-navbar-nav">
            <li><a href="#">{{ $user->name }}</a></li>
            <li><a href="{{ url('admin/auth/logout') }}">Logout</a></li>
        </ul>
    </div>

</nav>