@extends('layouts.' . (Auth::user()->checkRole('admin') ? 'app_admin' : 'app'))

@section('header.css')
    <link href="{{ asset('css/profile.css') }}?v={{ env('APP_VERSION') }}" rel="stylesheet" type="text/css">
    @if (Auth::user()->checkRole('admin'))
        <style>
            body {
                overflow-x: hidden !important;
            }

        </style>
    @endif
@endsection

@section('footer.js')
    <script src="{{ asset('js/profile.js') }}?v={{ env('APP_VERSION') }}"></script>
@endsection

@section('templates')
    <template id='tpl_user_course_one'>
        <tr class="user_course_one" data-courseId="-1" data-userCourseId="-1">
            <td class="tool"><i class="fas fa-trash-alt icon user_course_delete"></i></td>
            <td><a target="_blank" href="#" class="cell_text name">--</a></td>
            <td><span class="cell_text date_of_begin">--</span></td>
            <td><span class="cell_text last_days" title="--"><span class="value">0</span> дня(-ей)</span></td>
        </tr>
    </template>
@endsection

@section('content')
    <div class="content container">
        @if (Auth::user()->checkRole('admin'))
            <a href="{{ route('admin.clients') }}" class="button back">back</a>
        @endif

        <div class="profile_head">
            <label class="avatar">
                <span class="title">My profile: </span>
                <div class="avatar_photo"
                    style="background-image: url('{{ $user->avatar ? $user->avatar : asset('uploads/profile/default/' . rand(1, 18) . '.jpg') }}');">
                </div>
                <input type="file" class="profile_avatar d-none" accept="image/png, image/gif, image/jpeg">
            </label>

            <button class="profile_button profile_save desktop">Zapisz zmiany</button>
            @if (Auth::user()->checkRole('admin') && Auth::user()->id !== $user->id)
                <button class="profile_button white profile_delete desktop white"><i class="fas fa-trash-alt icon"></i>
                    Удалить пользователя</button>
            @endif
        </div>
        <div class="form" data-formAction="{{ route('account.profile.post', $user_id) }}">
            <label class="profile_label">
                <span class="title">Imię</span>
                <input autocomplete="off" type="text" class="profile_input profile_name" placeholder=""
                    value="{{ $user->name }}">
            </label>
            <label class="profile_label">
                <span class="title">Nazwisko</span>
                <input autocomplete="off" type="text" class="profile_input profile_lastname" placeholder=""
                    value="{{ $user->lastname }}">
            </label>
            <label class="profile_label">
                <span class="title">Numer telefonu</span>
                <input autocomplete="off" type="tel" class="profile_input profile_phone" placeholder="Phone number"
                    value="{{ $user->phone }}">
            </label>
            <label for="profile_email" class="profile_label @if (!$user->hasVerifiedEmail()) invalid @endif">
                <span class="title">
                    e-mail
                    @if ($user->hasVerifiedEmail())
                    <i class="fas fa-lock icon_lock"></i>@else
                        <button data-action="{{ route('verification.resend') }}" class="link send_for_configm">Send for
                            confirm</button>
                    @endif
                </span>
                <input id="profile_email" @if ($user->hasVerifiedEmail()) disabled @endif autocomplete="off" type="email"
                    class="profile_input profile_email" placeholder="Your Email" value="{{ $user->email }}">
            </label>
            <button class="profile_button profile_save mobile">Zapisz zmiany</button>
        </div>

        @if (Auth::user()->checkRole('admin') && !$user->checkRole('admin'))
            <div class="profile_courses">
                <table class="profile_courses_table">
                    <thead>
                        <th class="tool"></th>
                        <th>купленные курсы</th>
                        <th>дата продажи</th>
                        <th>окончание через</th>
                    </thead>
                    <tbody>
                        @foreach ($profile_courses as $course)
                            <tr class="user_course_one" data-courseId="{{ $course['id'] }}"
                                data-userCourseId="{{ $course['pivot']['id'] }}">
                                <td class="tool"><i class="fas fa-trash-alt icon user_course_delete"></i></td>
                                <td><a target="_blank" href="{{ route('course.view', $course['id']) }}"
                                        class="cell_text name">{{ $course['name'] }}</a></td>
                                <td><span class="cell_text date_of_begin">{{ $course['pivot']['date_of_begin'] }}</span>
                                </td>
                                <td><span class="cell_text last_days" title="{{ $course['pivot']['date_of_end'] }}"><span
                                            class="value">{{ $course['pivot']['days_last'] }}</span>
                                        дня(-ей)</span></td>
                            </tr>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="profile_courses_add_form">
                    <label class="title" for="courses_select">Подарить курс</label>
                    <div class="add_form">
                        <select id="courses_select" class="text">
                            <option selected value="-1">-- Выберите курс --</option>
                            @foreach ($courses as $course)
                                <option value="{{ $course['id'] }}">{{ $course['name'] }}</option>
                            @endforeach
                        </select>
                        <input type="submit" class="button" id="profile_course_add" value="Потвердить">
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
