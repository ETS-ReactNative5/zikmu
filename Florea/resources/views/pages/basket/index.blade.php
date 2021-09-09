@extends('layout.app')

@section('title')
    Panier
@endsection

@section('content')
    <div class="container">
        <h3>Panier</h3>
        <div class="row">
            <h4 class="col-6">Nombre de produits : {{$totalProducts}}</h4>
            <h4 class="col-6"><a href="{{route('basket.empty')}}" class="text-right">Vider mon panier</a></h4>
        </div>
        <h4>Prix Total : {{ number_format($totalPrice, 2, ',', ' ') }}&nbsp;€</h4>
        <div class="row">
            @if ($products)
                @foreach($products['items'] as $key => $item)
                    <x-product :product="$item" :quantity="$item->quantity" :cart="$cart ?? ''"/>
                @endforeach
            @endif
        </div>
        <br>
        <a href="{{route('basket.store')}}" class="btn btn-success">Valider mon panier</a>
    </div>
@endsection