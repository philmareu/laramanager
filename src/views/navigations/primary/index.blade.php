<ul class="uk-nav uk-nav-side">
    @foreach(config('laramanager.navigation.primary') as $item)

        <li class="{{ $segments[1] == $item['uri'] ? 'uk-active' : '' }}"><a href="{{ url('admin/' . $item['uri']) }}">{{ $item['title'] }}</a></li>

    @endforeach
</ul>