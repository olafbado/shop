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
    <h2>Twoje adresy</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <a href="{{ route('client.addresses.create') }}" class="btn btn-success mb-3">Dodaj adres</a>
    @if($addresses->isEmpty())
        <div class="alert alert-info">Brak zapisanych adresów.</div>
    @else
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Ulica</th>
                <th>Miasto</th>
                <th>Kod pocztowy</th>
                <th>Kraj</th>
                <th>Akcje</th>
            </tr>
        </thead>
        <tbody>
            @foreach($addresses as $address)
            <tr>
                <td>{{ $address->street }}</td>
                <td>{{ $address->city }}</td>
                <td>{{ $address->postal_code }}</td>
                <td>{{ $address->country }}</td>
                <td>
                    <a href="{{ route('client.addresses.edit', $address) }}" class="btn btn-warning btn-sm">Edytuj</a>
                    <form action="{{ route('client.addresses.destroy', $address) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Usuń</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection
