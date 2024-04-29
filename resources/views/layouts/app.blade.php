<!DOCTYPE html>
<html lang="{{ str_replace('-', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('assets/style.css')}}">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
        <script src="https://unpkg.com/htmx.org@1.9.12" integrity="sha384-ujb1lZYygJmzgSwoxRggbCHcjc0rB2XoQrxeTUQyRjrOnlCoYta87iKBWq3EsdM2" crossorigin="anonymous"></script>
        <style>
            @keyframes slide-from-right {
                from { transform: translateX(90px); }
            }

            @keyframes slide-from-left {
                from { transform: translateX(-90px); }
            }

            .next {
                view-transition-name: next;
            }

            .previous {
                view-transition-name: previous;
            }

            ::view-transition-new(next) {
                animation: 100ms cubic-bezier(0.4, 0, 0.2, 1) both slide-from-right;
            }

            ::view-transition-new(previous) {
                animation: 100ms cubic-bezier(0.4, 0, 0.2, 1) both slide-from-left;
            }
        </style>
        <style>
            .htmx-indicator{
                opacity:0;
                transition: opacity 500ms ease-in;
            }
            .htmx-request .htmx-indicator{
                opacity:1
            }
            .htmx-request.htmx-indicator{
                opacity:1
            }
        </style>
        <title>Laravel</title>
    </head>
    <body hx-boost="true">
        <header>
            @include('helpers.header')
        </header>
        @yield('content')
    </body>
</html>
