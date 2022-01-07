@extends('layouts.app_admin')

@section('footer.js')
    <script src="{{ asset('js/adm_setting.js') }}?v={{ env('APP_VERSION') }}"></script>
@endsection

@section('content')
    <div class="content container">
        <nav class="dashboard_nav">
            <a href="{{ route('admin.courses') }}" class="dashboard_item"><span class="title">Курсы</span></a>
            <a href="{{ route('admin.clients') }}" class="dashboard_item"><span class="title">База
                    клиентов</span></a>
            <a href="{{ route('admin.courses_offline') }}" class="dashboard_item"><span class="title">Редактор
                    офлайн
                    курсов</span></a>
            <a href="{{ route('admin.team') }}" class="dashboard_item"><span class="title">Команда</span></a>
            <a href="{{ route('admin.contacts') }}" class="dashboard_item"><span
                    class="title">Контакты</span></a>
            <a href="{{ route('admin.reviews') }}" class="dashboard_item"><span class="title">Видео
                    отзывы</span></a>
        </nav>

        <div class="form setting_form" data-formAction="{{ route('admin.setting') }}">
            <h2>Дополнительные настройки</h2>
            
            <div class="field">
                <label for="payment_mode" class="title">Режим работы Imoje</label>
                <select id="payment_mode" class="text setting_field" data-settingType="imoje" data-settingName="test_mode">
                    <option @if($setting_fields['imoje']['test_mode'] == '0') selected @endif value="0">Обычный</option>
                    <option @if($setting_fields['imoje']['test_mode'] == '1') selected @endif value="1">Тестовый</option>
                </select>
            </div>
            <input type="button" class="button submit" id="setting_save" value="Сохранить">
        </div>
    </div>
@endsection
