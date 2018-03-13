@include('laramanager::navigations.primary.header')

<ul class="uk-nav uk-nav-default uk-nav-parent-icon" uk-nav>
    @include('laramanager::navigations.primary.items')
</ul>

<div id="offcanvas-navigation" class="background-gradient-primary" uk-offcanvas>
    <div class="uk-offcanvas-bar">
        @include('laramanager::navigations.primary.header')

        <ul class="uk-nav uk-nav-default">
            @include('laramanager::navigations.primary.items')
        </ul>
    </div>
</div>