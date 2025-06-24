@extends('admin.layout')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-12">
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body text-center">
                    <h2 class="card-title mb-3">Witaj w panelu administratora!</h2>
                    <p class="lead">Zarządzaj użytkownikami, produktami, kategoriami, zamówieniami i opiniami. Wszystko w jednym miejscu, z pełną kontrolą i wygodą.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-md-5 g-4 mb-4">
        <div class="col">
            <div class="card text-bg-primary h-100 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-people display-5 mb-2"></i>
                    <h5 class="card-title">Użytkownicy</h5>
                    <div class="display-6 fw-bold">{{ \App\Models\User::count() }}</div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-bg-success h-100 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-box-seam display-5 mb-2"></i>
                    <h5 class="card-title">Produkty</h5>
                    <div class="display-6 fw-bold">{{ \App\Models\Product::count() }}</div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-bg-warning h-100 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-receipt display-5 mb-2"></i>
                    <h5 class="card-title">Zamówienia</h5>
                    <div class="display-6 fw-bold">{{ \App\Models\Order::count() }}</div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-bg-info h-100 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-tags display-5 mb-2"></i>
                    <h5 class="card-title">Kategorie</h5>
                    <div class="display-6 fw-bold">{{ \App\Models\Category::count() }}</div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-bg-secondary h-100 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-chat-left-text display-5 mb-2"></i>
                    <h5 class="card-title">Opinie</h5>
                    <div class="display-6 fw-bold">{{ \App\Models\Review::count() }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mb-4">
        <div class="col-12 col-md-10 col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h2 class="card-title mb-3">Witaj w panelu administratora!</h2>
                    <p class="lead">Zarządzaj użytkownikami, produktami, kategoriami, zamówieniami i opiniami. Wszystko w jednym miejscu, z pełną kontrolą i wygodą.</p>
                    <hr>
                    <div class="row">
                        <div class="col-md-6 text-start">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><i class="bi bi-people me-2"></i> Zarządzanie użytkownikami</li>
                                <li class="list-group-item"><i class="bi bi-box-seam me-2"></i> Zarządzanie produktami</li>
                                <li class="list-group-item"><i class="bi bi-tags me-2"></i> Zarządzanie kategoriami</li>
                            </ul>
                        </div>
                        <div class="col-md-6 text-start">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><i class="bi bi-receipt me-2"></i> Przegląd zamówień</li>
                                <li class="list-group-item"><i class="bi bi-chat-left-text me-2"></i> Moderacja opinii</li>
                                <li class="list-group-item"><i class="bi bi-bar-chart me-2"></i> Statystyki sklepu</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
