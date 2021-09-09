@extends('layout.app')

@section('title')
    Recherche : {{$q}}
@endsection

@section('content')
    <div class="container">
        <h1>Resultat de la recherche : {{$q}}</h1>

        <h3>Produits</h3>
        <div class="row">
            @if (count($search['products']) == 0)
                <p>Aucun résultat pour cette recherche</p>
            @else
                @foreach ($search['products'] as $item)
                    <x-product :product="$item" />
                @endforeach
            @endif
        </div>

        <h3>Categories</h3>
        <div class="row">
            @if (count($search['categories']) == 0)
                <p>Aucun résultat pour cette recherche</p>
            @else
                @foreach ($search['categories'] as $item)
                    <x-category :category="$item" />
                @endforeach
            @endif
        </div>
    </div>
@endsection