@extends('layouts.app')

@section('content')
    <div class="container">

        @foreach($items as $item)
               {{ $item->name }}



            <catan-component :user="{{ auth()->user() }}" :item="{{$item}}"></catan-component>
        @endforeach
    </div>
@endsection
