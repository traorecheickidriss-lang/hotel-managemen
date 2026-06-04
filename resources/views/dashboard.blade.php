@extends('layouts.app')

@section('content')
<div class="alert alert-secondary text-center">

    📅 {{ now()->format('d/m/Y') }}

</div>
<div class="text-center mb-4">

    <h1 class="fw-bold text-primary">
        🏨 Tableau de Bord
    </h1>

    <p class="text-muted">
        Vue d'ensemble de votre hôtel
    </p>

</div>
@if($arriveesAujourdHui > 0)

<div class="alert alert-success">

    ✅ {{ $arriveesAujourdHui }}
    arrivée(s) prévue(s) aujourd'hui

</div>

@endif

@if($departsAujourdHui > 0)

<div class="alert alert-warning">

    ⚠️ {{ $departsAujourdHui }}
    départ(s) prévu(s) aujourd'hui

</div>

@endif

<div class="card shadow mt-4">

    <div class="card-header bg-warning">

        🏨 Chambres à libérer aujourd'hui

    </div>

    <div class="card-body">

        <table class="table table-hover">

            <thead>

                <tr>

                    <th>Client</th>
                    <th>Chambre</th>
                    <th>Date départ</th>

                </tr>

            </thead>

            <tbody>

                @forelse($departsDuJour as $reservation)

                <tr>

                    <td>
                        {{ optional($reservation->client)->nom }}
                    </td>

                    <td>
                        Chambre
                        {{ optional($reservation->chambre)->numero }}
                    </td>

                    <td>
                        {{ $reservation->date_depart }}
                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="3" class="text-center">

                        Aucun départ prévu aujourd'hui

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

<div class="row g-4">

    <div class="col-md-4">
        <div class="card shadow border-0 text-center">
            <div class="card-body">
                <h2>{{ $nbChambres }}</h2>
                <p class="mb-0">Total Chambres</p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow border-0 text-center">
            <div class="card-body">
                <h2>{{ $nbDisponibles }}</h2>
                <p class="mb-0">🟢 Chambres Disponibles</p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow border-0 text-center">
            <div class="card-body">
                <h2>{{ $nbOccupees }}</h2>
                <p class="mb-0">🔴 Chambres Occupées</p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow border-0 text-center">
            <div class="card-body">
                <h2>{{ $nbClients }}</h2>
                <p class="mb-0">👤 Clients</p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow border-0 text-center">
            <div class="card-body">
                <h2>{{ $nbReservations }}</h2>
                <p class="mb-0">📅 Réservations</p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow border-0 bg-success text-white text-center">
            <div class="card-body">
                <h2>
                    {{ number_format($chiffreAffaire, 0, ',', ' ') }}
                </h2>
                <p class="mb-0">💰 FCFA encaissés</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
    <div class="card shadow border-0 bg-info text-white text-center">
        <div class="card-body">
            <h2>{{ $tauxOccupation }}%</h2>
            <p class="mb-0">
                📊 Taux d'occupation
            </p>
        </div>
    </div>
</div>
<div class="row g-4 mt-3">

    <div class="col-md-4">
        <div class="card shadow border-0 bg-success text-white text-center">
            <div class="card-body">
                <h3>
                    {{ number_format($encaissesAujourdHui,0,',',' ') }}
                </h3>
                <p>💰 Encaissé aujourd'hui</p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow border-0 bg-primary text-white text-center">
            <div class="card-body">
                <h3>
                    {{ number_format($encaissesMois,0,',',' ') }}
                </h3>
                <p>📅 Encaissé ce mois</p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow border-0 bg-dark text-white text-center">
            <div class="card-body">
                <h3>
                    {{ number_format($encaissesAnnee,0,',',' ') }}
                </h3>
                <p>📈 Encaissé cette année</p>
            </div>
        </div>
    </div>

</div>

<div class="row g-4 mt-1">

    <div class="col-md-6">
        <div class="card shadow border-0 text-center">
            <div class="card-body">
                <h2>{{ $facturesPayees }}</h2>
                <p>✅ Factures Payées</p>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card shadow border-0 text-center">
            <div class="card-body">
                <h2>{{ $facturesImpayees }}</h2>
                <p>❌ Factures Impayées</p>
            </div>
        </div>
    </div>

