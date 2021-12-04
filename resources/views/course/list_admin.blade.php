@extends('layouts.app_admin')

@section('content')
    <div class="content container">
        <style>

        </style>
        <a href="{{ route('admin.dashboard') }}" class="button back">back</a>
        <nav class="dashboard_nav">
            <a href="{{ route('admin.course.edit') }}" class="dashboard_item item_add"><span class="title">Добавить
                    курс</span></a>
            @foreach ($courses_list as $course_one)
                <a href="{{ route('admin.course.edit', $course_one->id) }}"
                    style="background-image: url('{{ $course_one->banner_img }}')" class="dashboard_item"><span
                        class="title">{{ $course_one->name }}</span></a>
            @endforeach
        </nav>
    </div>
@endsection
