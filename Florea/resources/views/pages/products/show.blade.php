@extends('layout.app')

@section('title')
    {{ $product->title }}
@endsection

@section('content')
    <nav aria-label="breadcrumb" class="breadcrumb-container">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                <li class="breadcrumb-item"><a
                        href="{{ route('category.show', ['category' => $category, 'slug' => Str::slug($category->title)]) }}">{{ $category->title }}</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ $product->title }}</li>
            </ol>
        </div>
    </nav>
    <div class="container my-5">
        <h2 class="text-center no-underline">
            <span class="h-underline">
                {{ $product->title }}
            </span>
        </h2>
        <div class="row my-5">
            <div class="col-md-6 col-12">
                <div class="product hoverable rounded">
                    <a href="#" data-lightbox="image-1" data-title="<?= $product->title ?>">
                        <img src="{{ Voyager::image($product->image) }}" class="w-100" alt="">
                        <!-- <img src="src/img/photos/small/<?= $product->image ?>" alt="" class="w-100  shadow" data-lightbox="src/img/photos/large/<?= $product->image ?>"> -->
                        <span class="price"><?= number_format($product->price, 2, ',', '&nbsp;') ?> €</span>
                    </a>
                </div>
            </div>
            <div class="col-md-6 col-12">
                {!! $product->description !!}
                
            </div>
        </div>
        <form action="{{route('basket.add')}}" method="POST" class="row g-3">
            @csrf
            <input type="hidden" name="product" value="{{$product->id}}">
            <div class="col-auto">
                <label for="quantity" class="visually-hidden">Quantité</label>
                <select name="quantity" id="quantity" class="form-select">
                    @for ($i = 1; $i < 100; $i++)
                        <option value="{{$i}}">{{$i}}</option>
                    @endfor
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-3">Ajouter au panier</button>
            </div>
        </form>

        <h2 class="text-center no-underline">
            <span class="h-underline">
                Dans la même catégorie
            </span>
        </h2>
        <div class="row">

            <?php foreach ($sameCatProducts as $key => $product) : ?>
            <x-product :product="$product" />
            <?php endforeach; ?>
        </div>
    </div>
@endsection
