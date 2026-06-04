@extends('layouts.app')

@section('content')

<div class="card shadow">

    <div class="card-header bg-warning">
        Modifier un utilisateur
    </div>

    <div class="card-body">

        <form action="/users/{{ $user->id }}" method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Nom</label>
                <input type="text"
                       name="name"
                       value="{{ $user->name }}"
                       class="form-control">
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email"
                       name="email"
                       value="{{ $user->email }}"
                       class="form-control">
            </div>
<div class="mb-3">
    <label>Nouveau mot de passe</label>

    <input type="password"
           name="password"
           class="form-control">

    <small class="text-muted">
        Laisser vide pour conserver le mot de passe actuel.
    </small>
</div>
            <div class="mb-3">
                <label>Rôle</label>

                <select name="role" class="form-control">

                    <option value="admin"
                        {{ $user->role == 'admin' ? 'selected' : '' }}>
                        Administrateur
                    </option>

                    <option value="receptionniste"
                        {{ $user->role == 'receptionniste' ? 'selected' : '' }}>
                        Réceptionniste
                    </option>

                </select>

            </div>

            <button type="submit"
                    class="btn btn-success">

                Mettre à jour

            </button>

        </form>

    </div>

</div>

@endsection