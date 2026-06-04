@extends('layouts.app')

@section('content')

<div class="row justify-content-center">

    <div class="col-lg-7 col-md-8">

        <div class="card shadow border-0">
<div class="card-header bg-warning">
    <h4 class="mb-0 text-dark fw-bold">
        ✏️ Modifier les informations du client
    </h4>
</div>

            <div class="card-body">

                <form action="/clients/{{ $client->id }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">👤 Nom</label>
                        <input type="text"
                               name="nom"
                               value="{{ $client->nom }}"
                               class="form-control"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">📞 Téléphone</label>
                        <input type="text"
                               name="telephone"
                               value="{{ $client->telephone }}"
                               class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">📧 Email</label>
                        <input type="email"
                               name="email"
                               value="{{ $client->email }}"
                               class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">📍 Adresse</label>
                        <textarea name="adresse"
                                  class="form-control"
                                  rows="3">{{ $client->adresse }}</textarea>
                    </div>

                    <div class="d-flex justify-content-between">

                       <a href="/clients"
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

@endsection