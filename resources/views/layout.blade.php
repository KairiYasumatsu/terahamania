<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>terahamania</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/top.css') }}" type="text/css" media="all">
    </head>
    <body>
            @include('common.header')

            <div id="main">
                @yield('content')
            </div>

            @include('common.footer')
            <script src="{{ mix('js/app.js') }}"></script> 
    </body>
</html>
