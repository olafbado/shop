<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;

class ClientAddressController extends Controller
{
    public function index()
    {
        $addresses = auth()->user()->addresses ?? collect();
        return view('client.addresses.index', compact('addresses'));
    }

    public function create()
    {
        return view('client.addresses.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'country' => 'required|string|max:100',
        ]);
        auth()->user()->addresses()->create($data);
        return redirect()->route('client.addresses.index')->with('success', 'Adres dodany.');
    }

    public function edit(Address $address)
    {
        $this->authorize('update', $address);
        return view('client.addresses.edit', compact('address'));
    }

    public function update(Request $request, Address $address)
    {
        $this->authorize('update', $address);
        $data = $request->validate([
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'country' => 'required|string|max:100',
        ]);
        $address->update($data);
        return redirect()->route('client.addresses.index')->with('success', 'Adres zaktualizowany.');
    }

    public function destroy(Address $address)
    {
        $this->authorize('delete', $address);
        $address->delete();
        return redirect()->route('client.addresses.index')->with('success', 'Adres usunięty.');
    }
}
