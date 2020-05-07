@extends('layouts.app')

@section('content')
            @foreach($items as $item)
                {{--               {{ $item->name }}--}}
                <catan-component :user="{{ auth()->user() }}" :item="{{$item}}"></catan-component>
            @endforeach



@endsection
