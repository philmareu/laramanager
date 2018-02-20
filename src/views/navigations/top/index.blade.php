<nav uk-navbar>
    <div class="uk-navbar-left">
        <a class="uk-navbar-item uk-logo" href="#">{{ $settings['site-name'] }}</a>
    </div>

    <div class="uk-navbar-right">

        <ul class="uk-navbar-nav">
            @if(config('laramanager.navigation.shortcuts'))
                @include('laramanager::navigations.top.shortcuts')
            @endif
            @include('laramanager::navigations.top.user')
        </ul>

    </div>
</nav>

<div id="offcanvas-navigation" uk-offcanvas>
    <div class="uk-offcanvas-bar">
        <ul class="uk-nav uk-nav-default">
            @include('laramanager::navigations.primary.items')
        </ul>
    </div>
</div>