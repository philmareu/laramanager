<li>
    <a href="#"><span class="uk-visible@s uk-margin-small-left">{{ Auth::user()->name }}</span></a>
    <div class="uk-navbar-dropdown" uk-dropdown="mode: click">
        <ul class="uk-nav uk-navbar-dropdown-nav">
            <li>
                <a href="#"
                   onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">Logout</a>

                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
        </ul>
    </div>
</li>