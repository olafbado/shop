@extends('admin.layout')

@section('content')
<div class="container mt-4">
    <h2>Edit User</h2>
    <form method="POST" action="{{ route('admin.users.update', $user) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Name</label>
            <input type="text" class="form-control" value="{{ $user->name }}" disabled>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" class="form-control" value="{{ $user->email }}" disabled>
        </div>
        <div class="mb-3">
            <label>Role</label>
            <select name="role" class="form-control">
                <option value="admin" @if($user->role=='admin') selected @endif>Admin</option>
                <option value="client" @if($user->role=='client') selected @endif>Client</option>
            </select>
            @error('role') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label>Active</label>
            <select name="active" class="form-control">
                <option value="1" @if($user->active) selected @endif>Yes</option>
                <option value="0" @if(!$user->active) selected @endif>No</option>
            </select>
            @error('active') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <button class="btn btn-primary">Update</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
