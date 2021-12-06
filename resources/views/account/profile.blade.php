@extends('layouts.' . (Auth::user()->access === '-1' ? 'app_admin' : 'app'))

@section('header.css')
    <link href="{{ asset('css/profile.css') }}?v={{ env('APP_VERSION') }}" rel="stylesheet" type="text/css">
    @if (Auth::user()->access === '-1')
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

@section('content')
    <div class="content container">
        <div class="profile_head">
            <label class="avatar">
                <span class="title">My profile: </span>
                <div class="avatar_photo"
                    style="background-image: url('{{ $user->avatar ? $user->avatar : 'https://robohash.org/qiacademy?set=set4' }}');">
                </div>
                <input type="file" class="profile_avatar d-none" accept="image/png, image/gif, image/jpeg">
            </label>

            <button class="profile_button profile_save desktop">Zapisz zmiany</button>
        </div>
        <div class="form" data-formAction="/profile">
            <label class="profile_label">
                <span class="title">Name</span>
                <input autocomplete="off" type="text" class="profile_input profile_name" placeholder="Name and Last name"
                    value="{{ $user->name }}">
            </label>
            <label class="profile_label">
                <span class="title">Phone</span>
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

            <button class="profile_button save mobile">Zapisz zmiany</button>
        </div>
    </div>
@endsection
