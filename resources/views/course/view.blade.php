@extends('layouts.app')

@section('header.css')
    <link rel="stylesheet" href="{{ asset('css/course.css') }}?v={{ env('APP_VERSION') }}">
@endsection

@section('footer.js')
    <!-- JS. JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

    <!-- JS. Slick -->
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/slick/slick.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/slick/slick-theme.css') }}" />
    <script src="{{ asset('lib/slick/slick.min.js') }}"></script>
    <script src="{{ asset('lib/slick-init.js') }}?v={{ env('APP_VERSION') }}"></script>

    <script src="{{ asset('js/course.js') }}?v={{ env('APP_VERSION') }}"></script>
@endsection

@section('content')
    <div class="content cource_content course_one" data-courseId="{{ $course->id }}">
        <div class="media_head container">
            <div class="head_info">
                <h1>{{ $course->name }}</h1>
                <ul class="curs_info">
                    <li>{{ count($lecture_list) }} Lekcje</li>
                    <li>{{ $course->total_hours }} godziny</li>
                </ul>
                <div class="head_register">
                    <span class="cost">{{ $course->cost }} Zł</span>
                    <div class="head_buttons">
                        <a href="{{ route('courses.lecture', $course->id) }}" class="head_button curs_register">Zapisać się na kurs</a>
                    </div>
                </div>
            </div>
            <div class="media_block">
                {!! $course->video_preview !!}
            </div>
        </div>

        <div class="media_note">QI academy</div>

        @if ($course->description || $course->description_for_1 || $course->description_for_2)
            <div class="course_description container">
                @if ($course->description)
                    <div class="course_description_text">
                        <p>{!! $course['description'] !!}</p>
                    </div>
                @endif

                @if ($course->description_for_1 || $course->description_for_2)
                    <div class="course_description_for">
                        <h3>Dla <br>kogo?</h3>
                        <ul class="course_for_ul">
                            @if ($course->description_for_1)
                                <li>{!! $course['description_for_1'] !!}</li>
                            @endif
                            @if ($course->description_for_2)
                                <li>{!!  $course['description_for_2'] !!}</li>
                            @endif
                        </ul>
                    </div>
                @endif
            </div>
        @endif

        @if ($course_exp_list->count())
            <div class="course_experience container">
                <h3>Nauczymy się na kursie:</h3>
                <ul class="course_experience_ul">
                    @foreach ($course_exp_list as $exp)
                        <li class="course_experience_li">{{ $exp->info }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if ($team_one !== null)
            <div class="course_instructor container">
                <div class="instructor_media">
                    <span class="name">{{ $team_one->name }}</span>
                    <img class="photo" src="{{ asset($team_one->img) }}" alt="{{ $team_one->name }}">
                </div>
                <div class="instructor_info">
                    <h3>Instruktor</h3>
                    <ul class="social_ul">
                        @if ($team_one->facebook) <li><a href="{{ $team_one->facebook }}">facebook</a></li> @endif
                        @if ($team_one->instagram) <li><a href="{{ $team_one->instagram }}">instagram</a></li> @endif
                    </ul>
                    <div class="instructor_text">
                        <p>{!! $team_one->info !!}</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="course_program container">
            <div class="program_list">
                <h3>Program</h3>
                <ul class="program_list_ul">
                    @foreach ($lecture_list as $key => $lecture_one)
                        <li class="program_list_li">
                            <span class="lessons">{{ $key + 1 }} lekcje</span>
                            <span class="title">{{ $lecture_one->name }}</span>
                            <span class="info">{!! $lecture_one['info_short'] !!}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="program_images">
                <div class="colums left">
                    <div style="background-image: url({{ $course->gallery_img_1 }});" class="program_img"></div>
                </div>
                <div class="colums right">
                    <div style="background-image: url({{ $course->gallery_img_2 }});" class="program_img"></div>
                    <div style="background-image: url({{ $course->gallery_img_3 }});" class="program_img"></div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.blocks.video_reviews')

    @include('layouts.blocks.faq')

@endsection
