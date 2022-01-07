@extends('layouts.app_admin')

@section('header.css')
    <link rel="stylesheet" href="{{ asset('css/team.css') }}?v={{ env('APP_VERSION') }}">
@endsection

@section('footer.js')
    <script src="{{ asset('js/team.js') }}?v={{ env('APP_VERSION') }}"></script>
    <script src="{{ asset('js/adm_team.js') }}?v={{ env('APP_VERSION') }}"></script>
@endsection

@section('modals')
    <div class="modal_win container modal_team_adm" data-teamId="0" data-formAction="{{ route('admin.team') }}">
        <div class="modal_header">
            <label class="team_img" style="background-image: url();">
                <i class="fas fa-plus icon_add"></i>
                <input type="file" class="d-none team_img_file" name="team_img_file" accept="image/png, image/gif, image/jpeg">
            </label>
            <div class="team_info">
                <div class="name">
                    <input type="text" class="text team_name" name="name" placeholder="имя">
                </div>
            </div>
        </div>
        <div class="modal_content">
            <textarea class="textarea team_info" name="info"
                autocomplete="no">Brazilian Technique - metoda rozjaśnienia przez tapirowanie wlosów. Będziemy pokazywać jak pracować z tapirem w koloryzacjach włosów. Pokażemy nie tylko jak prawidłowo tapirować włosy, a tak że jak rozczesywać tapir, żeby dla klienta to nie było "przykrym doświadczeniem".</textarea>
            <label class="social_field">
                <span class="title">Instagram</span>
                <input type="text" class="text soc_instagram" name="instagram" placeholder="ссылка на профиль">
            </label>
            <label class="social_field">
                <span class="title">Facebook</span>
                <input type="text" class="text soc_facebook" name="facebook" placeholder="ссылка на профиль">
            </label>
        </div>
        <div class="modal_footer">
            <button class="modal_button close save">Сохранить</button>
            <button class="modal_button close delete">Удалить</button>
            <button class="modal_button close">Отмена</button>
        </div>
    </div>
@endsection

@section('templates')
    <template id="tpl_team_one">
        <li class="team_list_li team_one" data-teamId="" data-teamInfo="">
            <div class="team_list_media team_img" style="background-image: url();">
                <span class="team_adm_modal view">Редактировать</span>
            </div>
            <span class="name">***</span>
            <ul class="social">
                <li class="d-none"><a target="_blank" class="soc_facebook" href="#facebook"><i class="fa fa-facebook-official"
                            aria-hidden="true"></i></a>
                </li>
                <li class="d-none"><a target="_blank" class="soc_instagram" href="#instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
            </ul>
        </li>
    </template>
@endsection

@section('content')

    <div class="content container team_content">
        <a href="{{ route('admin.dashboard') }}" class="button back">back</a>
        <ul class="team_list_ul team_list">
            <li class="team_list_li team_add"><i class="fas fa-plus icon_add"></i></li>
            @foreach ($team_list as $team_one)
                <li class="team_list_li team_one" data-teamId="{{ $team_one->id }}"
                    data-teamInfo="{{ $team_one->info }}">
                    <div class="team_list_media team_img" style="background-image: url(/{{ $team_one->img }});">
                        <span class="team_adm_modal view">Редактировать</span>
                    </div>
                    <span class="name">{{ $team_one->name }}</span>
                    <ul class="social">
                        <li class="@if (!$team_one->facebook) d-none @endif"><a target="_blank" class="soc_facebook"
                                href="{{ $team_one->facebook }}"><i class="fab fa-facebook-square"></i></a></li>
                        <li class="@if (!$team_one->instagram) d-none @endif"><a target="_blank" class="soc_instagram"
                                href="{{ $team_one->instagram }}"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                        </li>
                    </ul>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
