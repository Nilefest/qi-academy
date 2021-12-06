@extends('layouts.app')

@section('header.css')
    <link href="{{ asset('css/profile_courses.css') }}?v={{ env('APP_VERSION') }}" rel="stylesheet" type="text/css">
@endsection

@section('footer.js')
    <!-- JS. JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

    <!-- JS. Slick -->
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/slick/slick.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/slick/slick-theme.css') }}" />
    <script src="{{ asset('lib/slick/slick.min.js') }}"></script>
    <script src="{{ asset('lib/slick-init.js') }}?v={{ env('APP_VERSION') }}"></script>

    <script src="{{ asset('js/profile.js') }}?v={{ env('APP_VERSION') }}"></script>
@endsection

@section('content')
    <div class="content container course_container">
        <div class="course_list">
            <h3>Moje kursy</h3>
            <ul class="course_list_ul">
                <!-- type 1 -->
                <li class="course_list_li check">
                    <div style="background-image: url(/temp/img/slider_courses_1.png);" class="image"></div>
                    <a href="#course_one" class="name">Colorist pro</a>
                    <span class="time_info">Czas do końca dostępu <br>do kursu: <b>25 dni</b></span>
                </li>
                <!-- type 2 -->
                <li class="course_list_li">
                    <a href="#course_one">
                        <div style="background-image: url(/temp/img/slider_courses_2.png);" class="image"></div>
                        <span class="name">Colorist pro</span>
                        <span class="time_info">Czas do końca dostępu <br>do kursu: <b>25 dni</b></span>
                    </a>
                </li>
                <!-- type 3 -->
                <li class="course_list_li">
                    <a href="#course_one" style="background-image: url(/temp/img/slider_courses_1.png);"
                        class="image"></a>
                    <span class="name">Colorist pro</span>
                    <span class="time_info">Czas do końca dostępu <br>do kursu: <b>25 dni</b></span>
                </li>

                <!-- other -->
                <li class="course_list_li">
                    <div style="background-image: url(/temp/img/slider_courses_2.png);" class="image"></div>
                    <span class="name">Colorist pro</span>
                    <span class="time_info">Czas do końca dostępu <br>do kursu: <b>25 dni</b></span>
                </li>
                <li class="course_list_li">
                    <div style="background-image: url(/temp/img/slider_courses_1.png);" class="image"></div>
                    <span class="name">Colorist pro</span>
                    <span class="time_info">Czas do końca dostępu <br>do kursu: <b>25 dni</b></span>
                </li>
                <li class="course_list_li">
                    <div style="background-image: url(/temp/img/slider_courses_2.png);" class="image"></div>
                    <span class="name">Colorist pro</span>
                    <span class="time_info">Czas do końca dostępu <br>do kursu: <b>25 dni</b></span>
                </li>
            </ul>
            <button class="course_list_arrow prev">&#8592;</button>
            <button class="course_list_arrow next">&#8594;</button>
        </div>

        <div class="course_list">
            <h3>Moje premie</h3>
            <ul class="course_list_ul">
                <li class="course_list_li">
                    <div style="background-image: url(/temp/img/slider_courses_2.png);" class="image"></div>
                    <span class="name">Colorist pro</span>
                    <span class="time_info">Czas do końca dostępu <br>do kursu: <b>25 dni</b></span>
                </li>
            </ul>
            <button class="course_list_arrow prev">&#8592;</button>
            <button class="course_list_arrow next">&#8594;</button>
        </div>

        <div class="course_list">
            <h3>Wszystkie kursy</h3>
            <ul class="course_list_ul">
                <li class="course_list_li check">
                    <div style="background-image: url(/temp/img/slider_courses_1.png);" class="image"></div>
                    <span class="name">Colorist pro</span>
                    <span class="time_info">Czas do końca dostępu <br>do kursu: <b>25 dni</b></span>
                </li>
                <li class="course_list_li check">
                    <div style="background-image: url(/temp/img/slider_courses_2.png);" class="image"></div>
                    <span class="name">Colorist pro</span>
                    <span class="time_info">Czas do końca dostępu <br>do kursu: <b>25 dni</b></span>
                </li>
                <li class="course_list_li">
                    <div style="background-image: url(/temp/img/slider_courses_2.png);" class="image"></div>
                    <span class="name">Colorist pro</span>
                    <span class="time_info">Czas do końca dostępu <br>do kursu: <b>25 dni</b></span>
                </li>
            </ul>
            <button class="course_list_arrow prev">&#8592;</button>
            <button class="course_list_arrow next">&#8594;</button>
        </div>
    </div>
@endsection
