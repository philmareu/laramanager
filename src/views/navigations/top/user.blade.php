<li class="uk-parent uk-hidden-small" data-uk-dropdown="{mode:'click'}">

    <!-- This is the menu item toggling the dropdown -->
    <a href="#" style="cursor:pointer;">{{ $user->name }} <i class="uk-icon-caret-down"></i></a>

    <!-- This is the dropdown -->
    <div class="uk-dropdown uk-dropdown-navbar">
        <ul class="uk-nav uk-nav-navbar">
            <li>
                <a href="{{ url('/admin/logout') }}"
                   onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                    Logout
                </a>

                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
        </ul>
    </div>

</li>