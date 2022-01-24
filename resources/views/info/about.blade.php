@extends('layouts.app')

@section('header.css')
    <link href="{{ asset('css/about.css') }}?v={{ env('APP_VERSION') }}" rel="stylesheet" type="text/css">
@endsection

@section('modals')
    @include('layouts.modals.team_view')
@endsection

@section('content')
    <div class="content about_content">
        <div class="media_head container">
            <img src="{{ $about_data['header_img'][0] }}" alt="KOSTIANTYN HERBIN, co-founder, educator, hairstylist">
            <img src="{{ $about_data['header_img'][1] }}" alt="HERMAN AHAFONTSEV, co-founder, educator, hairstylist">
            <img src="{{ $about_data['header_img'][2] }}" alt="ANNA LEVYTSKA, co-founder, educator, hairstylist ">
            <h1>O Nas</h1>
        </div>

        <div class="media_content container">
            <div class="column left">
                <p>{!! $about_data['block_1'] !!}</p>
                <img src="{{ $about_data['img_about'] }}" alt="Our team">
            </div>
            <div class="column right">
                <p>{!! $about_data['block_2'][0] !!}</p>
                <p>{!! $about_data['block_2'][1] !!}</p>
            </div>
        </div>

        <div class="media_footer container">
            <div class="logo">Qi</div>
            <p>{!! $about_data['block_3'] !!}</p>
            @foreach ($about_data['certificates'] as $cert)
                <img class="cert_img view_full_img" src="{{ $cert }}" data-fullImg="{{ $cert }}"
                    alt="Our certificate">
            @endforeach
        </div>

        <div class="slider_partners_line">
            <ul>
                @for ($i = 0; $i < 2; $i++)
                    @foreach ($about_data['partners'] as $partner)
                        @if ($partner['link'])
                            <li><a href="{{ $partner['link'] }}">{{ $partner['title'] }}</a></li>
                        @else
                            <li>{{ $partner['title'] }}</li>
                        @endif
                    @endforeach
                @endfor
                <div class="clear"></div>
            </ul>
        </div>
    </div>
@endsection
