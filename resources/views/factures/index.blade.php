@extends('layouts.app')

@section('content')

<div class="card shadow">

<div class="card-header bg-primary text-white">
    <h4 class="mb-0">
        💰 Gestion des Factures
    </h4>
</div>

<div class="card-body">

    <form method="GET"
          action="/factures"
          class="mb-3">

        <div class="input-group">

            <input type="text"
                   name="recherche"
                   class="form-control"
                   placeholder="Rechercher une facture ou un client..."
                   value="{{ $recherche ?? '' }}">

            <button class="btn btn-primary">
                🔍 Rechercher
            </button>

        </div>

    </form>
<a href="/factures-export"
   class="btn btn-success mb-3">

    📊 Export Excel

</a>
    <table class="table table-bordered table-hover">

        <thead class="table-dark">

            <tr>
                <th>Facture</th>
                <th>Date</th>
                <th>Client</th>
                <th>Chambre</th>
                <th>Nuits</th>
                <th>Montant</th>
                <th>Paiement</th>
                <th>Actions</th>
            </tr>

        </thead>

        <tbody>

            @forelse($factures as $facture)

            <tr>

                <td>
                    {{ $facture->numero_facture }}
                </td>

                <td>
                    {{ $facture->date_facture }}
                </td>

                <td>
                    {{ optional(optional($facture->reservation)->client)->nom ?? 'Client supprimé' }}
                </td>

                <td>
                    {{ optional(optional($facture->reservation)->chambre)->numero ?? 'Chambre supprimée' }}
                </td>

                <td>
                    {{ $facture->nombre_nuits }}
                </td>

                <td>
                    {{ number_format($facture->montant_total, 0, ',', ' ') }}
                    FCFA
                </td>

                <td>

                    <form action="/factures/{{ $facture->id }}/statut"
                          method="POST">

                        @csrf

                        <select name="statut"
                                class="form-select form-select-sm mb-1">

                            <option value="Impayée"
                                {{ $facture->statut == 'Impayée' ? 'selected' : '' }}>
                                Impayée
                            </option>

                            <option value="Payée"
                                {{ $facture->statut == 'Payée' ? 'selected' : '' }}>
                                Payée
                            </option>

                        </select>

                        <select name="mode_paiement"
                                class="form-select form-select-sm mb-1">

                            <option value="">
                                Choisir
                            </option>

                            <option value="Espèces"
                                {{ $facture->mode_paiement == 'Espèces' ? 'selected' : '' }}>
                                Espèces
                            </option>

                            <option value="Mobile Money"
                                {{ $facture->mode_paiement == 'Mobile Money' ? 'selected' : '' }}>
                                Mobile Money
                            </option>

                            <option value="Carte Bancaire"
                                {{ $facture->mode_paiement == 'Carte Bancaire' ? 'selected' : '' }}>
                                Carte Bancaire
                            </option>

                            <option value="Virement"
                                {{ $facture->mode_paiement == 'Virement' ? 'selected' : '' }}>
                                Virement
                            </option>

                        </select>

                        <button class="btn btn-success btn-sm">
                            Enregistrer
                        </button>

                    </form>

                </td>

                <td>

                    <a href="/factures/{{ $facture->id }}/pdf"
                       class="btn btn-danger btn-sm">

                        📄 PDF

                    </a>

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="8"
                    class="text-center">

                    Aucune facture enregistrée

                </td>

            </tr>

            @endforelse

        </tbody>

    </table>

</div>

</div>

@endsection