@extends('layouts.app_admin')

@section('header.css')
    <link rel="stylesheet" href="{{ asset('css/adm_clients.css') }}?v={{ env('APP_VERSION') }}">
@endsection

@section('footer.js')
    <script src="{{ asset('js/adm_clients.js') }}?v={{ env('APP_VERSION') }}"></script>
@endsection

@section('templates')
    <template id="tpl_client_item">
        <tr class="client_item info" data-clientId="-1}">
            <td class="tools"></td>
            <td class="name"></td>
            <td class="phone"></td>
            <td class="email"></td>
            <td class="total_courses"></td>
            <td class="link">
                <a href="{{ route('account.profile') }}/" class="button">Внести изменения</a>
            </td>
        </tr>
    </template>
@endsection

@section('content')
    <div class="content container">
        <a href="{{ route('admin.dashboard') }}" class="button back">back</a>
        <h1 class="title">Список клиентов</h1>

        <div class="tools_block">
            <label class="search_field">
                <input type="text" class="text search_by" placeholder="Поиск">
                <i class="fas fa-search icon_search"></i>
            </label>
            <div class="info_block">
                <div class="info_item">
                    <span class="title">Всего клиентов</span>
                    <span class="value">{{ count($clients) }}</span>
                </div>
                <div class="info_item">
                    <span class="title">Купили курсы</span>
                    <span class="value">{{ $total_with_courses }}</span>
                </div>
            </div>
        </div>

        <div class="clients_form" data-formAction="{{ route('admin.clients.post') }}">
            <table class="clients_table">
                <thead>
                    <tr>
                        <th></th>
                        <th data-sortBy="name" class="sort_button active">Имя <i
                                class="fas fa-sort-amount-down icon_sort"></i>
                        </th>
                        <th>Номер</th>
                        <th>email <a download="" class="download" href="{{ route('admin.clients.download') }}" data-href="{{ route('admin.clients.download') }}">скачать <i
                                    class="fas fa-download icon"></i></a>
                        </th>
                        <th data-sortBy="total_courses" class="sort_button">Купленных курсов <i
                                class="fas fa-sort-amount-down icon_sort"></i>
                        </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clients as $key => $client)
                        <tr class="client_item info" data-clientId="{{ $client['id'] }}">
                            <td class="tools">{{ $key + 1 }}</td>
                            <td class="name">{{ $client['name'] . ' ' . $client['lastname'] }}</td>
                            <td class="phone">{{ $client['phone'] }}</td>
                            <td class="email">{{ $client['email'] }}</td>
                            <td class="total_courses">{{ $client['total_courses'] }}</td>
                            <td class="link">
                                <a href="{{ route('account.profile', $client['id']) }}" class="button">Внести
                                    изменения</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
