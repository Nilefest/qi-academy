@extends('layouts.app_admin')

@section('content')
    <div class="content container">
        <nav class="dashboard_nav">
            <a href="{{ route('admin.courses') }}" class="dashboard_item"><span class="title">Курсы</span></a>
            <a href="#adm_link" class="dashboard_item disabled"><span class="title">Отчет о покупках</span></a>
            <a href="#adm_link" class="dashboard_item disabled"><span class="title">База клиентов</span></a>
            <a href="#adm_link" class="dashboard_item disabled"><span class="title">Редактор главной
                    страницы</span></a>
            <a href="{{ route('admin.courses_offline') }}" class="dashboard_item"><span class="title">Редактор офлайн
                    курсов</span></a>
            <a href="{{ route('admin.team') }}" class="dashboard_item"><span class="title">Команда</span></a>
        </nav>
    </div>
@endsection
