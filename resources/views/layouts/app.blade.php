<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }} | {{ config('app.name') }}</title>

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
    <link rel="stylesheet" href="{{ asset('css/font-awesome-4.7.0.css') }}">

    <!-- CSS. Bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap-reboot.min.css') }}">

    <!-- CSS. Common -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/modals.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animations.css') }}">

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
            @include('layouts.modals.video_view')

            @yield('modals')
        </div>

        <div class="main_nav">
            <nav class="container">
                <ul class="main_nav_ul">
                    <li><a href="{{ url('/') }}">Dom</a></li>
                    <li><a href="{{ url('/about') }}">ONas</a></li>
                    <li><a href="{{ url('/team') }}">Team</a></li>
                </ul>
                <div class="main_nav_info">
                    <ul class="main_nav_contact">
                        <li><a
                                href="tel:{{ preg_replace('/[+ ]/m', '', $contacts['phones']) }}">{{ $contacts['phones'] }}</a>
                        </li>
                    </ul>
                    @guest
                        <button class="main_nav_button open_sign_modal">Obszar osobisty</button>
                    @endguest
                    @auth
                        <a class="main_nav_button" href="{{ url('/home') }}">Obszar osobisty</a>
                        <a class="main_nav_button" href="{{ url('/logout') }}">Logout</a>
                    @endauth
                </div>
                <ul class="main_nav_links">
                    @foreach ($main_links as $link)
                        <li><a href="{{ $link['url'] }}">{{ $link['name'] }}</a></li>
                    @endforeach
                </ul>
            </nav>
        </div>

        <header>
            <div class="container">
                <a href="{{ url('/') }}" class="logo" title="To main page">
                    <!-- <span class="account_logo">Moje biuro</span> -->
                    <span class="full_text">Qi ACADEMY</span>
                    <span class="short_text">Qi</span>
                </a>

                <!-- <div class="account"><a href="#account" class="account_button" style="background-image: url('https://robohash.org/qiacademy?set=set4');"></a></div> -->

                <button class="nav_button" title="Open / Hide navigation"></button>
            </div>
        </header>

        @yield('content')

        <footer>
            <div class="container">
                <ul class="contact">
                    <li>
                        <a target="_blank"
                            href="https://api.whatsapp.com/send/?phone={{ preg_replace('/[+ ]/m', '', $contacts['whatsapp']) }}&text=Hi!">
                            <img src="/img/icons/icons8-whatsapp.png" alt="Icon Watsapp">
                            <span>Watsapp</span>
                        </a>
                    </li>
                    <li>
                        <a target="_blank" href="https://msng.link/o/?48796816953=fm">
                            <img src="/img/icons/icons8-facebook-messenger.png" alt="Icon Facebook Messenger">
                            <span>Facebook Messenger</span>
                        </a>
                    </li>
                    <li>
                        <a href="tel:{{ preg_replace('/[+ ]/m', '', $contacts['phones']) }}"">
                            <img src=" /img/icons/icons8-phone.png" alt="Icon Phone">
                            <span>{{ $contacts['phones'] }}</span>
                        </a>
                    </li>
                </ul>

                <div class="footer_info">
                    <ul class="links">
                        @foreach ($main_links as $link)
                            <li><a href="{{ $link['url'] }}">{{ $link['name'] }}</a></li>
                        @endforeach
                    </ul>

                    <ul class="social">
                        <li><a target="_blank" href="{{ $social['academy']['facebook'] }}"><i class="fa fa-facebook-official"
                                    aria-hidden="true"></i></a></li>
                        <li><a target="_blank" href="{{ $social['academy']['instagram'] }}"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                        </li>
                        <li><a target="_blank" href="{{ $social['academy']['youtube'] }}"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                        </li>
                    </ul>

                    <div class="footer_buttons">
                        @guest
                            <button class="footer_button open_sign_modal">Obszar osobisty</button>
                        @endguest
                        @auth
                            <a class="footer_button" href="{{ url('/home') }}">Obszar osobisty</a>
                        @endauth
                    </div>
                </div>
            </div>
        </footer>

        <!-- Templates -->
        @yield('templats')

        <!-- JS. Common -->
        <script src="{{ asset('js/script.js') }}"></script>

        @yield('footer.js')
    </div>
</body>

</html>
