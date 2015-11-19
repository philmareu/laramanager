<ul>
    @foreach(config('laramanager.navigation') as $item)

        <li><a href="{{ url('admin/' . $item['uri']) }}">{{ $item['title'] }}</a></li>

    @endforeach
</ul>