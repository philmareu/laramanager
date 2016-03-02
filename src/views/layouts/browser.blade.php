<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('laramanager.site_title') }} | @yield('title')</title>

    <link href="{{ asset("vendor/laramanager/css/styles.css") }}" rel="stylesheet" media="screen">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway:300,500' rel='stylesheet' type='text/css'>

    <script type="text/javascript" charset="utf-8">
        var SITE_URL = "{{ url() }}";
        var csrf = "{{ csrf_token() }}";
    </script>

    @yield('head')
</head>
<body>

<div class="uk-grid">
    <div class="uk-width-1-1" id="primary-content-area">

        <div class="title-bar">
            <div class="uk-container uk-container-center">
                <div class="uk-grid uk-grid-collapse uk-flex-middle">
                    <div class="uk-width-1-2">
                        <span class="title">@yield('title')</span>
                    </div>
                    <div class="uk-width-1-2">
                        @yield('actions')
                    </div>
                </div>
            </div>
        </div>

        <div class="uk-container uk-container-center" id="secondary-content-area">
            @yield('content')
        </div>
    </div>
</div>

<script src="{{ asset('vendor/laramanager/js/scripts.js') }}"></script>

<script>

    var funcNum = "{{ $funcNum }}";

    $(function(){

        $('.unselected-image').on('click', function(event) {

            event.preventDefault();

            file = $(this);
            fileUrl = file.attr('src');

            window.opener.CKEDITOR.tools.callFunction(funcNum, fileUrl, '');
            window.close();

        });

    });
</script>
@yield('scripts')

</body>
</html>