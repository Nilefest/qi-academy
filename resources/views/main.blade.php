@extends('layouts.app')

@section('header.css')
    <link href="{{ asset('css/team.css') }}?v={{ env('APP_VERSION') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/main.css') }}?v={{ env('APP_VERSION') }}" rel="stylesheet" type="text/css">
@endsection

@section('footer.js')
    <!-- JS. JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

    <!-- JS. Slick -->
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/slick/slick.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/slick/slick-theme.css') }}" />
    <script src="{{ asset('lib/slick/slick.min.js') }}"></script>
    <script src="{{ asset('lib/slick-init.js') }}?v={{ env('APP_VERSION') }}"></script>

    <!-- JS. Custom -->
    <script src="{{ asset('js/main.js') }}?v={{ env('APP_VERSION') }}"></script>
    <script src="{{ asset('js/team.js') }}?v={{ env('APP_VERSION') }}"></script>
@endsection

@section('modals')
    @include('layouts.modals.team_view')

    <!-- Modal. Booking to offline course -->
    <div class="modal_win modal_book_offline">
        <!-- without_media , success_step -->
        <i class="fal fa-times icon_close close"></i>
        <div class="media_info">
            <div class="video_from_vimeo"></div>
            {{-- <video controls><source src="/temp/video/video_background_1.mp4" type="video/mp4"></video> --}}
        </div>
        <div class="personal_data">
            <p class="text_info">Wypełnij formularz, aby zarezerwować udział w kursie mistrzowskim</p>
            <p class="text_info course_info">WARSZAWA 22/06</p>
            <div class="form">
                <input type="text" class="text name" placeholder="Nazwa">
                <input type="text" class="text phone" placeholder="+48 ___ ___ ___">
                <input type="button" class="button book_success" value="Wysłać">
            </div>
        </div>
        <div class="success_info">
            <p class="text_info">Dziękuję. <br>Oddzwonimy w celu potwierdzenia.</p><br>
            <input type="button" class="button close" value="Ok">
        </div>
    </div>
@endsection

@section('templates')
    <!-- Types of curse (4 items) -->
    <template class="tpl_cursers_item type_1">
        <!-- type 1 -->
        <li class="cursers_item">
            <div class="item_img" style="background-image: url(/temp/img/person_1.png);"></div>
            <div class="cursers_info">
                <span class="title">7 złych nawyków </span>
                <span class="info_tag">wideo</span>
                <span class="info_tag">15 minut</span>
            </div>
        </li>
    </template>
    <template class="tpl_cursers_item type_2">
        <!-- type 2 -->
        <li class="cursers_item">
            <div class="item_img" style="background-image: url(/temp/img/person_1.png);"></div>
            <div class="cursers_info">
                <a href="#curse_link" class="title">kolorystycznych</a>
                <span class="info_tag">tekst</span>
                <span class="info_tag">3 minut</span>
            </div>
        </li>
    </template>
    <template class="tpl_cursers_item type_3">
        <!-- type 3 -->
        <li class="cursers_item">
            <a href="#curse_link" class="item_img" style="background-image: url(/temp/img/person_1.png);"></a>
            <div class="cursers_info">
                <span class="title">kolorystycznych</span>
                <span class="info_tag">tekst</span>
                <span class="info_tag">3 minut</span>
            </div>
        </li>
    </template>
    <template class="tpl_cursers_item type_4">
        <!-- type 4 -->
        <li class="cursers_item">
            <a class="cursers_item_link" href="#curse_link">
                <div class="item_img" style="background-image: url(/temp/img/person_1.png);"></div>
                <div class="cursers_info">
                    <span class="title">kolorystycznych</span>
                    <span class="info_tag">tekst</span>
                    <span class="info_tag">3 minut</span>
                </div>
            </a>
        </li>
    </template>
@endsection

