<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();
        if ($search = $request->input('search')) {
            $query->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%") ;
        }
        $users = $query->paginate(10);
        return view('admin.users.index', compact('users', 'search'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:admin,client',
            'active' => 'required|boolean',
        ]);
        $user->role = $request->role;
        $user->active = $request->active;
        $user->save();
        return redirect()->route('admin.users.index')->with('success', 'User updated.');
    }

    public function toggleActive(User $user)
    {
        $user->active = !$user->active;
        $user->save();
        return back()->with('success', 'User status updated.');
    }
}
