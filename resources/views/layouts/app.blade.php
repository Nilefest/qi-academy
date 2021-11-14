<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }} | {{ config('app.name') }}</title>

    <meta name="description" content="{{ $description }}">
    <meta name="keywords" content="{{ $keywords }}">

    <!-- OG Tags -->
    <meta property="og:title"
        content="{{ $title }} | {{ config('app.name') }}">
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:type" content="website">
    {{-- <!--<meta property="og:image" content="{{ url('') . $header['image_url'] }}">--> --}}
    <!--<meta property="og:site_name" content="{{ $site_name }}">-->

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
    <link href="{{ asset('css/font-awesome-4.7.0.css') }}" rel="stylesheet">

    <!-- CSS. Bootstrap -->
    <link href="{{ asset('css/bootstrap-reboot.min.css') }}" type="text/css" rel="stylesheet">


    <!-- CSS. Common -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/modals.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/animations.css') }}" rel="stylesheet" type="text/css">

    <!-- CSS. Custom -->
    @yield('header.css')

</head>

<body>
    <div id="app">
        <!-- Modal. Cookie`s message -->
        <div class="cookie_message">
            <div class="message_info">
                <h3 class="title">Zanim zaczniesz zakupy</h3>
                <p class="text_info">Używamy plików cookie do dostosowywania i ulepszania wyświetlanych Ci treści,
                    zapewniając najlepszą jakość zakupów online. Jeśli klikniesz „Akceptuj wszystkie pliki cookie”,
                    możemy
                    nadal wyświetlać spersonalizowane oferty i inspiracje w oparciu o Twoje preferencje. Jeśli chcesz
                    dowiedzieć się więcej o plikach cookie i dlaczego ich używamy, odwiedź naszą stronę "Zasady
                    dotyczące
                    plików cookie".</p>
            </div>
            <div class="message_buttons">
                <button class="button cookie_success">AKCEPTUJ WSZYSTKIE PLIKI COOKIE</button>
                <a href="#" class="mess_link">Ustwienia plików cookie</a>
            </div>
        </div>

        <div class="modal">
            <!-- Modal. For auth -->
            <div class="modal_win container modal_sign_account signup_step">
                <div class="step_block signup_block">
                    <h3>Create Account</h3>
                    <button class="login_button google">
                        <i class="fab fa-google icon"></i>
                        <span class="title">Sign up with Google</span>
                    </button>
                    <button class="login_button facebook">
                        <i class="fab fa-facebook icon"></i>
                        <span class="title">Sign up with Facebook</span>
                    </button>
                    <p class="keep_me">
                        <i class="far fa-check-square icon"></i>
                        <span class="title">Keep me up to date on class events and new releases.</span>
                    </p>
                    <button class="login_button submit">Create account</button>
                    <p class="already">Already have an account? <span class="step_toggle to_signin">Sign
                            In</span>.</p>
                    <p class="policy">By signing up or creating an account, you agree to our <a
                            href="#doc">Polityka
                            przetwarzania danych osobowych</a> and <a href="#doc">Oferta publiczna</a>.</p>
                </div>
                <div class="step_block signin_block">
                    <h3>Sign in</h3>
                    <button class="login_button google">
                        <i class="fab fa-google icon"></i>
                        <span class="title">Sign up with Google</span>
                    </button>
                    <button class="login_button facebook">
                        <i class="fab fa-facebook icon"></i>
                        <span class="title">Sign up with Facebook</span>
                    </button>
                    <p class="already">Need an account? <span class="step_toggle to_signup">Sign Up</span>.</p>
                    <p class="policy">By signing up or creating an account, you agree to our <a
                            href="#doc">Polityka
                            przetwarzania danych osobowych</a> and <a href="#doc">Oferta publiczna</a>.</p>
                </div>
            </div>

            <!-- Modal. Show video -->
            <div class="modal_win container modal_view_video">
                <div class="modal_header">
                    <div class="buttons">
                        <button class="modal_button close">Close</button>
                    </div>
                </div>
                <div class="modal_content">
                    <video loop controls>
                        <source src="/temp/video/video_expert.mp4" type="video/mp4">
                    </video>
                </div>
                <div class="modal_footer">
                    <div class="buttons">
                        <button class="modal_button video_play">&#9654;</button>
                        <button class="modal_button video_pause">&#9612; &#9612;</button>
                    </div>
                    <div class="line"></div>
                    <div class="buttons">
                        <button class="modal_button close">Close</button>
                    </div>
                </div>
            </div>

            @yield('modals')
        </div>

        <div class="main_nav">
            <nav class="container">
                <ul class="main_nav_ul">
                    <li><a href="#nav">Dom</a></li>
                    <li><a href="#nav">Kursy</a></li>
                    <li><a href="#nav">Team</a></li>
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

        <div class="content">
            @yield('content')
        </div>

        <footer>
            <div class="container">
                <ul class="contact">
                    <li>
                        <a href="#watsapp">
                            <img src="./img/icons/icons8-whatsapp.png" alt="Icon Watsapp">
                            <span>Watsapp</span>
                        </a>
                    </li>
                    <li>
                        <a href="#facebook_messenger">
                            <img src="./img/icons/icons8-facebook-messenger.png" alt="Icon Facebook Messenger">
                            <span>Facebook Messenger</span>
                        </a>
                    </li>
                    <li>
                        <a href="#phone">
                            <img src="./img/icons/icons8-phone.png" alt="Icon Phone">
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


        <!-- JS. Vue: 1) for dev, 2) for release -->
        <!-- <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script> -->
        <!-- <script src="https://cdn.jsdelivr.net/npm/vue@2"></script> -->

        <!-- JS. JQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

        <!-- JS. Slick -->
        <link rel="stylesheet" type="text/css" href="{{ asset('lib/slick/slick.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('lib/slick/slick-theme.css') }}">
        <script src="{{ asset('lib/slick/slick.min.js') }}"></script>
        
        <!-- JS. Slick. Init all -->
        <script src="{{ asset('js/sliders.js') }}"></script>

        <!-- JS. Common -->
        <script src="{{ asset('js/script.js') }}"></script>

        <!-- JS. Custom -->
        @yield('footer.js')
    </div>

    @yield('footer.js')
</body>

</html>
