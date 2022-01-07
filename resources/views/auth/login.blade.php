@extends('layouts.app_auth')

@section('header.css')
<<<<<<< HEAD
    <link rel="stylesheet" href="{{ asset('css/adm_login.css') }}">
=======
    <link rel="stylesheet" href="{{ asset('css/adm_login.css') }}?v={{ env('APP_VERSION') }}">
>>>>>>> dev
@endsection

@section('content')
    <div class="content container">
<<<<<<< HEAD
        <h1>Qi ADMIN <i class="fal fa-lock-alt icon"></i></h1>
=======
        <p><a href="{{ url('/') }}"><i class="fas fa-arrow-left icon_back"></i> Back</a></p>
        <h1>Qi SIGN IN <i class="fal fa-lock-alt icon"></i></h1>
>>>>>>> dev
        <div class="form">
            <div class="empty"></div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
<<<<<<< HEAD
                <input value="{{ old('email') }}" required name="email" autocomplete="email" autofocus type="email" class="input_text @error('email') invalid @enderror" placeholder="your email address">
                <input name="password" required autocomplete="current-password" type="password" class="input_text @error('email') invalid @enderror" placeholder="******">
                <input type="submit" class="button" value="Sign In">
                <label class="remember_me">
                    <input {{ old('remember') ? 'checked' : '' }} id="remember" name="remember" type="checkbox" class="d-none">
=======
                <input value="{{ old('email') }}" required name="email" autocomplete="email" autofocus type="email"
                    class="input_text @error('email') invalid @enderror" placeholder="your email address">
                <input name="password" required autocomplete="current-password" type="password"
                    class="input_text @error('email') invalid @enderror" placeholder="******">
                <input type="submit" class="button" value="Sign In">
                <label class="remember_me">
                    <input {{ old('remember') ? 'checked' : '' }} id="remember" name="remember" type="checkbox"
                        class="d-none">
>>>>>>> dev
                    <i class="far icon"></i>
                    <span class="title">Remember me</span>
                </label>
            </form>
            <div class="message">
                <i class="fal fa-info-circle icon_info"></i>
                <div class="info">
                    @error('email')
<<<<<<< HEAD
                    <p class="error_message"><i>{{ $message }}</i></p>
                    @enderror
                    @error('password')
                    <p class="error_message"><i>{{ $message }}</i></p>
                    @enderror
                    <p>With: <b><a href="{{ url('auth/google') }}">Google</a> | <a href="{{ url('auth/facebook') }}">Facebook</a></b></p>
                    @if (Route::has('password.request'))
                    <p><a href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a></p>
=======
                        <p class="error_message"><i>{{ $message }}</i></p>
                    @enderror
                    @error('password')
                        <p class="error_message"><i>{{ $message }}</i></p>
                    @enderror
                    <p><b><a class="link" href="{{ url('/register') }}">Sign up</a> | <a
                                href="{{ url('auth/google') }}">With Google</a> | <a
                                href="{{ url('auth/facebook') }}">With Facebook</a></b></p>
                    @if (Route::has('password.request'))
                        <p><a href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a></p>
>>>>>>> dev
                    @endif
                    <p>If you have problems: </p>
                    <span href="#mail" class="admin_mail button_copy" data-textCopy="lexa.amb@gmail.com">lexa.amb@gmail.com
                        <i class="far fa-copy icon"></i></span>
                </div>
            </div>
        </div>
    </div>
@endsection
