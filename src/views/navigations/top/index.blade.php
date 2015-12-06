<nav class="uk-navbar" id="top-navigation" data-uk-sticky>
    <a href="{{ url() }}" target="_blank" class="uk-navbar-brand uk-contrast">{{ config('laramanager.site_title') }}</a>
    <div class="uk-navbar-flip">
        <ul class="uk-navbar-nav">
            <li><a href="#"><span class="uk-contrast">{{ $user->name }}</span></a></li>
            <li><a href="{{ url('admin/auth/logout') }}"><span class="uk-contrast">Logout</span></a></li>
        </ul>
    </div>
</nav>