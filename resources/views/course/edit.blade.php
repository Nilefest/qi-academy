@extends('layouts.app_admin')

@section('header.css')
    <link rel="stylesheet" href="{{ asset('css/adm_course.css') }}?v={{ env('APP_VERSION') }}">
    <link rel="stylesheet" href="{{ asset('css/adm_faq.css') }}?v={{ env('APP_VERSION') }}">
@endsection

@section('footer.js')
    <script src="{{ asset('js/adm_course.js') }}?v={{ env('APP_VERSION') }}"></script>
    <script src="{{ asset('js/adm_faq.js') }}?v={{ env('APP_VERSION') }}"></script>
@endsection

@section('modals')
    <div class="modal_win modal_lecture" data-lectureId="" data-lectureIndexNodes="">
        <i class="fas fa-times close icon_close"></i>
        <div class="lecture_data">
            <label class="field_block">
                <span class="title">Вставьте код для интеграции видео лекции</span>
                <input type="text"
                    placeholder='<div style="padding:56.25% 0 0 0;position:relative;"><iframe src="https://player.vimeo.com/video/...'
                    class="text video">
            </label>
            <div class="field_block lecture_file_block">
                <input id="bonus_file" type="file" class="file d-none">
                <label for="bonus_file">
                    <span class="title">Загрузить файл PDF для дополнительного обучения</span>
                    <i class="fas fa-plus icon_file"></i>
                </label>
                <a href="#file" download class="far fa-file-pdf icon_file"><span>Скачать</span></a>
            </div>
            <label class="field_block">
                <span class="title">Полное описание лекции</span>
                <textarea class="text info_full"></textarea>
            </label>
        </div>
        <label class="homework_block">
            <span class="title">Домашнее задание</span>
            <textarea class="text homework"
                placeholder="Brazilian Technique - metoda rozjaśnienia przez tapirowanie wlosów. Będziemy pokazywać jak pracować z tapirem w koloryzacjach włosów. Pokażemy nie tylko jak prawidłowo tapirować włosy, a tak że jak rozczesywać tapir, żeby dla klienta to nie było przykrym doświadczeniem"></textarea>
        </label>
        <div class="buttons">
            <input type="button" class="button close lecture_save" value="Сохранить  данные">
        </div>
    </div>
@endsection

@section('templates')
    <template id="tpl_faq_item">
        <li class="faq_item">
            <i class="fas fa-trash-alt icon_remove"></i>
            <i class="fas fa-chevron-down icon_down"></i>
            <input type="text" class="text faq_title">
            <textarea class="text faq_info"></textarea>
        </li>
    </template>

    <template id="tpl_exp_item">
        <li class="exp_item">
            <i class="far fa-check-circle icon_tool"></i>
            <i class="fas fa-trash-alt icon_tool icon_remove"></i>
            <input type="text" class="text course_exp_info">
        </li>
    </template>

    <template id="tpl_lecture_item">
        <li class="lecture_item" data-lectureId="" data-lectureInfoFull="" data-lectureVideo="" data-lectureFile="" data-lectureHomework="">
            <div class="tools">
                <span class="title"><span class="num">1</span> lekcje</span>
                <i class="fas fa-trash-alt icon_tool icon_remove"></i>
            </div>
            <div class="fields">
                <input type="text" class="text lecture_name" placeholder="Название" value="">
                <textarea class="text lecture_info_short" placeholder="Короткое описание"></textarea>
                <button class="button edit_lecture">Редактировать курс <i
                        class="far fa-chevron-double-right icon_right"></i></button>
            </div>
            <i class="fas fa-chevron-down icon_down"></i>
            <input type="file" class="d-none lecture_file">
        </li>
    </template>
@endsection

