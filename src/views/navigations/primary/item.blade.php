<li class="{{ $segments[1] == $item['uri'] ? 'uk-active' : '' }}"><a href="{{ url('admin/' . $item['uri']) }}"><i class="{{ $item['icon'] }} uk-icon-justify"></i> {{ $item['title'] }}</a></li>
