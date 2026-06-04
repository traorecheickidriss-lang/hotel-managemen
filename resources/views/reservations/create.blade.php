@extends('layouts.app')

@section('content')

<div class="text-center mb-4">
    <h2 class="fw-bold text-primary">
        📅 Gestion des Réservations
    </h2>
    <p class="text-muted">
        Créer une nouvelle réservation
    </p>
</div>

<div class="row justify-content-center">

    <div class="col-lg-7">

        <div class="card shadow border-0">

            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">
                    ➕ Nouvelle réservation
                </h4>
            </div>

            <div class="card-body p-4">

                <form action="/reservations" method="POST">

                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            👤 Client
                        </label>

                        <select name="client_id"
                                class="form-select">

                            @foreach($clients as $client)

                                <option value="{{ $client->id }}">
                                    {{ $client->nom }}
                                </option>

                            @endforeach

                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            🛏️ Chambre
                        </label>

                        <select name="chambre_id"
                                class="form-select">

                            @foreach($chambres as $chambre)

                                <option value="{{ $chambre->id }}">
                                    Chambre {{ $chambre->numero }}
                                </option>

                            @endforeach

                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            📅 Date d'arrivée
                        </label>

                        <input type="date"
                               name="date_arrivee"
                               class="form-control"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            📅 Date de départ
                        </label>

                        <input type="date"
                               name="date_depart"
                               class="form-control"
                               required>
                    </div>

                    <div class="d-flex justify-content-between">

                        <a href="/reservations"
                           class="btn btn-outline-secondary">
                            ⬅️ Retour
                        </a>

                        <button type="submit"
                                class="btn btn-success px-4">
                            💾 Enregistrer
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection