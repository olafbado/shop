<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ClientProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query()->where('active', true);
        if ($request->filled('search')) {
            $query->where('name', 'like', "%{$request->search}%");
        }
        if ($request->filled('category')) {
            $query->whereHas('categories', function($q) use ($request) {
                $q->where('categories.id', $request->category);
            });
        }
        if ($request->filled('available')) {
            if ($request->available === '1') {
                $query->where('stock', '>', 0);
            } elseif ($request->available === '0') {
                $query->where('stock', '<=', 0);
            }
        }
        $products = $query->with('categories')->paginate(12);
        $categories = Category::all();
        return view('client.products.index', compact('products', 'categories'));
    }
}
