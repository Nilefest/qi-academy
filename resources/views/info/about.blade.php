@extends('layouts.app')

@section('header.css')
<<<<<<< HEAD
    <link href="{{ asset('css/about.css') }}" rel="stylesheet" type="text/css">
=======
    <link href="{{ asset('css/about.css') }}?v={{ env('APP_VERSION') }}" rel="stylesheet" type="text/css">
>>>>>>> dev
@endsection

@section('modals')
    @include('layouts.modals.team_view')
@endsection

@section('content')
    <div class="content about_content">
        <div class="media_head container">
<<<<<<< HEAD
            <img src="/temp/img/team/team_2.png" alt="">
            <img src="/temp/img/team/team_3.png" alt="">
            <img src="/temp/img/team/team_1.png" alt="">
=======
            <img src="{{ $about_data['header_img'][0] }}" alt="KOSTIANTYN HERBIN, co-founder, educator, hairstylist">
            <img src="{{ $about_data['header_img'][1] }}" alt="HERMAN AHAFONTSEV, co-founder, educator, hairstylist">
            <img src="{{ $about_data['header_img'][2] }}" alt="ANNA LEVYTSKA, co-founder, educator, hairstylist ">
>>>>>>> dev
            <h1>ONas</h1>
        </div>

        <div class="media_content container">
            <div class="column left">
<<<<<<< HEAD
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
=======
                <p>{!! $about_data['block_1'] !!}</p>
                <img src="{{ $about_data['img_about'] }}" alt="Our team">
            </div>
            <div class="column right">
                <p>{!! $about_data['block_2'][0] !!}</p>
                <p>{!! $about_data['block_2'][1] !!}</p>
>>>>>>> dev
            </div>
        </div>

        <div class="media_footer container">
            <div class="logo">Qi</div>
<<<<<<< HEAD
            <p>Brazilian Technique - metoda rozjaśnienia przez tapirowanie wlosów. Będziemy pokazywać jak pracować z tapirem
                w koloryzacjach włosów. Pokażemy nie tylko jak prawidłowo tapirować włosy, a tak że jak rozczesywać tapir,
                żeby dla klienta to nie było "przykrym doświadczeniem". </p>
            <img src="/temp/img/cert.png" alt=" ">
            <img src="/temp/img/cert.png" alt=" ">
=======
            <p>{!! $about_data['block_3'] !!}</p>
            @foreach ($about_data['certificates'] as $cert)
                <img class="cert_img view_full_img" src="{{ $cert }}" data-fullImg="{{ $cert }}" alt="Our certificate">
            @endforeach
>>>>>>> dev
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
