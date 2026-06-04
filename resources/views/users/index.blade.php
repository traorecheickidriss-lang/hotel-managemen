@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between mb-3">

    <h2>👥 Gestion des utilisateurs</h2>

    <a href="/users/create"
       class="btn btn-primary">

        + Ajouter un utilisateur

    </a>

</div>

<table class="table table-striped table-hover">

    <thead class="table-dark">

        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Rôle</th>
            <th>Actions</th>
            
        </tr>
    </thead>

    <tbody>

        @foreach($users as $user)

        <tr>

            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role }}</td>
<td>

    <a href="/users/{{ $user->id }}/edit"
       class="btn btn-warning btn-sm">

        Modifier

    </a>

    <form action="/users/{{ $user->id }}"
          method="POST"
          style="display:inline">

        @csrf
        @method('DELETE')

        <button class="btn btn-danger btn-sm">

            Supprimer

        </button>

    </form>

</td>
        </tr>

        @endforeach

    </tbody>

</table>

@endsection