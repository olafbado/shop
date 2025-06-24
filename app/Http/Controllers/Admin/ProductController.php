<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();
        if ($request->filled('search')) {
            $query->where('name', 'like', "%{$request->search}%");
        }
        if ($request->filled('category')) {
            $query->whereHas('categories', function($q) use ($request) {
                $q->where('categories.id', $request->category);
            });
        }
        if ($request->filled('active')) {
            $query->where('active', $request->active);
        }
        $products = $query->with('categories')->paginate(10);
        $categories = Category::all();
        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'active' => 'boolean',
            'categories' => 'array',
            'categories.*' => 'exists:categories,id',
        ]);
        $product = Product::create($data);
        if ($request->has('categories')) {
            $product->categories()->sync($request->categories);
        }
        return redirect()->route('admin.products.index')->with('success', 'Product created.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $product->load('categories');
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'active' => 'boolean',
            'categories' => 'array',
            'categories.*' => 'exists:categories,id',
        ]);
        $product->update($data);
        if ($request->has('categories')) {
            $product->categories()->sync($request->categories);
        }
        return redirect()->route('admin.products.index')->with('success', 'Product updated.');
    }

    public function destroy(Product $product)
    {
        // Instead of deleting, toggle active
        $product->active = false;
        $product->save();
        return back()->with('success', 'Product deactivated.');
    }

    public function toggleActive(Product $product)
    {
        $product->active = !$product->active;
        $product->save();
        return back()->with('success', 'Product status updated.');
    }

    public function filter(Request $request)
    {
        return $this->index($request);
    }
}
