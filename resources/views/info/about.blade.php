@extends('layouts.app')

@section('header.css')
    <link href="{{ asset('css/about.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('modals')
    @include('layouts.modals.team_view')
@endsection

@section('content')
    <div class="content about_content">
        <div class="media_head container">
            <img src="/temp/img/team/team_2.png" alt="">
            <img src="/temp/img/team/team_3.png" alt="">
            <img src="/temp/img/team/team_1.png" alt="">
            <h1>ONas</h1>
        </div>

        <div class="media_content container">
            <div class="column left">
                <p>Brazilian Technique - metoda rozjaśnienia przez tapirowanie wlosów. Będziemy pokazywać jak pracować z
                    tapirem w koloryzacjach włosów. Pokażemy nie tylko jak prawidłowo tapirować włosy, a tak że jak
                    rozczesywać tapir, żeby dla klienta to nie było "przykrym doświadczeniem". </p>
                <p>Brazilian Technique - metoda rozjaśnienia przez tapirowanie wlosów. Będziemy pokazywać jak pracować z
                    tapirem w koloryzacjach włosów. Pokażemy nie tylko jak prawidłowo tapirować włosy, a tak że jak
                    rozczesywać tapir, żeby dla klienta to nie było "przykrym doświadczeniem". </p>
                <img src="/temp/img/about.png" alt=" ">
            </div>
            <div class="column right">
                <p>Brazilian Technique - metoda rozjaśnienia przez tapirowanie wlosów. Będziemy pokazywać jak pracować z
                    tapirem w koloryzacjach włosów. Pokażemy nie tylko jak prawidłowo tapirować włosy, a tak że jak
                    rozczesywać tapir, żeby dla klienta to nie było "przykrym doświadczeniem". </p>
                <p>Brazilian Technique - metoda rozjaśnienia przez tapirowanie wlosów. Będziemy pokazywać jak pracować z
                    tapirem w koloryzacjach włosów. Pokażemy nie tylko jak prawidłowo tapirować włosy, a tak że jak
                    rozczesywać tapir, żeby dla klienta to nie było "przykrym doświadczeniem". </p>
            </div>
        </div>

        <div class="media_footer container">
            <div class="logo">Qi</div>
            <p>Brazilian Technique - metoda rozjaśnienia przez tapirowanie wlosów. Będziemy pokazywać jak pracować z tapirem
                w koloryzacjach włosów. Pokażemy nie tylko jak prawidłowo tapirować włosy, a tak że jak rozczesywać tapir,
                żeby dla klienta to nie było "przykrym doświadczeniem". </p>
            <img src="/temp/img/cert.png" alt=" ">
            <img src="/temp/img/cert.png" alt=" ">
        </div>

        <div class="slider_partners_line">
            <ul>
                <li>Nasi partnerzy</li>
                <li>Nasi partnerzy</li>
                <li>Nasi partnerzy</li>
                <li>Nasi partnerzy</li>
                <li>Nasi partnerzy</li>
                <li>Nasi partnerzy</li>
                <li>Nasi partnerzy</li>
                <li>Nasi partnerzy</li>
                <li>Nasi partnerzy</li>
                <li>Nasi partnerzy</li>
                <li>Nasi partnerzy</li>
                <li>Nasi partnerzy</li>
                <li>Nasi partnerzy</li>
                <li>Nasi partnerzy</li>
                <div class="clear"></div>
            </ul>
        </div>
    </div>
@endsection
