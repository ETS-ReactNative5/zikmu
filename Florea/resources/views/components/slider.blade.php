

  <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" style="max-height: 400px">
    <div class="carousel-indicators">
        @foreach($products as $key => $item)
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{$key}}" class="{{$key == 0 ? 'active' : '' }}" aria-current="true" aria-label="Slide 1"></button>
        @endforeach
    </div>
    <div class="carousel-inner">
        @foreach($products as $key => $item)
            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                <div class="d-block w-100" style="background-image: url({{Voyager::image($item->image)}}); height: 400px; background-repeat: no-repeat; background-size: cover; background-position: center center;" alt="{{$item->title}}"> </div>
            </div>
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>