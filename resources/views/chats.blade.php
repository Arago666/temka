@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- Передаем пользователя в компонент--}}
        <chats-component :user="{{ auth()->user() }}"></chats-component>
    </div>
@endsection
