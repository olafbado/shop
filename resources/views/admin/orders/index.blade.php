@extends('admin.layout')

@section('content')
<div class="container mt-4">
    <h2>Orders Management</h2>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->user->name ?? '-' }}</td>
                <td>{{ ucfirst($order->status) }}</td>
                <td>{{ $order->created_at }}</td>
                <td><a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-info">View</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $orders->links() }}
</div>
@endsection
