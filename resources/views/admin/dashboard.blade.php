@extends('layouts.app_admin')

@section('content')
    <div class="content container">
        <nav class="dashboard_nav">
            <a href="{{ route('admin.courses') }}" class="dashboard_item"><span class="title">Курсы</span></a>
            <a href="{{ route('admin.clients') }}" class="dashboard_item"><span class="title">База клиентов</span></a>
            <a href="{{ route('admin.courses_offline') }}" class="dashboard_item"><span class="title">Редактор офлайн
                    курсов</span></a>
            <a href="{{ route('admin.team') }}" class="dashboard_item"><span class="title">Команда</span></a>
            <a href="{{ route('admin.contacts') }}" class="dashboard_item"><span class="title">Контакты</span></a>
            <a href="{{ route('admin.reviews') }}" class="dashboard_item"><span class="title">Видео отзывы</span></a>
        </nav>
    </div>
@endsection
