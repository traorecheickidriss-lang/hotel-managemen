@extends('layouts.app')

@section('content')

<div class="text-center mb-4">
    <h2 class="fw-bold text-primary">
        👥 Gestion des Clients
    </h2>
    <p class="text-muted">
        Ajouter un nouveau client
    </p>
</div>

<div class="row justify-content-center">

    <div class="col-lg-6">

        <div class="card shadow border-0">

            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">
                    ➕ Ajouter un client
                </h4>
            </div>

            <div class="card-body p-4">

                <form action="/clients" method="POST">

                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            👤 Nom
                        </label>

                        <input type="text"
                               name="nom"
                               class="form-control"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            📞 Téléphone
                        </label>

                        <input type="text"
                               name="telephone"
                               class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">
                            📧 Email
                        </label>

                        <input type="email"
                               name="email"
                               class="form-control">
                    </div>

                    <div class="d-flex justify-content-between">

                        <a href="/clients"
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