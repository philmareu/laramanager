@foreach($navigationSections as $navigationSection)

    <li class="uk-parent uk-margin">
        <a href="#" class="uk-text-uppercase uk-margin-left"><span uk-icon="icon: {{ $navigationSection->icon }};" class="uk-margin-small-right"></span>{{ $navigationSection->title }}</a>
        <ul class="uk-nav-sub uk-padding-remove">
            @foreach($navigationSection->links as $link)
                <li class="{{ $request->is($link->wildcardUris()) ? 'li-active li-active-background-default' : '' }} li-padding"><a href="{{ url($link->uri) }}">{{ $link->title }}</a></li>
            @endforeach
        </ul>
    </li>

@endforeach

@push('scripts-last')
    <script>
        $(function(){
            $('#sidebar').find('.li-active').parent('ul').attr('hidden', false);
        })
    </script>
@endpush