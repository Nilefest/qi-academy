@extends('layouts.app')

@section('header.css')
    <link href="{{ asset('css/lecture.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/team.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('footer.js')
    <script src="{{ asset('js/team.js') }}"></script>
    <script src="{{ asset('js/lecture.js') }}"></script>
@endsection

@section('modals')
    <div class="modal_win modal_get_sertificate">
        <p class="message">Twoja prośba została zaakceptowana. Certyfikat zostanie wysłany na Twój e-mail w ciągu
            kilku minut.</p>
        <button class="button close">Ok</button>
    </div>

    @include('layouts.modals.send_review')
@endsection

@section('content')
    <div class="content course_content container">
        <div class="lesson_list ">
            <!-- add class "mobile_toggle_list" for activate alternative toggle-list (for mobile) -->

            <div class="lesson_list_menu">
                <input autocomplete="no" type="checkbox" class="d-none list_menu_check" id="list_menu_check">
                <label for="list_menu_check" class="button list_menu_button"><span>lista wideo</span> <i
                        class="fas fa-ellipsis-v icon_menu"></i></label>
                <ul class="list_menu_ul">
                    <li><a class="finished" href="#lecture">1. <span>Użycie narzędzi narzędzi narzędzi
                                narzędzi</span></a></li>
                    <li><a class="finished" href="#lecture">2. <span>Pierwsza duża praktyka</span></a></li>
                    <li><a class="active" href="#lecture">3. <span>Wnioski. druga duża praktyka</span></a></li>
                    <li><a href="#lecture">4. <span>Użycie narzędzi</span></a></li>
                    <li><a href="#lecture">5. <span>Pierwsza duża praktyka</span></a></li>
                    <li><a href="#lecture">6. <span>Wnioski. druga duża praktyka</span></a></li>
                </ul>
            </div>

            <h3><span>Lekcje</span> <i class="far fa-chevron-down icon_open"></i></h3>

            <ul class="lesson_list_ul">
                <li class="lesson_list_li">
                    <a href="#lessonopen" class="lesson_name">
                        <span class="num">1.</span>
                        <span class="title">Użycie narzędzi</span>
                        <i class="far fa-check-circle icon"></i>
                    </a>
                </li>
                <li class="lesson_list_li">
                    <a class="lesson_name" href="#lessonopen">
                        <span class="num">2.</span>
                        <span class="title">Pierwsza duża praktyka</span>
                        <i class="far fa-check-circle icon"></i>
                    </a>
                </li>
                <li class="lesson_list_li active">
                    <span class="lesson_name" href="#lessonopen">
                        <span class="num">3.</span>
                        <span class="title">Wnioski. druga duża praktyka</span>
                        <i class="far fa-circle icon"></i>
                    </span>
                </li>
                <li class="lesson_list_li">
                    <a class="lesson_name" href="#lessonopen">
                        <span class="num">4.</span>
                        <span class="title">Użycie narzędzi</span>
                        <i class="icon"></i>
                    </a>
                </li>
                <li class="lesson_list_li">
                    <a class="lesson_name" href="#lessonopen">
                        <span class="num">5.</span>
                        <span class="title">Pierwsza duża praktyka</span>
                    </a>
                </li>
                <li class="lesson_list_li">
                    <a class="lesson_name" href="#lessonopen">
                        <span class="num">6.</span>
                        <span class="title">Wnioski. druga duża praktyka</span>
                    </a>
                </li>
            </ul>

            <div class="finished_lesson_block unfinished">
                <h3 class="title">Obejrzałem wideo <span class="range"><span
                            class="current">3</span> / 4</span></h3>
                <p class="nofinished_info">Ukończ wszystkie wykłady i otrzymaj certyfikat</p>
                <button class="button finish_lesson"><span>Słuchałem</span> <i
                        class="far fa-check-circle icon"></i></button>
                <button class="button get_sertificate">Uzyskać certyfikat</button>
                <button class="send_review"><span>Wystawić opinię</span> <i
                        class="fas fa-hand-point-up icon"></i></button>
            </div>
        </div>
        <div class="lesson_block">
            <div class="lesson_media">
                <video loop controls>
                    <source src="/temp/video/video_expert.mp4" type="video/mp4">
                </video>
            </div>
            <div class="lesson_tools">
                <div class="instructor team_open_modal view">
                    <div class="avatar" style="background-image: url(/temp/img/team_1.png);"></div>
                    <span class="name">Instruktor <br>Herman <br>Ahafontsev</span>
                </div>
                <div class="course_buttons">
                    <button class="course_button download"><span>Pobierz materiały do nauki</span> <i
                            class="fal fa-download icon"></i></button>
                    <!--<a href="#course_download" download class="course_button download"><span>Pobierz materiały do nauki</span> <i class="fal fa-download icon"></i></a>-->
                </div>
            </div>
            <div class="lesson_info">
                <div class="lesson_description">
                    <p>Brazilian Technique - metoda rozjaśnienia przez tapirowanie wlosów. Będziemy pokazywać jak
                        pracować z tapirem w koloryzacjach włosów. Pokażemy nie tylko jak prawidłowo tapirować włosy, a
                        tak że jak rozczesywać tapir, żeby dla klienta to nie było "przykrym doświadczeniem". Brazilian
                        Technique - metoda rozjaśnienia przez tapirowanie wlosów. Będziemy pokazywać jak pracować z
                        tapirem w koloryzacjach włosów. Pokażemy nie tylko jak prawidłowo tapirować włosy, a tak że jak
                        rozczesywać tapir, żeby dla klienta to nie było "przykrym doświadczeniem". </p>
                    <ul>
                        <li>Pokażemy nie tylko jak prawidłowo tapirować</li>
                        <li>Pokażemy nie tylko jak prawidłowo tapirować</li>
                        <li>Pokażemy nie tylko jak prawidłowo tapirować</li>
                    </ul>
                </div>
                <div class="homework">
                    <h4 class="title">Zadanie domowe</h4>
                    <p class="homework_description">Brazilian Technique - metoda rozjaśnienia przez tapirowanie wlosów.
                        Będziemy pokazywać jak pracować z tapirem w koloryzacjach włosów. Pokażemy nie tylko jak
                        prawidłowo tapirować włosy, a tak że jak rozczesywać tapir, żeby dla klienta to nie było
                        "przykrym doświadczeniem".
                    </p>
                    <p class="homework_description info">Wyślij swoją pracę domową na ten mail, a na pewno odpowiemy.
                    </p>

                    <button class="homework_button send_homework button_copy"
                        data-textCopy="hair@qi.com"><span>hair@qi.com</span> <i class="fas fa-copy icon"></i></button>
                </div>
            </div>
        </div>

        <div class="finished_lesson_block unfinished mobile">
            <h3 class="title">Obejrzałem wideo <span class="range"><span class="current">3</span> /
                    4</span></h3>
            <p class="nofinished_info">Ukończ wszystkie wykłady i otrzymaj certyfikat</p>
            <button class="button finish_lesson"><span>Słuchałem</span> <i class="far fa-check-circle icon"></i></button>
            <button class="button get_sertificate">Uzyskać certyfikat</button>
            <button class="send_review"><span>Wystawić opinię</span> <i class="fas fa-hand-point-up icon"></i></button>
        </div>
    </div>
@endsection
