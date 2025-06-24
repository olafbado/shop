@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-12">
            <nav class="navbar navbar-expand-lg navbar-light bg-white rounded shadow-sm mb-3 px-3">
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
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body text-center">
                    <h2 class="card-title mb-3">Witaj w panelu klienta!</h2>
                    <p class="lead">Zarządzaj swoimi zamówieniami, przeglądaj produkty, edytuj dane i adresy, korzystaj z koszyka oraz wystawiaj opinie. Wszystko w jednym miejscu!</p>
                    <div class="row row-cols-2 row-cols-md-4 g-3 mt-4">
                        <div class="col">
                            <a href="{{ route('client.products.index') }}" class="text-decoration-none">
                                <div class="card h-100 border-0 bg-light shadow-sm text-center py-3">
                                    <i class="bi bi-box-seam display-5 text-primary mb-2"></i>
                                    <div class="fw-bold">Produkty</div>
                                </div>
                            </a>
                        </div>
                        <div class="col">
                            <a href="{{ route('client.cart.index') }}" class="text-decoration-none">
                                <div class="card h-100 border-0 bg-light shadow-sm text-center py-3">
                                    <i class="bi bi-cart display-5 text-success mb-2"></i>
                                    <div class="fw-bold">Koszyk</div>
                                </div>
                            </a>
                        </div>
                        <div class="col">
                            <a href="{{ route('client.orders.index') }}" class="text-decoration-none">
                                <div class="card h-100 border-0 bg-light shadow-sm text-center py-3">
                                    <i class="bi bi-receipt display-5 text-warning mb-2"></i>
                                    <div class="fw-bold">Zamówienia</div>
                                </div>
                            </a>
                        </div>
                        <div class="col">
                            <a href="{{ route('client.profile.edit') }}" class="text-decoration-none">
                                <div class="card h-100 border-0 bg-light shadow-sm text-center py-3">
                                    <i class="bi bi-person display-5 text-info mb-2"></i>
                                    <div class="fw-bold">Profil</div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <button class="btn btn-outline-primary mt-4" data-bs-toggle="modal" data-bs-target="#helpModal"><i class="bi bi-question-circle"></i> Jak korzystać z panelu?</button>
                </div>
            </div>
            <!-- Toasty -->
            @if(session('success'))
                <div class="toast align-items-center text-bg-success border-0 show mb-3" role="alert" aria-live="assertive" aria-atomic="true" style="position:relative;z-index:999;">
                    <div class="d-flex">
                        <div class="toast-body">{{ session('success') }}</div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            @endif
            @if(session('error'))
                <div class="toast align-items-center text-bg-danger border-0 show mb-3" role="alert" aria-live="assertive" aria-atomic="true" style="position:relative;z-index:999;">
                    <div class="d-flex">
                        <div class="toast-body">{{ session('error') }}</div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
<!-- Modal Pomocy -->
<div class="modal fade" id="helpModal" tabindex="-1" aria-labelledby="helpModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="helpModalLabel">Jak korzystać z panelu klienta?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Zamknij"></button>
      </div>
      <div class="modal-body text-start">
        <ul class="list-group list-group-flush">
          <li class="list-group-item"><i class="bi bi-box-seam me-2"></i>Przeglądaj i filtruj <b>produkty</b> – dodawaj je do koszyka jednym kliknięciem.</li>
          <li class="list-group-item"><i class="bi bi-cart me-2"></i>Zarządzaj <b>koszykiem</b> i składaj zamówienia online.</li>
          <li class="list-group-item"><i class="bi bi-receipt me-2"></i>Sprawdzaj <b>historię zamówień</b> i szczegóły każdego zakupu.</li>
          <li class="list-group-item"><i class="bi bi-person me-2"></i>Edytuj swoje <b>dane osobowe</b> i <b>adresy dostawy</b>.</li>
          <li class="list-group-item"><i class="bi bi-star me-2"></i>Wystawiaj <b>opinie</b> tylko do zakupionych produktów.</li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
      </div>
    </div>
  </div>
</div>
@endsection
