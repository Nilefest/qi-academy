<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @if(isset($title))
    <title>{{ $title }} | ADM {{ config('app.name') }}</title>
    @else
    <title>ADM | {{ config('app.name') }}</title>
    @endif

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
    <link rel="stylesheet" href="{{ asset('css/adm_dashboard.css') }}">

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

            @yield('modals')
        </div>

        <header>
            <div class="container">
                <a href="{{ url('/admin') }}" class="logo" title="To Admin panel">
                    <span class="full_text">Qi ADMIN</span>
                    <span class="short_text">Qi</span>
                </a>
    
                <a href="{{ url('/') }}" class="to_site">QILABEL.COM <i class="fas fa-link icon_link"></i></a>
    
                {{-- <a href="{{ url('/admin') }}#setting" class="to_setting">Настройки админ панели <i class="fas fa-cog icon_link"></i></a> --}}
    
                <a href="/logout" class="logout">Выйти</a>
            </div>
        </header>

        @yield('content')

        <footer>
            <div class="container">
                <ul class="contact">
                    <li>
                        <a href="#watsapp">
                            <img src="/img/icons/icons8-whatsapp.png" alt="Icon Watsapp">
                            <span>Watsapp</span>
                        </a>
                    </li>
                    <li>
                        <a href="#facebook_messenger">
                            <img src="/img/icons/icons8-facebook-messenger.png" alt="Icon Facebook Messenger">
                            <span>Facebook Messenger</span>
                        </a>
                    </li>
                    <li>
                        <a href="#phone">
                            <img src="/img/icons/icons8-phone.png" alt="Icon Phone">
                            <span>+48 949 000 555</span>
                        </a>
                    </li>
                </ul>

                <div class="footer_info">
                    <ul class="links">
                        <li><a href="#footer_link">Polityka przetwarzania danych osobowych</a></li>
                        <li><a href="#footer_link">Oferta publiczna</a></li>
                        <li><a href="#footer_link">Płatność kartą kredytową</a></li>
                    </ul>

                    <ul class="social">
                        <li><a href="#facebook"><i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
                        <li><a href="#instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                        <li><a href="#youtube"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
                    </ul>

                    <div class="footer_buttons">
                        <button class="footer_button">Obszar osobisty</button>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Templates -->
        @yield('templates')

        <!-- JS. Common -->
        <script src="{{ asset('js/script.js') }}"></script>

        @yield('footer.js')
    </div>
</body>

</html>
