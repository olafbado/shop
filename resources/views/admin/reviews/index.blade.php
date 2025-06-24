@extends('admin.layout')

@section('content')
<div class="container mt-4">
    <h2>Reviews Moderation</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>User</th>
                <th>Product</th>
                <th>Rating</th>
                <th>Comment</th>
                <th>Hidden</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reviews as $review)
            <tr>
                <td>{{ $review->user->name ?? '-' }}</td>
                <td>{{ $review->product->name ?? '-' }}</td>
                <td>{{ $review->rating }}</td>
                <td>{{ $review->comment }}</td>
                <td>{{ $review->hidden ? 'Yes' : 'No' }}</td>
                <td>
                    <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                    <form action="{{ route('admin.reviews.toggle', $review) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-sm {{ $review->hidden ? 'btn-success' : 'btn-warning' }}">
                            {{ $review->hidden ? 'Show' : 'Hide' }}
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $reviews->links() }}
</div>
@endsection
