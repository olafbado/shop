@extends('admin.layout')

@section('content')
<div class="container mt-4">
    <h2>Order #{{ $order->id }}</h2>
    <div class="mb-3">
        <strong>User:</strong> {{ $order->user->name ?? '-' }}<br>
        <strong>Status:</strong> {{ ucfirst($order->status) }}<br>
        <strong>Created At:</strong> {{ $order->created_at }}
    </div>
    <h4>Products</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Quantity</th>
                <th>Price at Order</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->pivot->quantity }}</td>
                <td>{{ $product->pivot->price_at_order }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Back to Orders</a>
</div>
@endsection