@section('content')
    <div class="content">
        <div class="main_banner container">
            <div class="main_banner_media">
                <video loop autoplay muted>
                    <source src="{{ url($media['main_header_banner']) }}" type="video/mp4">
                </video>
            </div>
            <div class="main_banner_info">
                <span class="title">Online academy</span>
                <h1>POZNAJ NASZĄ FILOZOFJĘ <br>KOLORYZACJI WŁOSÓW</h1>
                @guest
                    <button class="main_banner_button open_sign_modal">ZAREJESTRUJ SIĘ</button>
                @endguest
            </div>
        </div>

        @if ($social['youtube']['link'])
            <div class="slider_blog_youtube">
                <ul>
                    @for ($i = 0; $i < 5; $i++)
                        <li><a target="_blank" href="{{ $social['youtube']['link'] }}">BLOG YOUTUBE</a></li>
                    @endfor
                    <div class="clear"></div>
                </ul>
            </div>
        @endif

        @if (count($paid_courses))
            <div class="slider_courses container">
                <h3>POZNAJ PROGRAMY SZKOLENIOWE</h3>
                <ul class="slider_courses_ul">
                    @foreach ($paid_courses as $course)
                        <li class="slider_courses_li">
                            <a class="courses_link" style="background-image: url('{{ $course['banner_img'] }}')"
                                href="{{ route('course.view', $course['id']) }}">
                                <span class="title">{{ $course['name'] }}</span>
                                <span class="price">{{ $course['cost'] }} Zł</span>
                                <ul class="curs_info">
                                    <li>{{ $course['total_lectures'] }} Lekcje</li>
                                    <li>{{ $course['total_hours'] }} godziny</li>
                                </ul>
                            </a>
                        </li>
                    @endforeach
                </ul>
                <button class="d-none slider_courses_arrow prev">&#8592;</button>
                <button class="slider_courses_arrow next">&#8594;</button>
            </div>
        @endif

        @if ($courses_offline_list->count())
            <div class="block_events">
                <h3>HARMONOGRAM SZKOLEŃ OFFLINE</h3>
                <div class="table container">
                    @foreach ($courses_offline_list as $course_one)
                        <div class="row course_item" data-courseId="{{ $course_one->id }}"
                            data-courseVideo="{{ $course_one->video }}">
                            <span class="place">{{ $course_one->place }}</span>
                            <span class="date">{{ date('d/m/Y', strtotime($course_one->date_of)) }}</span>
                            <span class="time">{{ $course_one->period }}</span>
                            <span class="name">Lekcja: {{ $course_one->name }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        @if (!empty($main_educations))
            <div class="block_educations container">
                <h3>System edukacji</h3>
                <ul class="block_educations_ul">
                    @foreach ($main_educations as $education)
                        <li class="block_educations_li">
                            <span class="title"><span>{{ $education['title'] }}</span></span>
                            <span class="info">{{ $education['info'] }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if ($main_course)
            <div class="block_register container">
                <div class="block_register_media"></div>
                <div class="block_register_info">
                    <h3>ROZWIJAJ SIĘ W WYGODNY <br>DLA CIEBIE SPOSÓB. </h3>
                    <span class="info">Na komputerze, smartfonie <br>lub tablecie.</span>
                    <a href="{{ route('course.view', $main_course->id) }}" class="block_register_button">ZACZNIJ</a>
                </div>
            </div>
        @endif

        <div class="block_full_video">
            <div class="block_full_video_media">
                <video loop autoplay muted="muted">
                    <source src="{{ url($media['main_page_banner']) }}" type="video/mp4">
                </video>
            </div>
            <div class="block_full_video_info">
                <h3>JAK ODBYWAJĄ SIĘ NASZE <br>SZKOLENIA OFFLINE</h3>
                <button class="block_full_video_button">&#9654;</button>
            </div>
        </div>

        <div class="block_team container">
            <div class="block_team_info">
                <h3><b>CREATORS</b></h3>
                <a href="{{ url('/team') }}" class="title">Team</a>
            </div>

            <div class="block_team_slider">
                <ul class="block_team_ul">
                    @foreach ($team_list as $team_one)
                        <li class="block_team_li team_list_media team_one" data-teamInfo="{{ $team_one->info }}"
                            data-teamImg="{{ asset($team_one->img) }}" style="background-image: url({{ asset($team_one->img) }});">
                            <span class="name d-none">{{ $team_one->name }}</span>
                            @if ($team_one->facebook)
                                <a class="facebook_link d-none" href="{{ $team_one->facebook }}"></a>
                            @endif
                            @if ($team_one->instagram)
                                <a class="instagram_link d-none" href="{{ $team_one->instagram }}"></a>
                            @endif
                            <span class="team_open_modal view">View</span>
                        </li>
                    @endforeach
                </ul>

                <button class="d-none block_team_arrow prev">&#8592;</button>
                <button class="block_team_arrow next">&#8594;</button>
            </div>
        </div>

        @include('layouts.blocks.video_reviews')

        @if ($blog['watsapp_link'])
            <div class="block_blog_info">
                <div class="container">
                    <h3>Blog Qi academy</h3>
                    <span class="text_info">Nigdy nie dowiesz się wszystkiego. <br>Ale dowiesz się więcej.</span>
                </div>
            </div>

            <div class="block_cursers_list container">
                <ul class="cursers_list_ul">
                    <!-- type 1 -->
                    <li class="cursers_item">
                        <div class="item_img" style="background-image: url(./temp/img/person_1.png);"></div>
                        <div class="cursers_info">
                            <span class="title">7 złych nawyków </span>
                            <span class="info_tag">wideo</span>
                            <span class="info_tag">15 minut</span>
                        </div>
                    </li>
                    <!-- type 2 -->
                    <li class="cursers_item">
                        <div class="item_img" style="background-image: url(./temp/img/person_1.png);"></div>
                        <div class="cursers_info">
                            <a href="#curse_link" class="title">kolorystycznych</a>
                            <span class="info_tag">tekst</span>
                            <span class="info_tag">3 minut</span>
                        </div>
                    </li>
                    <!-- type 3 -->
                    <li class="cursers_item">
                        <a href="#curse_link" class="item_img"
                            style="background-image: url(./temp/img/person_1.png);"></a>
                        <div class="cursers_info">
                            <span class="title">kolorystycznych</span>
                            <span class="info_tag">tekst</span>
                            <span class="info_tag">3 minut</span>
                        </div>
                    </li>
                    <!-- type 4 -->
                    <li class="cursers_item">
                        <a class="cursers_item_link" href="#curse_link">
                            <div class="item_img" style="background-image: url(./temp/img/person_1.png);"></div>
                            <div class="cursers_info">
                                <span class="title">kolorystycznych</span>
                                <span class="info_tag">tekst</span>
                                <span class="info_tag">3 minut</span>
                            </div>
                        </a>
                    </li>
                </ul>

                <button class="cursers_more">Zobacz więcej</button>
            </div>

            <div class="block_link_info">
                <div class="container">
                    <h3>Dołącz do profesjonalnej <br>społeczności kosmetycznej</h3>
                    <a href="{{ $blog['watsapp_link'] }}" class="link_button">
                        <span>Nasza społeczność <br>na WhatsApp</span>
                        <img src="/img/icons/icons8-whatsapp-black.png" alt="Icon Watsapp">
                    </a>
                </div>
            </div>
        @endif

        @if ($shop_tool['header'])
            <div class="block_shop">
                <div class="block_shop_img">
                    <img src="{{ $shop_tool['img'] }}" alt=" ">
                </div>
                <div class="block_shop_info">
                    <h3>{{ $shop_tool['header'] }}</h3>
                    <p>{{ $shop_tool['info'] }}</p>
                    @if ($shop_tool['link'])
                        <a target="_blank" href="{{ $shop_tool['link'] }}"
                            class="block_shop_button">{{ $shop_tool['name'] }}</a>
                    @endif
                </div>
            </div>
        @endif

        @if (false)
            <div class="block_facebook_posts container">
                <h3>NASZ <span>Facebook</span></h3>
                <div class="facebook_posts" style="background-image: url(./temp/img/facebook_post_1.png);"></div>
            </div>
        @endif

        <div class="block_subscribe">
            <img src="./img/subscribe_back.png" alt=" " class="background_img">
            <div class="subscribe_field">
                <label for="subscribe_email">Zapisz się do newslettera</label>
                <input autocomplete="off" type="email" id="subscribe_email" class="subscribe_email"
                    placeholder="haircaut@gmail.com">
                <button class="subscribe_button">Go</button>
            </div>
        </div>
    </div>
@endsection
