@extends('layout.app')

@section('title')
    Accueil
@endsection

@section('content')
    <x-slider />
    <div class="container">
        <div class="row">

            @foreach($ones as $item)
                <x-product :product="$item" />
            @endforeach
        </div>
    </div>  
@endsection
