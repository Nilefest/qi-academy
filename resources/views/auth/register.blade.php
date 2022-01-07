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
        <h1>Qi SIGN UP <i class="fal fa-lock-alt icon"></i></h1>
>>>>>>> dev
        <div class="form">
            <div class="empty"></div>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <input value="{{ old('name') }}" required name="name" autocomplete="name" autofocus type="text"
<<<<<<< HEAD
                    class="input_text @error('name') invalid @enderror" placeholder="Full name">
=======
                    class="input_text @error('name') invalid @enderror" placeholder="Your name">
                <input value="{{ old('lastname') }}" required name="lastname" autocomplete="lastname" autofocus type="text"
                    class="input_text @error('lastname') invalid @enderror" placeholder="Lastname">
>>>>>>> dev
                <input value="{{ old('email') }}" required name="email" autocomplete="email" type="email"
                    class="input_text @error('email') invalid @enderror" placeholder="Your email address">
                <input autocomplete="new-password" name="password" required type="text"
                    class="input_text @error('email') invalid @enderror" placeholder="Password">
<<<<<<< HEAD
                <input autocomplete="new-password" name="password_confirmation" required autocomplete="current-password" type="text"
                    class="input_text @error('email') invalid @enderror" placeholder="Confirm password">
=======
                <input autocomplete="new-password" name="password_confirmation" required autocomplete="current-password"
                    type="text" class="input_text @error('email') invalid @enderror" placeholder="Confirm password">
>>>>>>> dev
                <input type="submit" class="button" value="Sign Up">
            </form>
            <div class="message">
                <i class="fal fa-info-circle icon_info"></i>
                <div class="info">
                    @error('name')
                        <p class="error_message"><i>{{ $message }}</i></p>
                    @enderror
                    @error('email')
                        <p class="error_message"><i>{{ $message }}</i></p>
                    @enderror
                    @error('password')
                        <p class="error_message"><i>{{ $message }}</i></p>
                    @enderror
<<<<<<< HEAD
                    <p>With: <b><a href="{{ url('auth/google') }}">Google</a> | <a
                                href="{{ url('auth/facebook') }}">Facebook</a></b></p>
=======
                    <p><b><a class="link" href="{{ url('/login') }}">Sign in</a> | <a
                                href="{{ url('auth/google') }}">With Google</a> | <a
                                href="{{ url('auth/facebook') }}">With Facebook</a></b></p>
>>>>>>> dev
                    <p>If you have problems: </p>
                    <span href="#mail" class="admin_mail button_copy" data-textCopy="lexa.amb@gmail.com">lexa.amb@gmail.com
                        <i class="far fa-copy icon"></i></span>
                </div>
            </div>
        </div>
    </div>
@endsection
