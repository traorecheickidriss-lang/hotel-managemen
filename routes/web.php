<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChambreController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FactureController;



Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth')->group(function () {

   Route::get('/', function () {

    $nbChambres = App\Models\Chambre::where(
    'statut',
    '!=',
    'Inactive'
)->count();
    $nbDisponibles = App\Models\Chambre::where(
        'statut',
        'Disponible'
    )->count();

    $nbOccupees = App\Models\Chambre::where(
        'statut',
        'Occupée'
    )->count();
    $tauxOccupation = 0;

if ($nbChambres > 0) {

    $tauxOccupation =
        round(
            ($nbOccupees / $nbChambres) * 100,
            1
        );
}

    $nbClients = App\Models\Client::count();

    $nbReservations = App\Models\Reservation::count();

    $chiffreAffaire = App\Models\Facture::where(
        'statut',
        'Payée'
    )->sum('montant_total');

    $dernieresReservations =
        App\Models\Reservation::with(
            'client',
            'chambre'
        )
        ->latest()
        ->take(5)
        ->get();

    $dernieresFactures =
        App\Models\Facture::with('reservation.client')
        ->latest()
        ->take(5)
        ->get();
$encaissesAujourdHui =
    App\Models\Facture::where(
        'statut',
        'Payée'
    )
    ->whereDate(
        'date_paiement',
        today()
    )
    ->sum('montant_total');

$encaissesMois =
    App\Models\Facture::where(
        'statut',
        'Payée'
    )
    ->whereMonth(
        'date_paiement',
        now()->month
    )
    ->whereYear(
        'date_paiement',
        now()->year
    )
    ->sum('montant_total');

$encaissesAnnee =
    App\Models\Facture::where(
        'statut',
        'Payée'
    )
    ->whereYear(
        'date_paiement',
        now()->year
    )
    ->sum('montant_total');

$facturesPayees =
    App\Models\Facture::where(
        'statut',
        'Payée'
    )->count();

$facturesImpayees =
    App\Models\Facture::where(
        'statut',
        'Impayée'
    )->count();

    $revenusMensuels = [];

for ($mois = 1; $mois <= 12; $mois++) {

    $revenusMensuels[] =
        App\Models\Facture::where(
            'statut',
            'Payée'
        )
        ->whereMonth(
            'date_paiement',
            $mois
        )
        ->whereYear(
            'date_paiement',
            now()->year
        )
        ->sum('montant_total');
}
$occupationsMensuelles = [];

for ($mois = 1; $mois <= 12; $mois++) {

    $occupationsMensuelles[] =
        App\Models\Reservation::whereMonth(
            'date_arrivee',
            $mois
        )
        ->whereYear(
            'date_arrivee',
            now()->year
        )
        ->count();
}
$reservationsMensuelles = [];

for ($mois = 1; $mois <= 12; $mois++) {

    $reservationsMensuelles[] =
        App\Models\Reservation::whereMonth(
            'date_arrivee',
            $mois
        )
        ->whereYear(
            'date_arrivee',
            now()->year
        )
        ->count();
}

$arriveesAujourdHui =
    App\Models\Reservation::whereDate(
        'date_arrivee',
        today()
    )->count();

$departsAujourdHui =
    App\Models\Reservation::whereDate(
        'date_depart',
        today()
    )->count();

    $departsDuJour = App\Models\Reservation::with(
    'client',
    'chambre'
)
->whereDate(
    'date_depart',
    today()
)
->get();

    return view(
        'dashboard',
        compact(
            'nbChambres',
            'nbDisponibles',
            'nbOccupees',
            'nbClients',
            'nbReservations',
            'chiffreAffaire',
            'dernieresReservations',
            'tauxOccupation',
            'dernieresFactures',
            'encaissesAujourdHui',
            'encaissesMois',
            'encaissesAnnee',
            'facturesPayees',
            'facturesImpayees',
            'revenusMensuels',
            'occupationsMensuelles',
            'reservationsMensuelles',
            'arriveesAujourdHui',
            'departsAujourdHui',
            'departsDuJour',
        )
    );
});

    Route::resource('chambres', ChambreController::class);
    Route::resource('clients', ClientController::class);
    Route::resource('reservations', ReservationController::class);
    Route::resource('users', UserController::class);
    Route::resource('factures', FactureController::class);
    Route::resource(
    'users',
    UserController::class
)->middleware('admin');
    Route::get(
    '/factures/{id}/pdf',
    [FactureController::class, 'pdf']
)->name('factures.pdf');
    Route::post(
    '/factures/generer/{reservation}',
    [FactureController::class, 'store']
)->name('factures.generer');
Route::post(
    '/factures/{id}/statut',
    [FactureController::class, 'updateStatut']
)->name('factures.statut');
Route::get(
    '/factures-export',
    [FactureController::class, 'exportExcel']
)->name('factures.export');
Route::post(
    '/reservations/{id}/checkin',
    [ReservationController::class, 'checkIn']
);

Route::post(
    '/reservations/{id}/checkout',
    [ReservationController::class, 'checkOut']
);
});

/*

| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

