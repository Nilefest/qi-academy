@extends('layouts.app_auth')

@section('header.css')
    <link rel="stylesheet" href="{{ asset('css/adm_login.css') }}?v={{ env('APP_VERSION') }}">
@endsection

@section('content')
    <div class="content container">
        <h1>Qi ADMIN <i class="fal fa-lock-alt icon"></i></h1>
        <div class="form">
            <div class="empty"></div>
            <form method="POST" action="{{ route('password.confirm') }}">
                <p><b>{{ __('Please confirm your password before continuing.') }}</b></p>
                @csrf
                <input autocomplete="password" name="password" required type="text"
                    class="input_text @error('email') invalid @enderror" placeholder="Password">
                <input type="submit" class="button" value="{{ __('Confirm Password') }}">
            </form>
            <div class="message">
                <i class="fal fa-info-circle icon_info"></i>
                <div class="info">
                    @error('password')
                        <p class="error_message"><i>{{ $message }}</i></p>
                    @enderror
                    @if (Route::has('password.request'))
                    <p><a href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a></p>
                    @endif
                    <p>If you have problems: </p>
                    <span href="#mail" class="admin_mail button_copy" data-textCopy="lexa.amb@gmail.com">lexa.amb@gmail.com
                        <i class="far fa-copy icon"></i></span>
                </div>
            </div>
        </div>
    </div>
@endsection
