@extends('layouts.app_auth')

@section('header.css')
    <link rel="stylesheet" href="{{ asset('css/payment.css') }}?v={{ env('APP_VERSION') }}">
@endsection

@section('header')
    <div class="header">
        <h1>Qi PAY</h1>
        <a href="{{ route('course.view', $course->id) }}" class="button back">back</a>
    </div>
@endsection

@section('content')
    <div class="content container">
        <form action="{{ $fields['url_form'] }}" method="POST" class="form_pay">
            <div class="personal_data form_column">
                <h2 class="title">Dane kupującego</h2>
                <input require readonly type="hidden" class="text" name="simp" value="{{ $fields['simp'] }}">
                <input require readonly type="text" class="text" name="customerFirstName"
                    value="{{ $fields['customerFirstName'] }}" placeholder="First name*">
                <input require readonly type="text" class="text" name="customerLastName"
                    value="{{ $fields['customerLastName'] }}" placeholder="Last name*">
                <input require readonly type="email" class="text" name="customerEmail"
                    value="{{ $fields['customerEmail'] }}" placeholder="Email*">
                <input require readonly type="hidden" class="text" name="customerPhone"
                    value="{{ $fields['customerPhone'] }}" placeholder="Phone">
            </div>

            <div class="course_data form_column">
                <div class="course_main_info">
                    <div class="banner_img" style="background-image: url({{ $course->banner_img }});"></div>
                    <div class="main_info">
                        <div class="title">kurs</div>
                        <b class="course_name">{{ $course->name }}</b>
                    </div>
                </div>
            </div>

            <div class="payment_data form_column">
                <div class="cost_info">
                    <span class="title">cena</span>
                    <b class="value">700 Zl</b>
                </div>

                <input require readonly type="hidden" class="text" name="urlSuccess"
                    value="{{ $fields['urlSuccess'] }}">
                <input require readonly type="hidden" class="text" name="urlFailure"
                    value="{{ $fields['urlFailure'] }}">
                <input require readonly type="hidden" class="text" name="urlReturn"
                    value="{{ $fields['urlReturn'] }}">

                <input require readonly type="hidden" class="text" name="merchantId"
                    value="{{ $fields['merchantId'] }}">
                <input require readonly type="hidden" class="text" name="serviceId"
                    value="{{ $fields['serviceId'] }}">

                <input require readonly type="hidden" class="text" name="amount"
                    value="{{ $fields['amount'] }}">
                <input require readonly type="hidden" class="text" name="currency"
                    value="{{ $fields['currency'] }}">
                <input require readonly type="hidden" class="text" name="orderDescription"
                    value="{{ $fields['orderDescription'] }}">
                <input require readonly type="hidden" class="text" name="orderId"
                    value="{{ $fields['orderId'] }}">
                <input require readonly type="hidden" class="text" name="visibleMethod"
                    value="{{ $fields['visibleMethod'] }}">

                <input require readonly type="hidden" class="text" name="signature"
                    value="{{ $fields['signature_str'] }}">
                <input require readonly type="submit" class="button" value="zapłacić za kurs">
                <a href="{{ route('payment.success', [$course->id, $user->id]) }}">Set as paid</a>
            </div>
        </form>
    </div>
@endsection
