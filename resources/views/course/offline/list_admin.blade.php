@extends('layouts.app_admin')

@section('footer.js')
    <script src="{{ asset('js/adm_courses_offline.js') }}?v={{ env('APP_VERSION') }}"></script>
@endsection

@section('templates')
    <template id="tpl_course_item">
        <tr class="course_item info" data-courseId="-1">
            <td rowspan="2" class="tools"><i class="fas fa-trash-alt icon_tool remove_course"></i></td>
            <td><input type="text" class="text course_place" placeholder="Warszawa"></td>
            <td><input type="date" class="text course_date_of" placeholder=""></td>
            <td class="days"><input min="1" type="text" class="text course_period" placeholder="1 dzień" value="">
            </td>
            <td class="name"><input type="title" class="text course_name" placeholder="Lekcja: ..."></td>
        </tr>
        <tr class="course_item link" data-courseId="-1">
            <td><label for="link_video_0">Ссылка на видео-презентацию <i class="fa fa-question-circle-o icon_info"
                        title="Заполнить поле, если у курса есть вступительное видео-презентацию"></i></label></td>
            <td colspan="3"><input id="link_video_0" type="text" class="text link_video course_video"
                    placeholder="https://..."></td>
        </tr>
    </template>
@endsection

@section('content')
    <div class="content container">
        <a href="{{ route('admin.dashboard') }}" class="button back">back</a>
        <h1 class="title">Редактор офлайн курса</h1>
        <div class="courses_offline" data-formAction="{{ route('admin.courses_offline.post') }}">
            <table>
                <thead>
                    <tr>
                        <th colspan="2">Город</th>
                        <th>Дата</th>
                        <th class="days">К-во дней</th>
                        <th class="name">Название лекций</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($courses_offline_list as $course_one)
                        <tr class="course_item info" data-courseId="{{ $course_one->id }}">
                            <td class="tools"><i class="fas fa-trash-alt icon_tool remove_course"></i></td>
                            <td><input type="text" class="text course_place" placeholder="Warszawa"
                                    value="{{ $course_one->place }}"></td>
                            <td><input type="text" class="text course_date_of" placeholder=""
                                    value="{{ $course_one->date_of }}"></td>
                            <td class="days"><input min="1" type="text" class="text course_period"
                                    placeholder="1 dzień" value="{{ $course_one->period }}"></td>
                            <td class="name"><input type="title" class="text course_name"
                                    value="{{ $course_one->name }}" placeholder="Lekcja: ...">
                            </td>
                        </tr>
                        <tr class="course_item link" data-courseId={{ $course_one->id }}>
                            <td class="tools"></td>
                            <td><label for="link_video_{{ $course_one->id }}">Ссылка на видео-презентацию <i
                                        class="fas fa-question-circle-o icon_info"
                                        title="Заполнить поле, если у курса есть вступительное видео-презентацию"></i></label>
                            </td>
                            <td colspan="3"><input id="link_video_{{ $course_one->id }}" type="text"
                                    class="text link_video course_video" placeholder="https://..."
                                    value="{{ $course_one->video }}"></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <button class="button add_course"><i class="fas fa-plus icon_add"></i></button>
            <button class="button save_courses">Сохранить данные</button>
        </div>
    </div>
@endsection
