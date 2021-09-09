<li class="list-group-item searchResults">
    <a href="{{route('product.show.post', ['product' => $product, 'slug' => Str::slug($product->title)])}}"
        class="d-flex align-items-center hoverable">
        <img src="{{Voyager::image($product->image)}}" class="img-small" />
        <h5 class="ms-2">{{$product->title}}</h5>
    </a>
</li>
