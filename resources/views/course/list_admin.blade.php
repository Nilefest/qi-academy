@extends('layouts.app_admin')

@section('content')
    <div class="content container">
        <a href="{{ route('admin.dashboard') }}" class="button back">back</a>
        <nav class="dashboard_nav">
            <a href="{{ route('admin.course.edit') }}" class="dashboard_item item_add"><span class="title">Добавить
                    курс</span></a>
            @if ($sort_type !== 'hide')
                <a href="{{ route('admin.courses', 'all') }}" class="dashboard_item items_sort"><span
                        class="title">Все</span></a>
                <a href="{{ route('admin.courses', 'paid') }}"
                    class="dashboard_item items_sort @if ($sort_type === 'paid')) active @endif"><span class="title">Платные</span></a>
                <a href="{{ route('admin.courses', 'free') }}"
                    class="dashboard_item items_sort @if ($sort_type === 'free')) active @endif"><span
                        class="title">Бесплатные</span></a>
                <a href="{{ route('admin.courses', 'bonuse') }}"
                    class="dashboard_item items_sort @if ($sort_type === 'bonuse')) active @endif"><span class="title">Бонусные (для
                        клиентов)</span></a>
            @else
                @foreach ($courses_all as $course_one)
                    <a href="{{ route('admin.course.edit', $course_one['id']) }}"
                        style="background-image: url('{{ $course_one['banner_img'] }}')" class="dashboard_item"><span
                            class="title">{{ $course_one['name'] }}</span></a>
                @endforeach
            @endif
        </nav>
        @if ($sort_type !== 'hide')
            @if (!empty($courses_paid))
                <h2 class="title">Paid <span class="total">({{ count($courses_paid) }} / {{ count($courses_all) }} items)</span></h2>
                <nav class="dashboard_nav">
                    @foreach ($courses_paid as $course_one)
                        <a href="{{ route('admin.course.edit', $course_one['id']) }}"
                            style="background-image: url('{{ $course_one['banner_img'] }}')" class="dashboard_item"><span
                                class="title">{{ $course_one['name'] }}</span></a>
                    @endforeach
                </nav>
            @endif
            @if (!empty($courses_bonuse))
                <h2 class="title">Free only for clients <span class="total">({{ count($courses_bonuse) }} / {{ count($courses_all) }} items)</span></h2>
                <nav class="dashboard_nav">
                    @foreach ($courses_bonuse as $course_one)
                        <a href="{{ route('admin.course.edit', $course_one['id']) }}"
                            style="background-image: url('{{ $course_one['banner_img'] }}')" class="dashboard_item"><span
                                class="title">{{ $course_one['name'] }}</span></a>
                    @endforeach
                </nav>
            @endif
            @if (!empty($courses_free))
                <h2 class="title">Free <span class="total">({{ count($courses_free) }} / {{ count($courses_all) }} items)</span></h2>
                <nav class="dashboard_nav">
                    @foreach ($courses_free as $course_one)
                        <a href="{{ route('admin.course.edit', $course_one['id']) }}"
                            style="background-image: url('{{ $course_one['banner_img'] }}')" class="dashboard_item"><span
                                class="title">{{ $course_one['name'] }}</span></a>
                    @endforeach
                </nav>
            @endif
            @if (!empty($courses_all) && $sort_type !== 'all')
                <h2 class="title">All <span class="total">({{ count($courses_all) }} items)</span></h2>
                <nav class="dashboard_nav">
                    @foreach ($courses_all as $course_one)
                        <a href="{{ route('admin.course.edit', $course_one['id']) }}"
                            style="background-image: url('{{ $course_one['banner_img'] }}')" class="dashboard_item"><span
                                class="title">{{ $course_one['name'] }}</span></a>
                    @endforeach
                </nav>
            @endif
        @endif
    </div>
@endsection
