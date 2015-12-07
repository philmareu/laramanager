@if(isset($item['uri']))

    <li class="{{ $segments[1] == $item['uri'] ? 'uk-active' : '' }}"><a href="{{ url('admin/' . $item['uri']) }}" class="uk-text-large"><i class="{{ $item['icon'] }} uk-icon-justify"></i> {{ $item['title'] }}</a></li>

@else

    <li class="uk-parent {{ in_array($segments[1], array_pluck($item['sub'], 'uri')) ? 'uk-active' : '' }}">
        <a href="#" class="uk-text-large"><i class="{{ $item['icon'] }} uk-icon-justify"></i> {{ $item['title'] }}</a>
        <ul class="uk-nav-sub">
            @each('laramanager::navigations.primary.sub', $item['sub'], 'sub')
        </ul>
    </li>

@endif