@section('content')

    <div class="content container">
        <a href="{{ route('admin.courses') }}" class="button back back_link">back</a>
        <h1 class="title">Страница о курсе</h1>

        <div class="course_form" data-formAction="{{ route('admin.course.edit.post', $course->id) }}"
            data-courseId="{{ $course->id }}">
            <div class="block_access">
                <div class="title">Доступ к курсу</div>
                <div class="field_check">
                    <input @if ($course->only_paid) checked @endif id="is_paid" class="is_paid d-none course_only_paid" type="radio" name="course_paid_type">
                    <label for="is_paid">Платно</label>
                </div>
                <div class="field_check">
                    <input @if ($course->free_for_client) checked @endif id="access_premium" class="access_premium course_free_for_client d-none"
                        type="radio" name="course_paid_type">
                    <label for="access_premium">Бесплатно. Доступно для клентов, которые уже купили какой-то курс.
                    </label>
                </div>
                <div class="field_check">
                    <input @if ($course->free) checked @endif id="is_free" class="is_free d-none course_free" type="radio" name="course_paid_type">
                    <label for="is_free">Беслатно</label>
                </div>
                <div class="field_check">
                    <input @if ($course->main_course) checked @endif id="is_main_course" class="is_free d-none course_main_course"
                        type="checkbox">
                    <label for="is_main_course">Специальный кур на главной странице</label>
                </div>
            </div>

            <label class="block_banner">
                <div class="title">
                    <p>Загрузите главный банер курса. Обязательный размер: 1320 x 590 px. </p>
                    <p> Чтобы на всех устройствах банер отображался корректно, главную компаозицию поместите в центр,
                        согласно направляющим линиям.</p>
                </div>
                <div class="banner_image" style='background-image: url("{{ $course->banner_img }}");'>
                    <i class="fas fa-plus icon_add"></i>
                    <input type="file" class="d-none course_banner_img" accept="image/png, image/gif, image/jpeg">
                </div>
            </label>

            <div class="info_block">
                <div class="main_info">
                    <label class="course_name">
                        <span class="title">Название курса</span>
                        <textarea class="text course_name_input"
                            placeholder="Course`s name">{{ $course->name }}</textarea>
                    </label>
                    <label>
                        <input min="1" type="number" class="text course_total_hours" value="{{ $course->total_hours }}">
                        <span class="title">godziny</span>
                    </label>
                    <label class="course_cost">
                        <input min="0" type="number" class="text course_cost_text" value="{{ $course->cost }}">
                        <span class="title">Zł</span>
                    </label>
                    <label>
                        <span class="title">Czas do końca dostępu do kursu:</span>
                        <input min="1" type="number" class="text course_total_days" value="{{ $course->total_days }}">
                    </label>
                </div>
                <label class="video_link">
                    <span class="title">Вставьте код для интеграции видео-превью </span>
                    <textarea class="text course_video_preview"
                        placeholder='<div style="padding:56.25% 0 0 0;position:relative;"><iframe src="https://player.vimeo.com/video/...'>{{ $course->video_preview }}</textarea>
                </label>
            </div>

            <div class="info_block">
                <label class="public_description">
                    <span class="title">Описание курса</span>
                    <div class="description_text">
                        <textarea class="text course_description">{{ $course->description }}</textarea>
                    </div>
                </label>
                <div class="description_for">
                    <div class="title">Dla kogo?</div>
                    <textarea class="text course_description_for_1">{{ $course->description_for_1 }}</textarea>
                    <textarea class="text course_description_for_2">{{ $course->description_for_2 }}</textarea>
                </div>
            </div>

            <div class="experience_block">
                <div class="title">Чему научаться на курсе <button class="button exp_add">Добавить <i
                            class="fas fa-plus icon_add"></i></button></div>
                <ul class="exp_list">
                    @foreach ($course_exp_list as $course_exp_item)
                        <li class="exp_item">
                            <i class="far fa-check-circle icon_tool"></i>
                            <i class="fas fa-trash-alt icon_tool icon_remove"></i>
                            <input type="text" class="text course_exp_info" value="{{ $course_exp_item['info'] }}">
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="instructor_block">
                <label for="select_instructor" class="title">Выберите инструктора из списка</label>
                <select id="select_instructor" class="text course_team_id">
                    @foreach ($team_list as $team_one)
                        <option @if ($course->team_id === $team_one->id) selected @endif value="{{ $team_one->id }}">{{ $team_one->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="lectures_gallery_block">
                <div class="lectures_block">
                    <h3 class="title">Program</h3>
                    <ul class="lectures_list">
                        @foreach ($lecture_list as $key => $lecture_item)
                            <li class="lecture_item" data-lectureId="{{ $lecture_item['id'] }}" data-lectureInfoFull="{{ $lecture_item['info_full'] }}"
                                data-lectureVideo="{{ $lecture_item['video'] }}"
                                data-lectureFile="{{ $lecture_item['file'] }}"
                                data-lectureHomework="{{ $lecture_item['homework'] }}">
                                <div class="tools">
                                    <span class="title"><span class="num">{{ $key + 1 }}</span>
                                        lekcje</span>
                                    <i class="fas fa-trash-alt icon_tool icon_remove"></i>
                                </div>
                                <div class="fields">
                                    <input type="text" class="text lecture_name" placeholder="Название"
                                        value="{{ $lecture_item['name'] }}">
                                    <textarea class="text lecture_info_short"
                                        placeholder="Короткое описание">{{ $lecture_item['info_short'] }}</textarea>
                                    <button class="button edit_lecture">Редактировать курс <i
                                            class="far fa-chevron-double-right icon_right"></i></button>
                                </div>
                                <i class="fas fa-chevron-down icon_down"></i>
                                <input type="file" class="d-none lecture_file">
                            </li>
                        @endforeach
                    </ul>
                    <button class="button add_lecture">Добавить <i class="fas fa-plus icon_add"></i></button>
                </div>
                <div class="gallery_block">
                    <span class="title">Загрузите фото</span>
                    <div class="photos">
                        <label class="col" style='background-image: url("{{ $course->gallery_img_1 }}");'>
                            <span class="size">260 x 540 px</span>
                            <i class="fas fa-plus icon_add"></i>
                            <input type="file" class="d-none course_gallery_img_1"
                                accept="image/png, image/gif, image/jpeg">
                        </label>
                        <div class="col">
                            <label style='background-image: url("{{ $course->gallery_img_2 }}");'>
                                <span class="size">260 x 260 px</span>
                                <i class="fas fa-plus icon_add"></i>
                                <input type="file" class="d-none course_gallery_img_2"
                                    accept="image/png, image/gif, image/jpeg">
                            </label>
                            <label style='background-image: url("{{ $course->gallery_img_3 }}");'>
                                <span class="size">260 x 260 px</span>
                                <i class="fas fa-plus icon_add"></i>
                                <input type="file" class="d-none course_gallery_img_3"
                                    accept="image/png, image/gif, image/jpeg">
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="faq_block">
                <div class="title">Часто задваемые вопросы</div>
                <ul class="faq_list">
                    @foreach ($faq_list as $faq_item)
                        <li class="faq_item">
                            <i class="fas fa-trash-alt icon_remove"></i>
                            <i class="fas fa-chevron-down icon_down"></i>
                            <input type="text" class="text faq_title" value="{{ $faq_item['title'] }}">
                            <textarea class="text faq_info">{{ $faq_item['info'] }}</textarea>
                        </li>
                    @endforeach
                </ul>
                <button class="button faq_add">Добавить <i class="fas fa-plus icon_add"></i></button>
            </div>

            <div class="buttons_block">
                <input type="button" class="button course_save" value="Сохранить  данные">
                @if ($course->id !== null)
                    <input type="button" class="button course_archive" value="Отправить в архив">
                    <input type="button" class="button course_delete" value="Удалить курс">
                @endif
            </div>
        </div>
    </div>
@endsection
