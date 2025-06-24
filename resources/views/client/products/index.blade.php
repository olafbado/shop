@extends('layouts.app')

@section('content')
<div class="container py-4">
    <nav class="navbar navbar-expand-lg navbar-light bg-white rounded shadow-sm mb-4 px-3">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="#"><i class="bi bi-person-circle me-2"></i>Panel klienta</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#clientNavbar" aria-controls="clientNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="clientNavbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link @if(request()->routeIs('client.panel')) active @endif" href="{{ route('client.panel') }}"><i class="bi bi-house-door"></i> Start</a></li>
                    <li class="nav-item"><a class="nav-link @if(request()->routeIs('client.products.*')) active @endif" href="{{ route('client.products.index') }}"><i class="bi bi-box-seam"></i> Produkty</a></li>
                    <li class="nav-item"><a class="nav-link @if(request()->routeIs('client.cart.*')) active @endif" href="{{ route('client.cart.index') }}"><i class="bi bi-cart"></i> Koszyk</a></li>
                    <li class="nav-item"><a class="nav-link @if(request()->routeIs('client.orders.*')) active @endif" href="{{ route('client.orders.index') }}"><i class="bi bi-receipt"></i> Zamówienia</a></li>
                    <li class="nav-item"><a class="nav-link @if(request()->routeIs('client.profile.*')) active @endif" href="{{ route('client.profile.edit') }}"><i class="bi bi-person"></i> Profil</a></li>
                    <li class="nav-item"><a class="nav-link @if(request()->routeIs('client.addresses.*')) active @endif" href="{{ route('client.addresses.index') }}"><i class="bi bi-geo-alt"></i> Adresy</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <h2>Produkty</h2>
    <form method="GET" class="row g-2 mb-4">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Szukaj po nazwie" value="{{ request('search') }}">
        </div>
        <div class="col-md-3">
            <select name="category" class="form-control">
                <option value="">Wszystkie kategorie</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @if(request('category')==$category->id) selected @endif>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <select name="available" class="form-control">
                <option value="">Wszystko</option>
                <option value="1" @if(request('available')==='1') selected @endif>Dostępne</option>
                <option value="0" @if(request('available')==='0') selected @endif>Niedostępne</option>
            </select>
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary w-100">Filtruj</button>
        </div>
    </form>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @forelse($products as $product)
            <div class="col">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">
                            @foreach($product->categories as $cat)
                                <span class="badge bg-info">{{ $cat->name }}</span>
                            @endforeach
                        </h6>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="card-text"><strong>Cena:</strong> {{ number_format($product->price, 2) }} zł</p>
                        <p class="card-text">
                            <span class="badge {{ $product->stock > 0 ? 'bg-success' : 'bg-danger' }}">
                                {{ $product->stock > 0 ? 'Dostępny' : 'Niedostępny' }}
                            </span>
                        </p>
                        @if($product->stock > 0)
                        <form method="POST" action="{{ route('client.cart.add', $product->id) }}">
                            @csrf
                            <button class="btn btn-primary w-100"><i class="bi bi-cart-plus"></i> Dodaj do koszyka</button>
                        </form>
                        @else
                        <button class="btn btn-secondary w-100" disabled><i class="bi bi-cart-x"></i> Niedostępny</button>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning">Brak produktów spełniających kryteria.</div>
            </div>
        @endforelse
    </div>
    <div class="mt-4">
        {{ $products->withQueryString()->links() }}
    </div>
</div>
@endsection
