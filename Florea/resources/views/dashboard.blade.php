@extends('layout.app')

@section('title')
Dashboard
@endsection

@section('content')
<div class="container">
    <h2>Dashboard</h2>
    <div class="ps-5">

        @foreach($baskets as $key => $basket)
            <h2>Panier n°{{ $key + 1 }}</h2>
            <div class="row">

                @foreach($basket->products as $key => $product)
                    <div class="col-xl-3 col-lg-4 col-md-6 col-12 color-green">
                        {{-- <a href="{{route('product.show', ['product' => $product, 'slug' => Str::slug($product->title)]) }}"
                        class="col-xl-3 col-lg-4 col-md-6 col-12 color-green"> --}}
                        <div class="mb-3 product" style="position: relative">
                            @if($quantity ?? '')
                                <span class="badge badge-primary"
                                    style="position: absolute; top: 25px; right: -10px; background-color: green">
                                    {{ $quantity ?? '' ?? '' }}
                                </span>
                            @endif
                            <h3 class="card-title fsz-24 text-center no-uppercase" style="color: black">
                                {{ $product->title }}</h3>
                            <div class="card-img-top"
                                style="background-image: url({{ Voyager::image($product->image) }}); background-position: center center; background-size:cover">

                            </div>
                            {{-- <span class="price"><?= number_format($product->price, 2, ',', '&nbsp;');?>&nbsp;€</span> --}}
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach

    </div>
</div>
@endsection
