<div class="col-xl-3 col-lg-4 col-md-6 col-12 color-green">
    <a href="{{route('product.show', ['product' => $product, 'slug' => Str::slug($product->title)])}}" class="col-xl-3 col-lg-4 col-md-6 col-12 color-green">
        <div class="mb-3 product" style="position: relative">
            @if ($quantity)
                <span class="badge badge-primary" style="position: absolute; top: 25px; right: -10px; background-color: green">
                    {{$quantity}}
                </span>
            @endif
            <h3 class="card-title fsz-24 text-center no-uppercase" style="color: black">{{$product->title}}</h3>
            <div class="card-img-top" style="background-image: url({{Voyager::image($product->image)}}); background-position: center center; background-size:cover">
    
            </div>
            <span class="price"><?= number_format($product->price, 2, ',', '&nbsp;');?>&nbsp;€</span>
        </div>
    </a>
    @if ($quantity)
            <form action="{{route('basket.update')}}" class="row g-3" method="POST">
                @csrf
                <input type="hidden" name="product" value="{{$product->id}}">
                <div class="col-auto">
                    <label for="quantity" class="visually-hidden">Quantité</label>
                    <select name="quantity" id="quantity" class="form-select">
                        @for ($i = 0; $i < 100; $i++)
                            <option value="{{$i}}" @if ($cart['items'][$product->id]->quantity == $i) selected @endif>{{$i}}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-3">Modifier la quantité</button>
                </div>
            
            </form>
        @endif
</div>