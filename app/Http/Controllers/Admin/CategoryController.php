<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('products')->paginate(10);
        $allProducts = Product::all();
        
        // Add unassigned products to each category
        foreach ($categories as $category) {
            $assignedProductIds = $category->products->pluck('id')->toArray();
            $category->unassignedProducts = $allProducts->whereNotIn('id', $assignedProductIds);
        }
        
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:categories,name',
        ]);
        Category::create($data);
        return redirect()->route('admin.categories.index')->with('success', 'Category created.');
    }

    public function assignProduct(Request $request, Category $category)
    {
        $request->validate(['product_id' => 'required|exists:products,id']);
        
        // Check if product is already assigned
        if ($category->products()->where('product_id', $request->product_id)->exists()) {
            return back()->with('error', 'Product is already assigned to this category.');
        }
        
        $category->products()->attach($request->product_id);
        return back()->with('success', 'Product assigned to category.');
    }

    public function unassignProduct(Request $request, Category $category)
    {
        $request->validate(['product_id' => 'required|exists:products,id']);
        
        // Check if product is actually assigned
        if (!$category->products()->where('product_id', $request->product_id)->exists()) {
            return back()->with('error', 'Product is not assigned to this category.');
        }
        
        $category->products()->detach($request->product_id);
        return back()->with('success', 'Product unassigned from category.');
    }
}
