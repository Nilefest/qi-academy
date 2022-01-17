@extends('layouts.app')

@section('header.css')
    <link href="{{ asset('css/lecture.css') }}?v={{ env('APP_VERSION') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/team.css') }}?v={{ env('APP_VERSION') }}" rel="stylesheet" type="text/css">
@endsection

@section('footer.js')
    <script src="{{ asset('js/team.js') }}?v={{ env('APP_VERSION') }}"></script>
    <script src="{{ asset('js/lecture.js') }}?v={{ env('APP_VERSION') }}"></script>
@endsection

@section('modals')
    <div class="modal_win modal_get_sertificate">
        <p class="message">Gratulujemy ukończenia kursu! Elektroniczną kopię certyfikatu możesz pobrać dowolną ilość razy.</p>
        <button class="button close">Ok</button>
    </div>

    @include('layouts.modals.send_review')
    @include('layouts.modals.team_view')
@endsection

@section('content')
    @if (!count($lectures))
        <style>
            .lesson_tools .course_buttons {
                margin: 0px;
            }

            .course_buttons .course_button .icon {
                font-size: 1.5em;
            }

        </style>
        <div class="content course_content container lecture_one">
            <div class="lesson_block">
                <div class="lesson_info">
                    <div class="lesson_description">
                        <h1>There are no lectures in this course</h1>
                        <p></p>
                    </div>
                </div>
                <div class="lesson_tools">
                    <div class="course_buttons">
                        <a href="{{ route('course.view', $course_id) }}" class="course_button download"><i
                                class="fal fa-chevron-left icon"></i> <span>Back to course</span></a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="content course_content container lecture_one"
            data-formAction="{{ route('courses.lecture.post', [$course_id, $lecture_this['id'], $user_id]) }}"
            data-lectureId="{{ $lecture_this['id'] }}" data-userId="{{ $user_id }}"
            data-courseId="{{ $course_id }}">
            <div class="lesson_list ">
                <!-- add class "mobile_toggle_list" for activate alternative toggle-list (for mobile) -->

                <div class="lesson_list_menu">
                    <input autocomplete="no" type="checkbox" class="d-none list_menu_check" id="list_menu_check">
                    <label for="list_menu_check" class="button list_menu_button"><span>lista wideo</span> <i
                            class="fas fa-ellipsis-v icon_menu"></i></label>
                    <ul class="list_menu_ul">
                        @foreach ($lectures as $key => $lecture)
                            <li><a class="@if ($lecture['date_of_completed'] !== '') finished @endif @if ($lecture['id'] === $lecture_this->id) active @endif"
                                    href="{{ route('courses.lecture', $lecture['course_id'], $lecture['id'], $user_id) }}">{{ $key + 1 }}.
                                    <span>{{ $lecture['name'] }}</span></a></li>
                        @endforeach
                    </ul>
                </div>

                <h3><span>Lekcje</span> <i class="far fa-chevron-down icon_open"></i></h3>

                <ul class="lesson_list_ul">
                    @foreach ($lectures as $key => $lecture)
                        <li class="lesson_list_li @if ($lecture['id'] === $lecture_this->id) active @endif">
                            <a href="{{ route('courses.lecture', [$lecture['course_id'], $lecture['id'], $user_id]) }}"
                                class="lesson_name">
                                <span class="num">{{ $key + 1 }}.</span>
                                <span class="title">{{ $lecture['name'] }}</span>
                                @if ($lecture['date_of_completed'] !== '')
                                    <i class="far fa-check-circle icon"></i>
                                @else
                                    <i class="far fa-circle icon"></i>
                                @endif
                            </a>
                        </li>
                    @endforeach
                </ul>

                <div class="finished_lesson_block @if ($lectures_completed->count() === count($lectures)) finished @else unfinished @endif">
                    <h3 class="title">Obejrzałem wideo <span class="range"><span
                                class="current">{{ $lectures_completed->count() }}</span> /
                            {{ count($lectures) }}</span></h3>
                    <p class="nofinished_info">Ukończ wszystkie wykłady i otrzymaj certyfikat</p>
                    @if ($course_user['date_of_completed'])
                        <button class="button finish_lesson"><span>Oglądane</span> <i
                                class="far fa-check-circle icon"></i></button>
                        <a download href="{{ route('courses.sertificate', [$course_id, $user_id]) }}" class="button get_sertificate">Uzyskać certyfikat</a>
                        <button class="send_review"><span>Wystawić opinię</span> <i
                                class="fas fa-hand-point-up icon"></i></button>
                    @endif
                </div>
            </div>
            <div class="lesson_block">
                <div class="lesson_media">
                    {!! $lecture_this['video'] !!}
                </div>
                <div class="lesson_tools">
                    <div class="instructor team_one team_open_modal view" data-teamInfo="{{ $team_one->info }}"
                        data-teamImg="{{ asset($team_one->img) }}">
                        <div class="avatar" style="background-image: url('{{ asset($team_one->img) }}');"></div>
                        <span class="name">{{ $team_one->name }}</span>
                    </div>
                    <div class="course_buttons">
                        @if ($lecture_this->file)
                            <a href="{{ asset($lecture_this->file) }}" download
                                class="course_button download"><span>Pobierz
                                    materiały do nauki</span> <i class="fal fa-download icon"></i></a>
                        @endif
                    </div>
                </div>
                <div class="lesson_info">
                    <div class="lesson_description">
                        <p>{{ $lecture_this->info_full }} </p>
                    </div>
                    @if ($lecture_this->homework)
                        <div class="homework">
                            <h4 class="title">Praca domowa</h4>
                            <p class="homework_description">{{ $lecture_this->homework }}</p>
                            <p class="homework_description info">Wyślij swoją pracę domową na ten mail, a na pewno
                                odpowiemy.
                            </p>

                            <button class="homework_button send_homework button_copy"
                                data-textCopy="hair@qi.com"><span>hair@qi.com</span> <i
                                    class="fas fa-copy icon"></i></button>
                        </div>
                    @endif
                </div>
            </div>

            <div class="finished_lesson_block unfinished mobile">
                <h3 class="title">Obejrzałem wideo <span class="range"><span
                            class="current">{{ count($lectures_completed) }}</span> /
                        {{ count($lectures) }}</span></h3>
                <p class="nofinished_info">Ukończ wszystkie wykłady i otrzymaj certyfikat</p>
                @if ($course_user['date_of_completed'])
                    <button class="button finish_lesson"><span>Oglądane</span> <i
                            class="far fa-check-circle icon"></i></button>
                    <a download href="{{ route('courses.sertificate', [$course_id, $user_id]) }}" class="button get_sertificate">Uzyskać certyfikat</a>
                    <button class="send_review"><span>Wystawić opinię</span> <i
                            class="fas fa-hand-point-up icon"></i></button>
                @endif
            </div>
        </div>
    @endif
@endsection
