<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ClientCartController extends Controller
{
    public function index(Request $request)
    {
        $cart = session('cart', []);
        $products = Product::whereIn('id', array_keys($cart))->get();
        return view('client.cart.index', compact('products', 'cart'));
    }

    public function add(Request $request, $productId)
    {
        $cart = session('cart', []);
        $cart[$productId] = ($cart[$productId] ?? 0) + 1;
        session(['cart' => $cart]);
        return redirect()->route('client.cart.index')->with('success', 'Produkt dodany do koszyka.');
    }

    public function remove(Request $request, $productId)
    {
        $cart = session('cart', []);
        unset($cart[$productId]);
        session(['cart' => $cart]);
        return redirect()->route('client.cart.index')->with('success', 'Produkt usunięty z koszyka.');
    }

    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('client.cart.index')->with('success', 'Koszyk wyczyszczony.');
    }
}
