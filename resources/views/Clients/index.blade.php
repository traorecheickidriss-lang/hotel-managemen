<!DOCTYPE html>
<html>

<head>

    <title>Clients</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
          rel="stylesheet">

</head>

<body>

@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between mb-3">

    <h2> Gestion des Clients</h2>

    <a href="/clients/create"
       class="btn btn-primary">

              Ajouter client

    </a>
</div>
<form method="GET"
      action="/clients"
      class="mb-3">

    <div class="input-group">

        <input type="text"
               name="recherche"
               class="form-control"
               placeholder="Rechercher un client..."
               value="{{ $recherche ?? '' }}">

        <button class="btn btn-primary">
            🔍 Rechercher
        </button>

    </div>

</form>
    <table class="table table-striped table-hover shadow">

    <thead class="table-dark">

        

            <tr>

                <th>ID</th>
                <th>Nom</th>
                <th>Téléphone</th>
                <th>Email</th>
                 <th>Action</th>

            </tr>

        </thead>

        <tbody>

            @foreach($clients as $client)

            <tr>

                <td>{{ $client->id }}</td>
                <td>{{ $client->nom }}</td>
                <td>{{ $client->telephone }}</td>
                <td>{{ $client->email }}</td>
                
<td>
    <a href="{{ route('clients.edit', $client->id) }}"
       class="btn btn-warning btn-sm">
       Modifier
    </a>
    <form action="{{ route('clients.destroy', $client->id) }}"
      method="POST"
      style="display:inline">

    @csrf
    @method('DELETE')

    <button type="submit"
            class="btn btn-danger btn-sm">
        Supprimer
    </button>
</form>
</td>
            </tr>

            @endforeach

        </tbody>

    </table>
@endsection
</div>

</body>

</html>