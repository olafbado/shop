<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ClientReviewController extends Controller
{
    public function create($productId)
    {
        $product = Product::findOrFail($productId);
        $user = auth()->user();
        // Sprawdź, czy klient kupił ten produkt
        $hasBought = $user->orders()->whereHas('products', function($q) use ($productId) {
            $q->where('products.id', $productId);
        })->exists();
        if (!$hasBought) {
            abort(403, 'Możesz ocenić tylko zakupione produkty.');
        }
        // Sprawdź, czy już wystawił opinię
        $alreadyReviewed = Review::where('user_id', $user->id)->where('product_id', $productId)->exists();
        if ($alreadyReviewed) {
            return redirect()->route('client.products.index')->with('error', 'Już wystawiłeś opinię dla tego produktu.');
        }
        return view('client.reviews.review', compact('product'));
    }

    public function store(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);
        $user = auth()->user();
        // Sprawdź, czy klient kupił ten produkt
        $hasBought = $user->orders()->whereHas('products', function($q) use ($productId) {
            $q->where('products.id', $productId);
        })->exists();
        if (!$hasBought) {
            abort(403, 'Możesz ocenić tylko zakupione produkty.');
        }
        // Sprawdź, czy już wystawił opinię
        $alreadyReviewed = Review::where('user_id', $user->id)->where('product_id', $productId)->exists();
        if ($alreadyReviewed) {
            return redirect()->route('client.products.index')->with('error', 'Już wystawiłeś opinię dla tego produktu.');
        }
        $data = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);
        $data['user_id'] = $user->id;
        $data['product_id'] = $productId;
        Review::create($data);
        return redirect()->route('client.products.index')->with('success', 'Opinia została dodana!');
    }
}
