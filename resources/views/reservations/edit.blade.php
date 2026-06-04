@extends('layouts.app')

@section('content')

<div class="card shadow">

    <div class="card-header bg-warning">
        Modifier une réservation
    </div>

    <div class="card-body">

        <form action="/reservations/{{ $reservation->id }}" method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Client</label>

                <select name="client_id" class="form-control">

                    @foreach($clients as $client)

                    <option value="{{ $client->id }}"
                        {{ $reservation->client_id == $client->id ? 'selected' : '' }}>

                        {{ $client->nom }}

                    </option>

                    @endforeach

                </select>

            </div>

            <div class="mb-3">
                <label>Chambre</label>

                <select name="chambre_id" class="form-control">

                    @foreach($chambres as $chambre)

                    <option value="{{ $chambre->id }}"
                        {{ $reservation->chambre_id == $chambre->id ? 'selected' : '' }}>

                        {{ $chambre->numero_chambre }}

                    </option>

                    @endforeach

                </select>

            </div>

            <div class="mb-3">
                <label>Date d'arrivée</label>

                <input type="date"
                       name="date_arrivee"
                       value="{{ $reservation->date_arrivee }}"
                       class="form-control">
            </div>

            <div class="mb-3">
                <label>Date de départ</label>

                <input type="date"
                       name="date_depart"
                       value="{{ $reservation->date_depart }}"
                       class="form-control">
            </div>

            <div class="mb-3">
                <label>Statut</label>

                <input type="text"
                       name="statut"
                       value="{{ $reservation->statut }}"
                       class="form-control">
            </div>

            <button type="submit"
                    class="btn btn-success">

                Mettre à jour

            </button>

        </form>

    </div>

</div>

@endsection