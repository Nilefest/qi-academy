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
@endsection

@section('content')
    <div class="content container course_container">
        @if (!empty($courses_account))
            <div class="course_list">
                <h3>Moje kursy</h3>
                <ul class="course_list_ul">
                    @foreach ($courses_account as $key => $course)
                        <?php unset($courses_bonuse[$key]); ?>
                        <?php unset($courses_paid[$key]); ?>
                        <li class="course_list_li @if (isset($courses_completed[$course['id']])) check @endif">
                            <a target="_blank" href="{{ route('courses.lecture', $course['id']) }}">
                                <div style="background-image: url({{ $course['banner_img'] }});"
                                    class="image">
                                </div>
                                <span class="name">{{ $course['name'] }}</span>
                                <span class="time_info">Zostało <b>{{ $course['pivot']['days_last'] }} {{ $course['pivot']['days_last_title'] }}</b> dostępu do kursu</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
                <button class="course_list_arrow prev">&#8592;</button>
                <button class="course_list_arrow next">&#8594;</button>
            </div>
        @endif

        @if (!empty($courses_bonuse) && !empty($courses_account))
            <div class="course_list">
                <h3>Moje premie</h3>
                <ul class="course_list_ul">
                    @foreach ($courses_bonuse as $course)
                        @if (!isset($courses_account[$course['id']]))
                            <li class="course_list_li @if (isset($courses_completed[$course['id']])) check @endif">
                                <a target="_blank" href="{{ route('course.view', $course['id']) }}">
                                    <div style="background-image: url({{ $course['banner_img'] }});"
                                        class="image">
                                    </div>
                                    <span class="name">{{ $course['name'] }}</span>
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
                <button class="course_list_arrow prev">&#8592;</button>
                <button class="course_list_arrow next">&#8594;</button>
            </div>
        @endif

        @if (!empty($courses_paid))
            <div class="course_list">
                <h3>Wszystkie kursy</h3>
                <ul class="course_list_ul">
                    @foreach ($courses_paid as $course)
                        @if (!isset($courses_account[$course['id']]))
                            <li class="course_list_li @if (isset($courses_completed[$course['id']])) check @endif">
                                <a target="_blank" href="{{ route('course.view', $course['id']) }}">
                                    <div style="background-image: url({{ $course['banner_img'] }});"
                                        class="image">
                                    </div>
                                    <span class="name">{{ $course['name'] }}</span>
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
                <button class="course_list_arrow prev">&#8592;</button>
                <button class="course_list_arrow next">&#8594;</button>
            </div>
        @endif
    </div>
@endsection
