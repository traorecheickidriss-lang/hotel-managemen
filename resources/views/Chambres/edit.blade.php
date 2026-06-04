@extends('layouts.app')

@section('content')

<div class="text-center mb-4">
    <h2 class="fw-bold text-primary">
        🛏️ Gestion des Chambres
    </h2>
    <p class="text-muted">
        Modifier les informations d'une chambre
    </p>
</div>

<div class="row justify-content-center">

    <div class="col-lg-6">

        <div class="card shadow border-0">

            <div class="card-header bg-warning">
                <h4 class="mb-0 text-dark fw-bold">
                    ✏️ Modifier une chambre
                </h4>
            </div>

            <div class="card-body p-4">

                <form action="/chambres/{{ $chambre->id }}"
                      method="POST">

                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            🔢 Numéro
                        </label>

                        <input type="text"
                               name="numero"
                               value="{{ $chambre->numero }}"
                               class="form-control"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            🛏️ Type
                        </label>

                        <input type="text"
                               name="type"
                               value="{{ $chambre->type }}"
                               class="form-control"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            💰 Prix (FCFA)
                        </label>

                        <input type="number"
                               name="prix"
                               value="{{ $chambre->prix }}"
                               class="form-control"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            📌 Statut
                        </label>

                        <select name="statut" class="form-select">

                            <option value="Disponible"
                                {{ $chambre->statut == 'Disponible' ? 'selected' : '' }}>
                                Disponible
                            </option>

                            <option value="Occupée"
                                {{ $chambre->statut == 'Occupée' ? 'selected' : '' }}>
                                Occupée
                            </option>

                        </select>
                    </div>

                    <div class="d-flex justify-content-between">

                        <a href="/chambres"
                           class="btn btn-outline-secondary">
                            ⬅️ Retour
                        </a>

                        <button type="submit"
                                class="btn btn-success px-4">
                            💾 Mettre à jour
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsecti