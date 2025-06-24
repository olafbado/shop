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
    <h2>Twoje zamówienia</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($orders->isEmpty())
        <div class="alert alert-info">Nie złożyłeś jeszcze żadnych zamówień.</div>
    @else
    <div class="accordion" id="ordersAccordion">
        @foreach($orders as $order)
        <div class="accordion-item">
            <h2 class="accordion-header" id="heading{{ $order->id }}">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $order->id }}" aria-expanded="false" aria-controls="collapse{{ $order->id }}">
                    Zamówienie #{{ $order->id }} | Status: {{ $order->status }} | Data: {{ $order->created_at->format('Y-m-d H:i') }}
                </button>
            </h2>
            <div id="collapse{{ $order->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $order->id }}" data-bs-parent="#ordersAccordion">
                <div class="accordion-body">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Produkt</th>
                                <th>Ilość</th>
                                <th>Cena jednostkowa</th>
                                <th>Suma</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->products as $product)
    <tr>
        <td>{{ $product->name }}
            @php
                $alreadyReviewed = \App\Models\Review::where('user_id', auth()->id())->where('product_id', $product->id)->exists();
            @endphp
            @if(!$alreadyReviewed)
                <a href="{{ route('client.reviews.create', $product) }}" class="btn btn-sm btn-outline-success ms-2">Wystaw opinię</a>
            @else
                <span class="badge bg-secondary ms-2">Opinia wystawiona</span>
            @endif
        </td>
        <td>{{ $product->pivot->quantity }}</td>
        <td>{{ number_format($product->pivot->price_at_order, 2) }} zł</td>
        <td>{{ number_format($product->pivot->price_at_order * $product->pivot->quantity, 2) }} zł</td>
    </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection
