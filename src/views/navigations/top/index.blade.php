<nav class="uk-navbar" id="top-navigation" data-uk-sticky>
    <a href="{{ url() }}" target="_blank" class="uk-navbar-brand">{{ config('laramanager.site_title') }} ({{ url('/') }}) <i class="uk-icon-external-link"></i></a>
    <div class="uk-navbar-flip">
        <ul class="uk-navbar-nav">

            @include('laramanager::navigations.top.user')

            @if(config('laramanager.navigation.shortcuts'))
                @include('laramanager::navigations.top.shortcuts')
            @endif
        </ul>
    </div>
</nav>