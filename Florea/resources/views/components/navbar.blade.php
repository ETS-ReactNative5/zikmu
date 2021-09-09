<header>
    <div class="w-100 top-header text-center">
        <h1>
            <a href="{{route('home')}}">
                <img src="{{asset('img/logo.svg')}}" alt="Florea Logo">
            </a>
        </h1>
    </div>
    <nav class="navbar navbar-expand-lg ">

        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item me-3">
                        <a class="nav-link color-green <?= explode('/', $_SERVER['REQUEST_URI'])[count(explode('/', $_SERVER['REQUEST_URI'])) - 1] == 'index.php' ? 'active' : '' ?>"
                            aria-current="page" href="{{route('home')}}">Accueil</a>
                    </li>
                    @foreach ($categories as $item)

                        <li class="nav-item me-3 dropdown">
                            <a class="nav-link color-green dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <?= $item->title ?>
                            </a>
                            <ul class="dropdown-menu bg-green " aria-labelledby="navbarDropdown">
                                @foreach ($item['childrens'] as $key => $item)
                                    <li>
                                        <a class="dropdown-item "
                                            href="{{ route('category.show', ['category' => $item, 'slug' => Str::slug($item->title)]) }}">
                                            {{ $item->title }}
                                        </a>
                                    </li>
                                    {{-- @if ($key < count($item['childrens'] - 1))
                                        <li class="separator"></li>

                                    @endif --}}
                                @endforeach

                            </ul>
                        </li>
                    @endforeach
                    <li class="nav-item me-3 ">
                        <a class="nav-link color-green <?= explode('/', $_SERVER['REQUEST_URI'])[count(explode('/', $_SERVER['REQUEST_URI'])) - 1] == 'contact.php' ? 'active' : '' ?>"
                            href="{{route('contact.get')}}">Contact</a>
                    </li>
                </ul>
                <form id="search" action="{{route('search.post')}}" class="d-flex" method="POST">
                    @csrf
                    <input class="form-control me-2 bordered-green" type="text" placeholder="" autocomplete="off"
                        name="q" id="SearchInput" data-value="">
                    <button class="btn btn-outline-success" type="submit"><img src="{{asset('img/search.svg')}}"
                            class="img-fluid h-100" /></button>
                    <div id="searchResults">

                    </div>
                </form>
                <div class="basket me-2">
                    <a href="{{route('basket.index')}}" class="btn btn-primary">
                        <i class="fas fa-shopping-cart"></i>
                        @if ($cart)
                            @if ($cart['items'])
                                @if (count($cart['items']))
                                    <span class="badge badge-success">{{$totalProducts}}</span>
                                @endif
                            @endif
                        @endif
                    </a>
                </div>
                <div class="basket me-2">
                    <ul class="navbar-nav">
                        <li class="nav-item me-2 dropdown">
                            <a class="dropdown-toggle btn btn-success" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                @auth
                                    <li class="dropdown-item">
                                        <a href="{{route('dashboard')}}" class="nav-link">
                                            Connecté en tant que : {{Auth::user()->name}}
                                        </a>
                                    </li>
                                    <li class="dropdown-item">
                                        <form action="{{route('logout')}}" method="POST" class="w-100">
                                            @csrf
                                            <input type="submit" class="nav-link btn btn-block w-100" value="Déconnexion">
                                        </form>
                                    </li>
                                @else
                                    <li class="dropdown-item">
                                        <a href="{{route('login')}}" class="nav-link">Connexion</a>
                                    </li>
                                    <li class="dropdown-item">
                                        <a href="{{route('register')}}" class="nav-link">Inscription</a>
                                    </li>
                                @endauth
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>
