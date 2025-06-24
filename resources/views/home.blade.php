@extends('layouts.app')

@php use Illuminate\Support\Str; @endphp

@section('content')
<div class="container py-5">
    <div class="row align-items-center mb-5">
        <div class="col-md-6 text-center text-md-start">
            <h1 class="display-4 fw-bold mb-3">Witamy w nowoczesnym sklepie internetowym!</h1>
            <p class="lead mb-4">Odkryj szeroki wybór produktów, szybkie zakupy, bezpieczne płatności i wygodną obsługę klienta. Zarejestruj się lub zaloguj, by korzystać z pełni możliwości panelu klienta!</p>
                @if(auth()->user() and auth()->user()->role === 'admin')
                    <a href="{{ route('admin.products.index') }}" class="btn btn-primary btn-lg me-2">Przeglądaj produkty</a>
                @else
                    <a href="{{ route('client.products.index') }}" class="btn btn-primary btn-lg me-2">Przeglądaj produkty</a>
                @endif
            @guest
                <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-lg">Zaloguj się</a>
            @endguest
        </div>
        <div class="col-md-6 text-center">
            <img src="https://images.unsplash.com/photo-1515168833906-d2a3b82b1a48?auto=format&fit=crop&w=600&q=80" alt="Sklep online" class="img-fluid rounded shadow">
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-12">
            <h2 class="h4 fw-bold mb-4 text-center">Kategorie</h2>
            <div class="row row-cols-2 row-cols-md-4 g-3">
                @foreach(\App\Models\Category::limit(4)->get() as $category)
                    <div class="col">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ $category->name }}</h5>
                                <a href="{{ route('client.products.index', ['category' => $category->id]) }}" class="stretched-link"></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h2 class="h4 fw-bold mb-4 text-center">Bestsellery</h2>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach(\App\Models\Product::where('active', true)->orderByDesc('stock')->limit(3)->get() as $product)
                    <div class="col">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">{{ \Illuminate\Support\Str::limit($product->description, 80) }}</p>
                                <span class="badge bg-info mb-2">
                                    @foreach($product->categories as $cat)
                                        {{ $cat->name }}@if(!$loop->last), @endif
                                    @endforeach
                                </span>
                                <div class="fw-bold mb-2">{{ number_format($product->price, 2) }} zł</div>
                                <a href="{{ route('client.products.index', ['search' => $product->name]) }}" class="btn btn-outline-primary btn-sm">Zobacz</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
