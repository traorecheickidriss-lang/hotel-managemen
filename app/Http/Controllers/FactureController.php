<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facture;
use App\Models\Reservation;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FacturesExport;

class FactureController extends Controller
{
    public function index(Request $request)
{
    $recherche = $request->recherche;

    $factures = Facture::with(
        'reservation.client',
        'reservation.chambre'
    )

    ->when($recherche, function ($query) use ($recherche) {

        $query->where(
            'numero_facture',
            'like',
            '%' . $recherche . '%'
        )

        ->orWhereHas(
            'reservation.client',
            function ($q) use ($recherche) {

                $q->where(
                    'nom',
                    'like',
                    '%' . $recherche . '%'
                );

            }
        );

    })

    ->get();

    return view(
        'factures.index',
        compact(
            'factures',
            'recherche'
        )
    );
}
    public function store($reservationId)
{
    $reservation = Reservation::with('chambre')
        ->findOrFail($reservationId);

    $arrivee = Carbon::parse(
        $reservation->date_arrivee
    );

    $depart = Carbon::parse(
        $reservation->date_depart
    );

    $nombreNuits = $arrivee->diffInDays($depart);

    $montantTotal =
        $nombreNuits *
        $reservation->chambre->prix;

     if (
    Facture::where(
        'reservation_id',
        $reservationId
    )->exists()
) {
    return redirect('/factures');
}
  
$numeroFacture =
    'FAC-' .
    date('Y') .
    '-' .
    str_pad(
        Facture::count() + 1,
        4,
        '0',
        STR_PAD_LEFT
    );
    
Facture::create([
    'numero_facture' => $numeroFacture,
    'reservation_id' => $reservation->id,
    'date_facture' => now()->toDateString(),
    'nombre_nuits' => $nombreNuits,
    'montant_total' => $montantTotal,
    'tva' => 0,
    'statut' => 'Impayée'
]);

    return redirect('/factures');
}
public function show($id)
{
    $facture = Facture::with(
        'reservation.client',
        'reservation.chambre'
    )->findOrFail($id);

    return view(
        'factures.show',
        compact('facture')
    );
}

public function pdf($id)
{
    $facture = Facture::with(
        'reservation.client',
        'reservation.chambre'
    )->findOrFail($id);

    $pdf = Pdf::loadView(
        'factures.pdf',
        compact('facture')
    );

    return $pdf->download(
        'Facture-' .
        $facture->numero_facture .
        '.pdf'
    );
}
public function updateStatut(Request $request, $id)
{
    $facture = Facture::findOrFail($id);

    $facture->update([

    'statut' => $request->statut,

    'mode_paiement' =>
        $request->mode_paiement,

    'date_paiement' =>
        $request->statut == 'Payée'
            ? now()->toDateString()
            : null

]);

    return redirect('/factures');
}
public function exportExcel()
{
    return Excel::download(
        new FacturesExport,
        'factures.xlsx'
    );
}
}
