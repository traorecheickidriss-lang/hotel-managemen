@extends('layouts.app')

@section('content')

<div class="text-center mb-4">
    <h2 class="fw-bold text-primary">
        🛏️ Gestion des Chambres
    </h2>
    <p class="text-muted">
        Ajouter une nouvelle chambre
    </p>
</div>

<div class="row justify-content-center">

    <div class="col-lg-6">

        <div class="card shadow border-0">

            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">
                    ➕ Ajouter une chambre
                </h4>
            </div>

            <div class="card-body p-4">

                <form method="POST" action="/chambres">

                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            🔢 Numéro
                        </label>

                        <input type="text"
                               name="numero"
                               class="form-control"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            🛏️ Type
                        </label>

                        <input type="text"
                               name="type"
                               class="form-control"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            💰 Prix (FCFA)
                        </label>

                        <input type="number"
                               name="prix"
                               class="form-control"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            📌 Statut
                        </label>

                        <select name="statut"
                                class="form-select">
                            <option value="Disponible">Disponible</option>
                            <option value="Occupée">Occupée</option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-between">

                        <a href="/chambres"
                           class="btn btn-outline-secondary">
                            ⬅️ Retour
                        </a>

                        <button class="btn btn-success px-4">
                            💾 Enregistrer
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsectio