@extends('layouts.app')

@section('content')
    @foreach($items as $item)
{{--                       {{ $item->name }}--}}
        <cardwars-component :user="{{ auth()->user() }}" :item="{{$item}}"></cardwars-component>
    @endforeach



@endsection
