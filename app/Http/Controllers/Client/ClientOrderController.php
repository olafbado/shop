<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientOrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()->with('products')->latest()->get();
        return view('client.orders.index', compact('orders'));
    }

    public function store(Request $request)
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->route('client.cart.index')->with('error', 'Koszyk jest pusty.');
        }
        DB::beginTransaction();
        try {
            $order = auth()->user()->orders()->create(['status' => 'pending']);
            foreach ($cart as $productId => $qty) {
                $product = Product::find($productId);
                if ($product && $product->stock >= $qty) {
                    $order->products()->attach($productId, [
                        'quantity' => $qty,
                        'price_at_order' => $product->price,
                    ]);
                    $product->decrement('stock', $qty);
                }
            }
            DB::commit();
            session()->forget('cart');
            return redirect()->route('client.orders.index')->with('success', 'Zamówienie złożone!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('client.cart.index')->with('error', 'Błąd podczas składania zamówienia.');
        }
    }
}
