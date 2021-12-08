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
                <thead>
                    <tr>
                        <th></th>
                        <th class="sort_by_name">Имя</th>
                        <th>Номер</th>
                        <th>email <a class="download" href="#download">скачать <i class="fas fa-download icon"></i></a></th>
                        <th class="sort_by_pay">Купленных курсов</th>
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
                            <td><a href="{{ route('account.profile', $client['id']) }}" class="button">Внести изменения</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
