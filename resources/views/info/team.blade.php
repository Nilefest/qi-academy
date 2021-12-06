@extends('layouts.app')

@section('header.css')
    <link href="{{ asset('css/team.css') }}?v={{ env('APP_VERSION') }}" rel="stylesheet" type="text/css">
@endsection

@section('footer.js')
    <script src="{{ asset('js/team.js') }}?v={{ env('APP_VERSION') }}"></script>
@endsection

@section('modals')
    @include('layouts.modals.team_view')
@endsection

@section('content')
    <div class="content container team_content">
        <h1>QI team</h1>
        <ul class="team_list_ul">
            @foreach ($team_list as $team_one)
                <li class="team_list_li team_one" data-teamInfo="{{ $team_one->info }}"
                    data-teamImg="{{ $team_one->img }}">
                    <div class="team_list_media" style="background-image: url({{ $team_one->img }});">
                        <span class="team_open_modal view">View</span>
                    </div>
                    <span class="name">{{ $team_one->name }}</span>
                    <ul class="social">
                        @if ($team_one->facebook)
                            <li><a class="facebook_link" href="{{ $team_one->facebook }}"><i
                                        class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
                        @endif
                        @if ($team_one->instagram)
                            <li><a class="instagram_link" href="{{ $team_one->instagram }}"><i class="fa fa-instagram"
                                        aria-hidden="true"></i></a></li>
                        @endif
                    </ul>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
