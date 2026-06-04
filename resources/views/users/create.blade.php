@extends('layouts.app')

@section('content')

<div class="card shadow">

    <div class="card-header bg-primary text-white">
        Ajouter un utilisateur
    </div>

    <div class="card-body">

        <form action="/users" method="POST">

            @csrf

            <div class="mb-3">
                <label>Nom</label>
                <input type="text"
                       name="name"
                       class="form-control"
                       required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email"
                       name="email"
                       class="form-control"
                       required>
            </div>

            <div class="mb-3">
                <label>Mot de passe</label>
                <input type="password"
                       name="password"
                       class="form-control"
                       required>
            </div>

            <div class="mb-3">
                <label>Rôle</label>

                <select name="role"
                        class="form-control">

                    <option value="admin">
                        Administrateur
                    </option>

                    <option value="receptionniste">
                        Réceptionniste
                    </option>

                </select>
            </div>

            <button type="submit"
                    class="btn btn-success">

                Enregistrer

            </button>

        </form>

    </div>

</div>

@endsection