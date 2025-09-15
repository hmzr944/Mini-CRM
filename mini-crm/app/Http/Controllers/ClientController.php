<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Client;

class ClientController extends Controller
{
    public function index()
    {
        return Inertia::render('Clients', [
            'clients' => Client::latest()->get()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email',
            'phone' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:255',
        ]);

        $client = Client::create($validated);

        if ($request->expectsJson()) {
            return response()->json($client);
        }

        return redirect()->back()->with('success', 'Client ajouté avec succès !');
    }

    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email,' . $client->id,
            'phone' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:255',
        ]);

        $client->update($validated);

        return response()->json($client);
    }

    public function destroy(Request $request, Client $client)
    {
        $client->delete();

        if ($request->expectsJson()) {
            return response()->json(['message' => 'deleted']);
        }

        return redirect()->back()->with('success', 'Client supprimé avec succès !');
    }
}
