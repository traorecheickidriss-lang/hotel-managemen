<!DOCTYPE html>
<html>
<head>
    <title>Gestion des chambres</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between mb-3">

    <h2>Gestion des chambres</h2>

    <a href="/chambres/create"
       class="btn btn-primary">

        + Ajouter une chambre

    </a>

</div>
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
<form method="GET"
      action="/chambres"
      class="mb-3">

    <div class="input-group">

        <input type="text"
               name="recherche"
               class="form-control"
               placeholder="Rechercher une chambre..."
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
            <th>Numéro</th>
            <th>Type</th>
            <th>Prix</th>
            <th>Statut</th>
            <th>Actions</th>

        </tr>

    </thead>

    <tbody>

        @foreach($chambres as $chambre)

        <tr>

            <td>{{ $chambre->id }}</td>
            <td>{{ $chambre->numero }}</td>
            <td>{{ $chambre->type }}</td>
            <td>{{ $chambre->prix }} FCFA</td>

           <td>
    @if($chambre->statut == 'Disponible')
        <span class="badge bg-success">Disponible</span>
    @else
        <span class="badge bg-danger">Occupée</span>
    @endif
</td>

            <td>

                <a href="/chambres/{{ $chambre->id }}/edit"
                   class="btn btn-warning btn-sm">

                    Modifier

                </a>
               
                <form action="/chambres/{{ $chambre->id }}"
      method="POST"
      style="display:inline-block;">

    @csrf
    @method('DELETE')

    <button type="submit"
            class="btn btn-danger btn-sm"
            onclick="return confirm('Archiver cette chambre ?')">

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
