<li class="uk-parent" data-uk-dropdown="{mode:'click'}">

    <!-- This is the menu item toggling the dropdown -->
    <a href="#" style="cursor:pointer;"><i class="uk-icon-plus-circle uk-icon-large"></i></a>

    <!-- This is the dropdown -->
    <div class="uk-dropdown uk-dropdown-navbar">
        <ul class="uk-nav uk-nav-navbar">
            @each('laramanager::navigations.top.shortcut', config('laramanager.navigation.shortcuts'), 'item')
        </ul>
    </div>

</li>