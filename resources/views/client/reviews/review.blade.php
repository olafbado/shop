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
    <div class="container mt-4">
        <h2>Wystaw opinię o produkcie: {{ $product->name }}</h2>
        <form method="POST" action="{{ route('client.reviews.store', $product) }}">
            @csrf
            <div class="mb-3">
                <label for="rating" class="form-label">Ocena (1-5)</label>
                <select class="form-control" id="rating" name="rating" required>
                    <option value="">Wybierz ocenę</option>
                    @for($i=1; $i<=5; $i++)
                        <option value="{{ $i }}" @if(old('rating')==$i) selected @endif>{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="mb-3">
                <label for="comment" class="form-label">Komentarz</label>
                <textarea class="form-control" id="comment" name="comment" rows="4" required>{{ old('comment') }}</textarea>
            </div>
            <button type="submit" class="btn btn-success">Wyślij opinię</button>
        </form>
    </div>
</div>
@endsection
