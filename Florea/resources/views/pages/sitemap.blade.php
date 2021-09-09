@extends('layout.app')

@section('title')
    Plan du site
@endsection

@section('content')
    <div class="container">
        <h2 class="text-center">
            Categories
        </h3>

        <ul class="list-group">
            @foreach ($categories as $item)
            <li class="list-group-item">
                <a href="{{route('category.show', ['category' => $item, 'slug' => Str::slug($item->title)])}}">{{$item->title}}</a>
            </li>
        @endforeach
        </ul>
        <h2 class="text-center">
            Produits
        </h3>
        <div class="row">
            @foreach($products as $item)
                <x-product :product="$item" />
            @endforeach
        </div>

    </div>
@endsection