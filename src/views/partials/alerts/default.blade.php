@if(session()->has('errors'))
    <div class="uk-alert uk-alert-danger" data-uk-alert>
        Oops. It looks like a few fields were not completed properly.
        <a href="#" class="uk-alert-close uk-close"></a>
    </div>
@elseif(session()->has('failed'))
    <div class="uk-alert uk-alert-danger" data-uk-alert>
        <a href="#" class="uk-alert-close uk-close"></a>
        {{ session('failed') }}
    </div>
@elseif(session()->has('success'))
    <div class="uk-alert uk-alert-success" data-uk-alert>
        <a href="#" class="uk-alert-close uk-close"></a>
        {{ session('success') }}
    </div>
@elseif(session('status'))
    <div class="uk-alert uk-alert-info" data-uk-alert>
        <a href="#" class="uk-alert-close uk-close"></a>
        {{ session('status') }}
    </div>
@endif