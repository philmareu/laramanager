<nav uk-navbar>
    <div class="uk-navbar-right">

        <ul class="uk-navbar-nav">
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