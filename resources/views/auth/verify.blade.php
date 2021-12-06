@extends('layouts.app_auth')

@section('header.css')
    <link rel="stylesheet" href="{{ asset('css/adm_login.css') }}?v={{ env('APP_VERSION') }}">
@endsection

@section('content')
    <div class="content container">
        <h1>Qi ADMIN <i class="fal fa-lock-alt icon"></i></h1>
        <div class="form">
            <div class="empty"></div>
            <form method="POST" action="{{ route('verification.resend') }}">
                <h1>{{ __('Verify Your Email Address') }}</h1>
                @if (session('resent'))
                <p><b>{{ __('A fresh verification link has been sent to your email address.') }}</b></p>
                @endif
                <p>{{ __('Before proceeding, please check your email for a verification link.') }}</p>
                <p>{{ __('If you did not receive the email') }}</p>
                @csrf
                <input type="submit" class="button" value="{{ __('click here to request another') }}">
            </form>
            <div class="message">
                <i class="fal fa-info-circle icon_info"></i>
                <div class="info">
                    @if (session('status'))
                    <p class="status_message"><b>{{ session('status') }}</b></p>
                    @endif
                    @error('email')
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
