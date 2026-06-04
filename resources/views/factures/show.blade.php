@extends('layouts.app')

@section('content')

<div class="card shadow">

    <div class="card-header bg-primary text-white">
        <h4>📄 Facture N°{{ $facture->id }}</h4>
    </div>

    <div class="card-body">

        <h5>Client</h5>
        <p>{{ $facture->reservation->client->nom }}</p>

        <h5>Chambre</h5>
        <p>
            {{ $facture->reservation->chambre->numero }}
            - {{ $facture->reservation->chambre->type }}
        </p>

        <h5>Séjour</h5>
        <p>
            Du {{ $facture->reservation->date_arrivee }}
            au {{ $facture->reservation->date_depart }}
        </p>

        <h5>Nombre de nuits</h5>
        <p>{{ $facture->nombre_nuits }}</p>

        <h5>Montant total</h5>
        <h3 class="text-success">
            {{ number_format($facture->montant_total, 0, ',', ' ') }}
            FCFA
        </h3>

        <button onclick="window.print()"
                class="btn btn-primary">
            🖨️ Imprimer
        </button>

    </div>

</div>

@endsection