<?php

namespace App\Http\Controllers;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
 public function index(Request $request)
{
    $recherche = $request->recherche;

    $clients = Client::where(
        'nom',
        'like',
        '%' . $recherche . '%'
    )->get();

    return view(
        'clients.index',
        compact(
            'clients',
            'recherche'
        )
    );
}

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
{
    Client::create([

        'nom' => $request->nom,

        'telephone' => $request->telephone,

        'email' => $request->email

    ]);

    return redirect('/clients');
}

    public function show(Client $client)
    {
        return view('clients.show', compact('client'));
    }

    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

   public function update(Request $request, Client $client)
{
    $client->update([
        'nom' => $request->nom,
        'telephone' => $request->telephone,
        'email' => $request->email,
    ]);

    return redirect()->route('clients.index');
}
    public function destroy($id)
{
    $client = Client::findOrFail($id);

    $client->update([
        'statut' => 'Archivé'
    ]);

    return redirect('/clients')
        ->with(
            'success',
            'Client archivé avec succès.'
        );
}
}