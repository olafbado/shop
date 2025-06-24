@extends('admin.layout')

@section('content')
<div class="container mt-4">
    <h2>Categories Management</h2>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-success mb-3">Add Category</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Products</th>
                <th>Assign/Unassign</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $category->name }}</td>
                <td>
                    @foreach($category->products as $product)
                        <span class="badge bg-info">{{ $product->name }}</span>
                    @endforeach
                </td>
                <td>
                    @if($category->unassignedProducts->count() > 0)
                        <form method="POST" action="{{ route('admin.categories.assign', $category) }}" class="d-inline">
                            @csrf
                            <select name="product_id" class="form-select d-inline w-auto">
                                <option value="">Select product...</option>
                                @foreach($category->unassignedProducts as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-sm btn-primary">Assign</button>
                        </form>
                    @else
                        <span class="text-muted">All products assigned</span>
                    @endif
                    
                    @if($category->products->count() > 0)
                        <form method="POST" action="{{ route('admin.categories.unassign', $category) }}" class="d-inline ms-2">
                            @csrf
                            <select name="product_id" class="form-select d-inline w-auto">
                                <option value="">Select product...</option>
                                @foreach($category->products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-sm btn-danger">Unassign</button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $categories->links() }}
</div>
@endsection
