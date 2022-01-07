<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

<<<<<<< HEAD
    <title>{{ config('app.name', 'Laravel') }}</title>
=======
    @if(isset($title))
    <title>{{ $title }} | AUTH   {{ config('app.name') }}</title>
    @else
    <title>AUTH | {{ config('app.name') }}</title>
    @endif
>>>>>>> dev

    <!-- Fonts. Google: Montserrat, Lato -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
        rel="stylesheet">

    <!-- Fonts. Icons -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="./css/font-awesome-4.7.0.css">

    <!-- CSS. Bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap-reboot.min.css') }}">

    <!-- CSS. Common -->
<<<<<<< HEAD
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/modals.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animations.css') }}">
=======
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ env('APP_VERSION') }}">
    <link rel="stylesheet" href="{{ asset('css/modals.css') }}?v={{ env('APP_VERSION') }}">
    <link rel="stylesheet" href="{{ asset('css/animations.css') }}?v={{ env('APP_VERSION') }}">
>>>>>>> dev

    <!-- CSS. Custom -->
    @yield('header.css')

</head>

<body>
    <div id="app">
        @extends('layouts.modals.cookie')

        <div class="modal">
            <!-- Modal. For view simple info -->
            <div class="modal_win modal_simple_info">
                <p class="message">Success!</p>
                <button class="button close">OK</button>
            </div>

            @include('layouts.modals.sign')

            @yield('modals')
        </div>

        @yield('header')
        @yield('content')
        @yield('footer')

        <!-- Templates -->
        @yield('templats')

        <!-- JS. Common -->
<<<<<<< HEAD
        <script src="{{ asset('js/script.js') }}"></script>
=======
        <script src="{{ asset('js/script.js') }}?v={{ env('APP_VERSION') }}"></script>
>>>>>>> dev

        @yield('footer.js')
    </div>
</body>

</html>
