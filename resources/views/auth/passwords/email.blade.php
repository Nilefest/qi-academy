@extends('layouts.app_auth')

@section('header.css')
    <link rel="stylesheet" href="{{ asset('css/adm_login.css') }}?v={{ env('APP_VERSION') }}">
@endsection

@section('content')
    <div class="content container">
        <p><a href="{{ url('/') }}"><i class="fas fa-arrow-left icon_back"></i> Back</a></p>
        <h1>Qi <i class="fal fa-lock-alt icon"></i></h1>
        <div class="form">
            <div class="empty"></div>
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <input value="{{ old('email') }}" required name="email" autocomplete="email" type="email"
                    class="input_text @error('email') invalid @enderror" placeholder="Your email address">
                <input type="submit" class="button" value=" {{ __('Send Password Reset Link') }}">
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
