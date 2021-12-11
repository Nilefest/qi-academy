@extends('layouts.app_admin')

@section('footer.js')
    <script src="{{ asset('js/adm_clients.js') }}?v={{ env('APP_VERSION') }}"></script>
@endsection

@section('content')
    <div class="content container">
        <a href="{{ route('admin.dashboard') }}" class="button back">back</a>
        <h1 class="title">Редактор офлайн курса</h1>
        <div class="clients_form" data-formAction="{{ route('admin.clients.post') }}">
            <table>
                <style>
                    .sort_button:hover {
                        cursor: pointer;
                    }

                    .icon_sort {
                        opacity: 0.5;
                        font-size: 1.3em;
                        padding: 0px 15px;
                    }
                    .sort_button:hover .icon_sort {
                        opacity: 0.8;
                    }

                    .icon_sort.usort {
                        transform: scale(1, -1);
                    }

                    .icon_sort.active {
                        opacity: 1;
                    }

                </style>
                <thead>
                    <tr>
                        <th></th>
                        <th class="sort_by_name sort_button">Имя <i style="opacity: 0;" class="fas fa-sort-amount-down icon_sort active"></i></th>
                        <th>Номер</th>
                        <th>email <a style="opacity: 0;" class="download" href="#download">скачать <i class="fas fa-download icon"></i></a>
                        </th>
                        <th class="sort_by_pay sort_button">Купленных курсов <i style="opacity: 0;" class="fas fa-sort-amount-down icon_sort"></i>
                        </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clients as $key => $client)
                        <tr class="client_item info" data-clientId="{{ $client['id'] }}">
                            <td class="tools">{{ $key + 1 }}</td>
                            <td>{{ $client['name'] }}</td>
                            <td>{{ $client['phone'] }}</td>
                            <td>{{ $client['email'] }}</td>
                            <td>{{ $client['total_courses'] }}</td>
                            <td><a href="{{ route('account.profile', $client['id']) }}" class="button">Внести
                                    изменения</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
