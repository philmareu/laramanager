<li class="{{ $segments[1] == $sub['uri'] ? 'uk-active' : '' }}">
    <a href="{{ url('admin/' . $sub['uri']) }}">{{ $sub['title'] }}</a>
</li>