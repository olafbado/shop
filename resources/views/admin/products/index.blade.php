@extends('admin.layout')

@section('content')
<div class="container mt-4">
    <h2>Products Management</h2>
    <form method="GET" class="mb-3 row g-2">
        <div class="col-md-3">
            <input type="text" name="search" class="form-control" placeholder="Search by name" value="{{ request('search') }}">
        </div>
        <div class="col-md-3">
            <select name="category" class="form-control">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @if(request('category')==$category->id) selected @endif>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <select name="active" class="form-control">
                <option value="">All Status</option>
                <option value="1" @if(request('active')==='1') selected @endif>Active</option>
                <option value="0" @if(request('active')==='0') selected @endif>Inactive</option>
            </select>
        </div>
        <div class="col-md-3">
            <button class="btn btn-primary">Filter</button>
            <a href="{{ route('admin.products.create') }}" class="btn btn-success">Add Product</a>
        </div>
    </form>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Active</th>
                <th>Categories</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->stock }}</td>
                <td>{{ $product->active ? 'Yes' : 'No' }}</td>
                <td>
                    @foreach($product->categories as $cat)
                        <span class="badge bg-info">{{ $cat->name }}</span>
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.products.toggle', $product) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-sm btn-secondary">{{ $product->active ? 'Deactivate' : 'Activate' }}</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $products->links() }}
</div>
@endsection
