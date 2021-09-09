@extends('layout.app')

@section('title')
    {{$category->title}}
@endsection

@section('content')
    <div class="container">
        <h2 class="text-center">{{$category->title}}</h2>
        <p class="text-center">{{$category->description}}</p>
        <div class="row">
            @foreach ($products as $item)
                <x-product :product="$item"/>
            @endforeach
        </div>
    </div>
@endsection