@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- Передаем пользователя в компонент--}}
{{--        <catan-component :user="{{ auth()->user() }}"></catan-component>--}}



    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <p class="font-weight-bold text-center" style="font-size: large;padding: 5px;">Игры колонизаторов</p>
                <div class="col-md-2 ">

                    <a href="{{ route('catan.create') }}" class="btn-success btn ">Создать игру</a></div>

                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Название</th>
                            <th>Номер игры (id)</th>
                            <th>Пароль</th>
                            <th>Количество игроков</th>
                            <th>Присоединиться</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)



                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->game_number }}</td>
                                <td>{{ $item->password }}</td>
                                <td>{{ $item->count_players }}</td>
                                <td><a href="/games/catan/{{ $item->game_number }}" class="btn-primary btn">Войти</a> </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    </div>
@endsection
