@extends('layouts.app')

@section('content')
    <div class="container">





        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <p class="font-weight-bold text-center" style="font-size: large;padding: 5px;">Игры Карточных войн</p>

                    <form method="POST" action="{{ route('cardwars.store') }}">
                        @csrf
                    <table style="height: 50px;">
                        <tbody>
                        <tr>

                            <td class="align-middle" style="width: 130px;padding-left: 20px;">Название игры:</td>
                            <td class="align-middle" style="width: 170px;">
                                <input name="name"
                                                                                 id="name"
                                                                                 type="text"
                                                                                 class="form-control block" >
                            </td>

                            <td class="align-middle" style="width: 80px;padding-left: 20px;">Пароль:</td>
                            <td class="align-middle" style="width: 130px;"><input name="password"
                                                                                  id="password"
                                                                                  type="text"
                                                                                  class="form-control block " >
                            </td>

                            <td class="align-middle" style="width: 163px;padding-left: 20px;">Количество игроков:</td>
                            <td class="align-middle" style="width: 50px;"><input name="count_players"
                                                                                 id="count_players"
                                                                                 type="text"
                                                                                 class="form-control block" >
                            </td>



                            <td style="padding-left: 20px;">
                                <button type="submit" class="btn btn-primary">Создать игру</button>
                            </td>
                        </tr>
                        </tbody>

                    </table>
                    </form>



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
                                    <td><a href="/games/cardwars/{{ $item->game_number }}" class="btn-primary btn">Войти</a> </td>
{{--                                    <a href="{{route('blog.admin.categories.edit', $item->id)}}">--}}

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>



{{--<div style="transform: scale(0.2, 0.2); position: absolute; top:-300px; left:-300px;">--}}
{{--    <div style="width: 801px;position: relative;--}}
{{--        display: flex;--}}
{{--        flex-direction: column;">--}}
{{--        <p class="crop" style="overflow:hidden; /* this is important */">--}}
{{--            <a href="#" ><img src="/img/httpsiimgurcom5lrQVbTjpg.jpg" style="margin:-0px -0px -5555px -801px;"/></a>--}}
{{--        </p>--}}
{{--    </div>--}}
{{--</div>--}}

{{--                    <div style="transform: scale(0.2, 0.2); position: absolute; top:-300px; left:0px;">--}}
{{--                        <div style="width: 801px;position: relative;--}}
{{--        display: flex;--}}
{{--        flex-direction: column;">--}}
{{--                            <p class="crop" style="overflow:hidden; /* this is important */">--}}
{{--                                <a href="#" ><img src="/img/httpsiimgurcom5lrQVbTjpg.jpg" style="margin:-0px -0px -4444px -801px;"/></a>--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                    </div>--}}



                </div>
            </div>
        </div>

    </div>
@endsection
