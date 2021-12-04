@extends('layouts.app')

@section('header.css')
    <link href="{{ asset('css/team.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('footer.js')
    <script src="{{ asset('js/team.js') }}"></script>
@endsection

@section('modals')
    <!-- Modal. About teammate -->
<div class="modal_win container modal_team">
    <div class="modal_header">
        <img class="img" src="/temp/img/team/team_1.png" alt=" ">
        <div class="team_info">
            <div class="name">Herman Ahafontsev</div>
            <ul class="social">
                <li><a class="facebook_link" href="#facebook"><i class="fa fa-facebook-official"
                            aria-hidden="true"></i></a></li>
                <li><a class="instagram_link" href="#instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                </li>
            </ul>
        </div>
    </div>
    <div class="modal_content">
        <div class="info">
            <p>Brazilian Technique - metoda rozjaśnienia przez tapirowanie wlosów. Będziemy pokazywać jak
                pracować z
                tapirem w koloryzacjach włosów. Pokażemy nie tylko jak prawidłowo tapirować włosy, a tak że jak
                rozczesywać tapir, żeby dla klienta to nie było "przykrym doświadczeniem". </p>
            <p>Brazilian Technique - metoda rozjaśnienia przez tapirowanie wlosów. Będziemy pokazywać jak
                pracować z
                tapirem w koloryzacjach włosów. Pokażemy nie tylko jak prawidłowo tapirować włosy, a tak że jak
                rozczesywać tapir, żeby dla klienta to nie było "przykrym doświadczeniem". </p>
            <p>Brazilian Technique - metoda rozjaśnienia przez tapirowanie wlosów. Będziemy pokazywać jak
                pracować z
                tapirem w koloryzacjach włosów. Pokażemy nie tylko jak prawidłowo tapirować włosy, a tak że jak
                rozczesywać tapir, żeby dla klienta to nie było "przykrym doświadczeniem". </p>
        </div>
    </div>
    <div class="modal_footer">
        <button class="modal_button close">Close</button>
    </div>
</div>

@endsection

@section('content')
    <div class="content container team_content">
        <h1>QI team</h1>
        <ul class="team_list_ul">
            @foreach ($team_list as $team_one)
            <li class="team_list_li team_one" data-teamInfo="{{ $team_one->info }}" data-teamImg="{{ $team_one->img }}">
                <div class="team_list_media" style="background-image: url({{ $team_one->img }});">
                    <span class="team_open_modal view">View</span>
                </div>
                <span class="name">{{ $team_one->name }}</span>
                <ul class="social">
                    @if($team_one->facebook)
                    <li><a class="facebook_link" href="{{ $team_one->facebook }}"><i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
                    @endif
                    @if($team_one->instagram)
                    <li><a class="instagram_link" href="{{ $team_one->instagram }}"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                    @endif
                </ul>
            </li>
            @endforeach
            <li class="team_list_li">
                <div class="team_list_media" style="background-image: url(/temp/img/team/team_2.png);">
                    <span class="team_open_modal view">View</span>
                </div>
                <span class="name">Anna Levytska</span>
                <ul class="social">
                    <li><a href="#facebook"><i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
                    <li><a href="#instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                </ul>
            </li>
            <li class="team_list_li">
                <div class="team_list_media" style="background-image: url(/temp/img/team/team_3.png);">
                    <span class="team_open_modal view">View</span>
                </div>
                <span class="name">Konstantin Herbin</span>
                <ul class="social">
                    <li><a href="#facebook"><i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
                    <li><a href="#instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                </ul>
            </li>
            <li class="team_list_li">
                <div class="team_list_media" style="background-image: url(/temp/img/team/team_1.png);">
                    <span class="team_open_modal view">View</span>
                </div>
                <span class="name">Herman Ahafontsev</span>
                <ul class="social">
                    <li><a href="#facebook"><i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
                    <li><a href="#instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                </ul>
            </li>
            <li class="team_list_li">
                <div class="team_list_media" style="background-image: url(/temp/img/team/team_2.png);">
                    <span class="team_open_modal view">View</span>
                </div>
                <span class="name">Anna Levytska</span>
                <ul class="social">
                    <li><a href="#facebook"><i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
                    <li><a href="#instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                </ul>
            </li>
            <li class="team_list_li">
                <div class="team_list_media" style="background-image: url(/temp/img/team/team_3.png);">
                    <span class="team_open_modal view">View</span>
                </div>
                <span class="name">Konstantin Herbin</span>
                <ul class="social">
                    <li><a href="#facebook"><i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
                    <li><a href="#instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                </ul>
            </li>
            <li class="team_list_li">
                <div class="team_list_media" style="background-image: url(/temp/img/team/team_1.png);">
                    <span class="team_open_modal view">View</span>
                </div>
                <span class="name">Herman Ahafontsev</span>
                <ul class="social">
                    <li><a href="#facebook"><i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
                    <li><a href="#instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                </ul>
            </li>
            <li class="team_list_li">
                <div class="team_list_media" style="background-image: url(/temp/img/team/team_2.png);">
                    <span class="team_open_modal view">View</span>
                </div>
                <span class="name">Anna Levytska</span>
                <ul class="social">
                    <li><a href="#facebook"><i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
                    <li><a href="#instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                </ul>
            </li>
            <li class="team_list_li">
                <div class="team_list_media" style="background-image: url(/temp/img/team/team_3.png);">
                    <span class="team_open_modal view">View</span>
                </div>
                <span class="name">Konstantin Herbin</span>
                <ul class="social">
                    <li><a href="#facebook"><i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
                    <li><a href="#instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                </ul>
            </li>
            <li class="team_list_li">
                <div class="team_list_media" style="background-image: url(/temp/img/team/team_1.png);">
                    <span class="team_open_modal view">View</span>
                </div>
                <span class="name">Herman Ahafontsev</span>
                <ul class="social">
                    <li><a href="#facebook"><i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
                    <li><a href="#instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                </ul>
            </li>
            <li class="team_list_li">
                <div class="team_list_media" style="background-image: url(/temp/img/team/team_2.png);">
                    <span class="team_open_modal view">View</span>
                </div>
                <span class="name">Anna Levytska</span>
                <ul class="social">
                    <li><a href="#facebook"><i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
                    <li><a href="#instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                </ul>
            </li>
            <li class="team_list_li">
                <div class="team_list_media" style="background-image: url(/temp/img/team/team_3.png);">
                    <span class="team_open_modal view">View</span>
                </div>
                <span class="name">Konstantin Herbin</span>
                <ul class="social">
                    <li><a href="#facebook"><i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
                    <li><a href="#instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                </ul>
            </li>
        </ul>
    </div>
@endsection
