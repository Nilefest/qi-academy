@extends('layouts.app_admin')

@section('content')
    <div class="content container">
        <a href="{{ route('admin.dashboard') }}" class="button back">back</a>
        <h1 class="title">Редактор контактов</h1>
        <form action="{{ route('admin.contacts.post') }}" method="POST" class="contacts_form">
            <div class="contact_fields">
                @csrf
                <label>
                    <span class="title">Номер телефона</span>
                    <input name="contacts[phone]" type="text" class="text" value="{{ $contacts['phone']['link'] }}">
                </label>
                <label>
                    <span class="title">Whatsapp</span>
                    <input name="contacts[whatsapp]" type="text" class="text" value="{{ $contacts['whatsapp']['link'] }}">
                </label>
                <label>
                    <span class="title">Facebook messenger</span>
                    <input name="contacts[facebook_messenger]" type="text" class="text" value="{{ $contacts['facebook_messenger']['link'] }}">
                </label>
                <label>
                    <span class="title">Facebook</span>
                    <input name="social[facebook]" type="text" class="text" value="{{ $social['facebook']['link'] }}">
                </label>
                <label>
                    <span class="title">Instagram</span>
                    <input name="social[instagram]" type="text" class="text" value="{{ $social['instagram']['link'] }}">
                </label>
                <label>
                    <span class="title">You Tube</span>
                    <input name="social[youtube]" type="text" class="text" value="{{ $social['youtube']['link'] }}">
                </label>
                <input name="save_contacts" type="submit" class="button save_contacts" value="Сохранить данные">
            </div>
        </form>
    </div>
@endsection
