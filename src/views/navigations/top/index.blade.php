<nav class="uk-navbar" id="top-navigation" data-uk-sticky>
    <a href="#offcanvas-navigation" class="uk-navbar-toggle" data-uk-offcanvas></a>
    <a href="{{ url() }}" target="_blank" class="uk-navbar-brand">{{ $settings['site-name'] }} <span class="uk-hidden-small">({{ url('/') }}) </span><i class="uk-icon-external-link"></i></a>
    <div class="uk-navbar-flip">
        <ul class="uk-navbar-nav">

            @include('laramanager::navigations.top.user')

            @if(config('laramanager.navigation.shortcuts'))
                @include('laramanager::navigations.top.shortcuts')
            @endif
        </ul>
    </div>
</nav>

<div id="offcanvas-navigation" class="uk-offcanvas">
    <div class="uk-offcanvas-bar">
        <div class="uk-panel">
            <h3 class="uk-panel-title uk-margin-bottom-remove">LaraManager by Philsquare</h3>
        </div>
        <ul class="uk-nav uk-nav-offcanvas uk-nav-side">
            @include('laramanager::navigations.primary.items')
        </ul>
    </div>
</div>