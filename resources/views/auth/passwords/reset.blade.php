@extends('layouts.app_auth')

@section('header.css')
    <link rel="stylesheet" href="{{ asset('css/adm_login.css') }}">
@endsection

@section('content')
    <div class="content container">
        <h1>Qi ADMIN <i class="fal fa-lock-alt icon"></i></h1>
        <div class="form">
            <div class="empty"></div>
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <input value="{{ $email ?? old('email') }}" required name="email" autocomplete="email" type="email"
                    class="input_text @error('email') invalid @enderror" placeholder="Your email address">
                <input autocomplete="new-password" name="password" required type="text"
                    class="input_text @error('email') invalid @enderror" placeholder="Password">
                <input autocomplete="new-password" name="password_confirmation" required autocomplete="current-password"
                    type="text" class="input_text @error('email') invalid @enderror" placeholder="Confirm password">
                <input type="submit" class="button" value="{{ __('Reset Password') }}">
            </form>
            <div class="message">
                <i class="fal fa-info-circle icon_info"></i>
                <div class="info">
                    @error('email')
                        <p class="error_message"><i>{{ $message }}</i></p>
                    @enderror
                    @error('password')
                        <p class="error_message"><i>{{ $message }}</i></p>
                    @enderror
                    <p>If you have problems: </p>
                    <span href="#mail" class="admin_mail button_copy" data-textCopy="lexa.amb@gmail.com">lexa.amb@gmail.com
                        <i class="far fa-copy icon"></i></span>
                </div>
            </div>
        </div>
    </div>
@endsection
