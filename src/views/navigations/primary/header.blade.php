<div class="uk-padding-small uk-text-center uk-light">
    <h3><a href="{{ url('/') }}" class="uk-link-reset" target="_blank">{{ config('app.name') }}</a></h3>
    <div>
        {{ Auth::user()->name }}<br>
        <a href="#"
           onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">Logout</a>

        <form id="logout-form" action="{{ url('/admin/logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </div>

</div>

<hr>