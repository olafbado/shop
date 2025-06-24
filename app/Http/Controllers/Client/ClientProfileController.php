<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientProfileController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        return view('client.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);
        $user->update($data);
        return redirect()->route('client.profile.edit')->with('success', 'Dane zostały zaktualizowane.');
    }
}
