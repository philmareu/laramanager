<li class="uk-parent uk-hidden-small" data-uk-dropdown="{mode:'click'}">

    <!-- This is the menu item toggling the dropdown -->
    <a href="#" style="cursor:pointer;">{{ $user->name }} <i class="uk-icon-caret-down"></i></a>

    <!-- This is the dropdown -->
    <div class="uk-dropdown uk-dropdown-navbar">
        <ul class="uk-nav uk-nav-navbar">
            <li><a href="{{ url('admin/auth/logout') }}"><i class="uk-icon-sign-out uk-icon-justify"></i> Logout</a></li>
        </ul>
    </div>

</li>