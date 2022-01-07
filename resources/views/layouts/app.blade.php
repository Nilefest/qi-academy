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
    <title>{{ $title }} | {{ config('app.name') }}</title>
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
<<<<<<< HEAD
    <link rel="stylesheet" href="./css/font-awesome-4.7.0.css">
=======
    <link rel="stylesheet" href="{{ asset('css/font-awesome-4.7.0.css') }}">
>>>>>>> dev

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
<<<<<<< HEAD
        @extends('layouts.modals.cookie')
=======
        @include('layouts.modals.cookie')
>>>>>>> dev

        <div class="modal">
            <!-- Modal. For view simple info -->
            <div class="modal_win modal_simple_info">
                <p class="message">Success!</p>
                <button class="button close">OK</button>
            </div>

            @include('layouts.modals.sign')
            @include('layouts.modals.video_view')
<<<<<<< HEAD
=======
            @include('layouts.modals.full_image')
>>>>>>> dev

            @yield('modals')
        </div>

        <div class="main_nav">
            <nav class="container">
                <ul class="main_nav_ul">
<<<<<<< HEAD
                    <li><a href="{{ url('/') }}">Dom</a></li>
                    <li><a href="{{ url('/about') }}">ONas</a></li>
                    <li><a href="{{ url('/team') }}">Team</a></li>
                </ul>
                <div class="main_nav_info">
                    <ul class="main_nav_contact">
                        <li><a href="#tel">+48 989 000 555</a></li>
                        <li><a href="#tel">+48 989 000 555</a></li>
                    </ul>
                    <button class="main_nav_button open_sign_modal">Obszar osobisty</button>
                    <!-- <a class="main_nav_logout" href="#logout">Log Out</a> -->
                </div>
                <ul class="main_nav_links">
                    <li><a href="#link">Polityka przetwarzania danych osobowych</a></li>
                    <li><a href="#link">Oferta publiczna</a></li>
                    <li><a href="#link">Ostrzeżenie o prawach autorskich</a></li>
                    <li><a href="#link">Płatność kartą kredytową</a></li>
=======
                    <li><a href="{{ url('/') }}">GŁÓWNA</a></li>
                    <li><a href="{{ route('about') }}">O Nas</a></li>
                    <li><a href="{{ route('team') }}">Team</a></li>
                    @auth
                    <li><a href="{{ route('account.courses') }}">Kursy</a></li>
                    @endauth
                </ul>
                <div class="main_nav_info">
                    <ul class="main_nav_contact">
                        <li><a
                                href="tel:{{ preg_replace('/[+ ]/m', '', $contacts['phone']['link']) }}">{{ $contacts['phone']['link'] }}</a>
                        </li>
                    </ul>
                    @guest
                        <button class="main_nav_button open_sign_modal">MOJE KONTO</button>
                    @endguest
                    @auth
                        <a class="main_nav_button" href="{{ route('home') }}">MOJE KONTO</a>
                        <a class="main_nav_logout" href="{{ url('/logout') }}">Logout</a>
                    @endauth
                </div>
                <ul class="main_nav_links">
                    @foreach ($main_links as $link)
                        <li><a target="_blank" href="{{ $link['url'] }}">{{ $link['name'] }}</a></li>
                    @endforeach
>>>>>>> dev
                </ul>
            </nav>
        </div>

        <header>
            <div class="container">
                <a href="{{ url('/') }}" class="logo" title="To main page">
<<<<<<< HEAD
                    <!-- <span class="account_logo">Moje biuro</span> -->
                    <span class="full_text">Qi ACADEMY</span>
                    <span class="short_text">Qi</span>
                </a>

                <!-- <div class="account"><a href="#account" class="account_button" style="background-image: url('https://robohash.org/qiacademy?set=set4');"></a></div> -->
=======
                    <span class="full_text"><img src="{{ asset('img/logo-short.png') }}" alt=""></span>
                    <span class="short_text"><img src="{{ asset('img/logo-short.png') }}"></span>
                </a>

                @auth
                    <div class="account"><a href="{{ route('home') }}" class="account_button"
                            style="background-image: url('{{ Auth::user()->avatar ? Auth::user()->avatar : asset('uploads/profile/default/9.jpeg') }}');"></a>
                    </div>
                @endauth
>>>>>>> dev

                <button class="nav_button" title="Open / Hide navigation"></button>
            </div>
        </header>

        @yield('content')

        <footer>
            <div class="container">
                <ul class="contact">
                    <li>
<<<<<<< HEAD
                        <a href="#watsapp">
                            <img src="/img/icons/icons8-whatsapp.png" alt="Icon Watsapp">
                            <span>Watsapp</span>
                        </a>
                    </li>
                    <li>
                        <a href="#facebook_messenger">
=======
                        <a target="_blank"
                            href="https://api.whatsapp.com/send/?phone={{ preg_replace('/[+ ]/m', '', $contacts['whatsapp']) }}&text=Hi!">
                            <img src="/img/icons/icons8-whatsapp.png" alt="Icon WhatsApp">
                            <span>WhatsApp</span>
                        </a>
                    </li>
                    <li>
                        <a target="_blank"
                            href="https://msng.link/o/?{{ preg_replace('/[+ ]/m', '', $contacts['facebook_messenger']) }}=fm">
>>>>>>> dev
                            <img src="/img/icons/icons8-facebook-messenger.png" alt="Icon Facebook Messenger">
                            <span>Facebook Messenger</span>
                        </a>
                    </li>
                    <li>
<<<<<<< HEAD
                        <a href="#phone">
                            <img src="/img/icons/icons8-phone.png" alt="Icon Phone">
                            <span>+48 949 000 555</span>
=======
                        <a href="tel:{{ preg_replace('/[+ ]/m', '', $contacts['phone']['link']) }}"">
                            <img src=" /img/icons/icons8-phone.png" alt="Icon Phone">
                            <span>{{ $contacts['phone']['link'] }}</span>
>>>>>>> dev
                        </a>
                    </li>
                </ul>

                <div class="footer_info">
                    <ul class="links">
<<<<<<< HEAD
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
=======
                        @foreach ($main_links as $link)
                            <li><a target="_blank" href="{{ $link['url'] }}">{{ $link['name'] }}</a></li>
                        @endforeach
                    </ul>

                    <ul class="social">
                        <li><a target="_blank" href="{{ $social['facebook']['link'] }}"><i
                                    class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
                        <li><a target="_blank" href="{{ $social['instagram']['link'] }}"><i
                                    class="fa fa-instagram" aria-hidden="true"></i></a>
                        </li>
                        <li><a target="_blank" href="{{ $social['youtube']['link'] }}"><i
                                    class="fa fa-youtube-play" aria-hidden="true"></i></a>
                        </li>
                    </ul>

                    <div class="footer_buttons">
                        @guest
                            <button class="footer_button open_sign_modal">MOJE KONTO</button>
                        @endguest
                        @auth
                            <a class="footer_button" href="{{ route('home') }}">MOJE KONTO</a>
                        @endauth
>>>>>>> dev
                    </div>
                </div>
            </div>
        </footer>

        <!-- Templates -->
<<<<<<< HEAD
        @yield('templats')

        <!-- JS. Common -->
        <script src="{{ asset('js/script.js') }}"></script>
=======
        @yield('templates')

        <!-- JS. Common -->
        <script src="{{ asset('js/script.js') }}?v={{ env('APP_VERSION') }}"></script>
>>>>>>> dev

        @yield('footer.js')
    </div>
</body>

</html>
