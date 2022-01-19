<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- HTML Meta Tags -->
    <title>{{ $title }} | {{ config('app.name') }}</title>
    <meta name="description" content="{{ $description }}" />

    <!-- Facebook Meta Tags -->
    {{-- <meta property="og:url" content="https://qilabel.com/course/16/"> --}}
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $title }} | {{ config('app.name') }}">
    <meta property="og:description" content="{{ $description }}">
    {{-- <meta property="og:image" content="{{ asset('img/logo.png') }}"> --}}

    <!-- Twitter Meta Tags -->
    {{-- <meta name="twitter:card" content="summary_large_image"> --}}
    <meta property="twitter:domain" content="qilabel.com">
    {{-- <meta property="twitter:url" content="https://qilabel.com/course/16/"> --}}
    <meta name="twitter:title" content="{{ $title }} | {{ config('app.name') }}">
    <meta name="twitter:description" content="{{ $description }}">
    {{-- <meta name="twitter:image" content="{{ asset('img/logo.png') }}"> --}}

    <!-- Favicons -->
    <link rel="shortcut icon" href="{{ asset('img/logo-short.ico') }}" />
    <link rel="icon" type="image/png" href="{{ asset('img/logo-short.png') }}" />

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
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ env('APP_VERSION') }}">
    <link rel="stylesheet" href="{{ asset('css/modals.css') }}?v={{ env('APP_VERSION') }}">
    <link rel="stylesheet" href="{{ asset('css/animations.css') }}?v={{ env('APP_VERSION') }}">

    <!-- CSS. Custom -->
    @yield('header.css')

</head>

<body>
    <div id="app">
        @include('layouts.modals.cookie')

        <div class="modal">
            <!-- Modal. For view simple info -->
            <div class="modal_win modal_simple_info">
                <p class="message">Success!</p>
                <button class="button close">OK</button>
            </div>

            @include('layouts.modals.sign')
            @include('layouts.modals.video_view')
            @include('layouts.modals.full_image')

            @yield('modals')
        </div>

        <div class="main_nav">
            <nav class="container">
                <ul class="main_nav_ul">
                    <li><a href="{{ url('/') }}">GŁÓWNA</a></li>
                    <li><a href="{{ route('about') }}">O Nas</a></li>
                    <li><a href="{{ route('team') }}">Team</a></li>
                    @auth
                        @if (Auth::user()->hasVerifiedEmail())
                            <li><a href="{{ route('account.courses') }}">Kursy</a></li>
                        @endif
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
                        <a class="main_nav_logout" href="{{ url('/logout') }}">Wyloguj się</a>
                    @endauth
                </div>
                <ul class="main_nav_links">
                    @foreach ($main_links as $link)
                        <li><a target="_blank"
                                href="{{ $link['url'] }}?v={{ env('APP_VERSION') }}">{{ $link['name'] }}</a>
                        </li>
                    @endforeach
                </ul>
            </nav>
        </div>

        <header>
            <div class="container">
                <span class="logo">
                    <a href="{{ url('/') }}">
                        <span class="full_text"><img src="{{ asset('img/logo-short.png') }}" alt=""></span>
                        <span class="short_text"><img src="{{ asset('img/logo-short.png') }}"></span>
                    </a>
                </span>

                @auth
                    <div class="account"><a href="{{ route('home') }}" class="account_button"
                            style="background-image: url('{{ Auth::user()->avatar ? Auth::user()->avatar : asset('uploads/profile/default/' . rand(1, 18) . '.jpg') }}');"></a>
                    </div>
                @endauth

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
                            <img src="/img/icons/icons8-whatsapp.png" alt="Icon WhatsApp">
                            <span>WhatsApp</span>
                        </a>
                    </li>
                    <li>
                        <a target="_blank"
                            href="https://msng.link/o/?{{ preg_replace('/[+ ]/m', '', $contacts['facebook_messenger']) }}=fm">
                            <img src="/img/icons/icons8-facebook-messenger.png" alt="Icon Facebook Messenger">
                            <span>Facebook Messenger</span>
                        </a>
                    </li>
                    <li>
                        <a href="tel:{{ preg_replace('/[+ ]/m', '', $contacts['phone']['link']) }}"">
                            <img src=" /img/icons/icons8-phone.png" alt="Icon Phone">
                            <span>{{ $contacts['phone']['link'] }}</span>
                        </a>
                    </li>
                </ul>

                <div class="footer_info">
                    <ul class="links">
                        @foreach ($main_links as $link)
                            <li><a target="_blank"
                                    href="{{ $link['url'] }}?v={{ env('APP_VERSION') }}">{{ $link['name'] }}</a>
                            </li>
                        @endforeach
                    </ul>

                    <ul class="social">
                        <li><a target="_blank" href="{{ $social['facebook']['link'] }}"><i
                                    class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
                        <li><a target="_blank" href="{{ $social['instagram']['link'] }}"><i class="fa fa-instagram"
                                    aria-hidden="true"></i></a>
                        </li>
                        <li><a target="_blank" href="{{ $social['youtube']['link'] }}"><i class="fa fa-youtube-play"
                                    aria-hidden="true"></i></a>
                        </li>
                    </ul>

                    <div class="footer_buttons">
                        @guest
                            <button class="footer_button open_sign_modal">MOJE KONTO</button>
                        @endguest
                        @auth
                            <a class="footer_button" href="{{ route('home') }}">MOJE KONTO</a>
                        @endauth
                    </div>
                </div>
            </div>
        </footer>

        <!-- Templates -->
        @yield('templates')

        <!-- JS. Common -->
        <script src="{{ asset('js/script.js') }}?v={{ env('APP_VERSION') }}"></script>

        @yield('footer.js')
    </div>
</body>

</html>
