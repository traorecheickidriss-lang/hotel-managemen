@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <h2>📅 Gestion des réservations</h2>

    <a href="/reservations/create"
       class="btn btn-primary">

        + Nouvelle réservation

    </a>

</div>

<form method="GET"
      action="/reservations"
      class="mb-3">

    <div class="input-group">

        <input type="text"
               name="recherche"
               class="form-control"
               placeholder="Rechercher un client..."
               value="{{ $recherche ?? '' }}">

        <button class="btn btn-primary">
            🔍 Rechercher
        </button>

    </div>

</form>

<div class="card shadow">

    <div class="card-body">

        <table class="table table-striped table-hover">

            <thead class="table-dark">

                <tr>

                    <th>ID</th>
                    <th>Client</th>
                    <th>Chambre</th>
                    <th>Arrivée</th>
                    <th>Départ</th>
                    <th>Statut</th>
                    <th>Réservée le</th>
                    <th>Actions</th>

                </tr>

            </thead>

            <tbody>

                @foreach($reservations as $reservation)

                <tr>

                    <td>{{ $reservation->id }}</td>

                    <td>
                        {{ optional($reservation->client)->nom ?? 'Client introuvable' }}
                    </td>

                    <td>
                        {{ optional($reservation->chambre)->numero ?? 'Chambre introuvable' }}
                    </td>

                    <td>{{ $reservation->date_arrivee }}</td>

                    <td>{{ $reservation->date_depart }}</td>
                    

                    <td>

                        @if($reservation->statut == 'Confirmée')

                            <span class="badge bg-primary">
                                Confirmée
                            </span>

                        @elseif($reservation->statut == 'En cours')

                            <span class="badge bg-warning">
                                En cours
                            </span>

                        @elseif($reservation->statut == 'Terminée')

                            <span class="badge bg-success">
                                Terminée
                            </span>

                        @else

                            <span class="badge bg-secondary">
                                {{ $reservation->statut }}
                            </span>

                        @endif

                    </td>
<td>
    {{ \Carbon\Carbon::parse($reservation->date_reservation)->format('d/m/Y H:i') }}
</td>
                    <td>

                        <a href="/reservations/{{ $reservation->id }}/edit"
                           class="btn btn-warning btn-sm">
                            Modifier
                        </a>

                        <form action="/reservations/{{ $reservation->id }}"
                              method="POST"
                              style="display:inline">

                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger btn-sm">
                                Supprimer
                            </button>

                        </form>

                        <form action="{{ route('factures.generer', $reservation->id) }}"
                              method="POST"
                              style="display:inline">

                            @csrf

                            <button class="btn btn-info btn-sm">
                                📄 Facture
                            </button>

                        </form>

                        @if($reservation->statut == 'Confirmée')

                        <form action="/reservations/{{ $reservation->id }}/checkin"
                              method="POST"
                              style="display:inline">

                            @csrf

                            <button class="btn btn-success btn-sm">
                                Check-in
                            </button>

                        </form>

                        @endif

                        @if($reservation->statut == 'En cours')

                        <form action="/reservations/{{ $reservation->id }}/checkout"
                              method="POST"
                              style="display:inline">

                            @csrf

                            <button class="btn btn-dark btn-sm">
                                Check-out
                            </button>

                        </form>

                        @endif

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

@endsection