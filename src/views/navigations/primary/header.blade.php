<div class="uk-padding-small uk-text-center uk-light">
    <h3>{{ config('app.name') }}</h3>
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