</div>
</div>

<div class="card shadow mt-5">

    <div class="card-header bg-primary text-white">
        📅 Dernières Réservations
    </div>

    <div class="card-body">

        <table class="table table-hover">

            <thead class="table-light">

                <tr>
                    <th>Client</th>
                    <th>Chambre</th>
                    <th>Date arrivée</th>
                    <th>Date départ</th>
                </tr>

            </thead>

            <tbody>

                @forelse($dernieresReservations as $reservation)

                <tr>

                    <td>
                        {{ optional($reservation->client)->nom }}
                    </td>

                    <td>
                        Chambre
                        {{ optional($reservation->chambre)->numero }}
                    </td>

                    <td>
                        {{ $reservation->date_arrivee }}
                    </td>

                    <td>
                        {{ $reservation->date_depart }}
                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="4" class="text-center">
                        Aucune réservation
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>
<div class="card shadow mt-4">

    <div class="card-header bg-success text-white">
        💰 Dernières Factures
    </div>

    <div class="card-body">

        <table class="table table-hover">

            <thead class="table-light">

                <tr>
                    <th>Facture</th>
                    <th>Client</th>
                    <th>Montant</th>
                    <th>Statut</th>
                </tr>

            </thead>

            <tbody>

                @forelse($dernieresFactures as $facture)

                <tr>

                    <td>
                        {{ $facture->numero_facture }}
                    </td>

                    <td>
                        {{ optional(optional($facture->reservation)->client)->nom }}
                    </td>

                    <td>
                        {{ number_format($facture->montant_total, 0, ',', ' ') }}
                        FCFA
                    </td>

                    <td>

                        @if($facture->statut == 'Payée')

                            <span class="badge bg-success">
                                Payée
                            </span>

                        @else

                            <span class="badge bg-danger">
                                Impayée
                            </span>

                        @endif

                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="4" class="text-center">
                        Aucune facture enregistrée
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>
<div class="card shadow mt-4">

    <div class="card-header bg-dark text-white">

        📈 Revenus mensuels

    </div>

    <div class="card-body">

        <canvas id="revenusChart"></canvas>

    </div>

</div>

<script>

const ctx =
document.getElementById(
    'revenusChart'
);

new Chart(ctx, {

    type: 'bar',

    data: {

        labels: [
            'Jan',
            'Fév',
            'Mar',
            'Avr',
            'Mai',
            'Juin',
            'Juil',
            'Août',
            'Sep',
            'Oct',
            'Nov',
            'Déc'
        ],

        datasets: [{

            label:
            'Revenus FCFA',

            data:
            @json($revenusMensuels)

        }]
    }

});

</script>
<div class="card shadow mt-4">

    <div class="card-header bg-success text-white">

        🏨 Occupation des chambres par mois

    </div>

    <div class="card-body">

        <canvas id="occupationChart"></canvas>

    </div>

</div>

<script>

const occupationCtx =
document.getElementById(
    'occupationChart'
);

new Chart(occupationCtx, {

    type: 'line',

    data: {

        labels: [
            'Jan',
            'Fév',
            'Mar',
            'Avr',
            'Mai',
            'Juin',
            'Juil',
            'Août',
            'Sep',
            'Oct',
            'Nov',
            'Déc'
        ],

        datasets: [{

            label:
            'Réservations',

            data:
            @json($occupationsMensuelles),

            fill: false,

            tension: 0.3

        }]
    }

});

</script>
<div class="card shadow mt-4">

    <div class="card-header bg-info text-white">

        📅 Réservations par mois

    </div>

    <div class="card-body">

        <canvas id="reservationChart"></canvas>

    </div>

</div>

<script>

const reservationCtx =
document.getElementById(
    'reservationChart'
);

new Chart(reservationCtx, {

    type: 'bar',

    data: {

        labels: [
            'Jan',
            'Fév',
            'Mar',
            'Avr',
            'Mai',
            'Juin',
            'Juil',
            'Août',
            'Sep',
            'Oct',
            'Nov',
            'Déc'
        ],

        datasets: [{

            label:
            'Nombre de réservations',

            data:
            @json($reservationsMensuelles)

        }]
    }

});

</script>
@endsection