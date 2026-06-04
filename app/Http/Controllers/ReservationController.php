<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Chambre;
use App\Models\Reservation;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
{
    $recherche = $request->recherche;

    $reservations = Reservation::with([
        'client',
        'chambre'
    ])

    ->when($recherche, function ($query) use ($recherche) {

        $query->whereHas('client', function ($q) use ($recherche) {

            $q->where(
                'nom',
                'like',
                '%' . $recherche . '%'
            );

        });

    })

    ->get();

    return view(
        'reservations.index',
        compact(
            'reservations',
            'recherche'
        )
    );
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $clients = Client::all();

    $chambres = Chambre::where(
    'statut',
    'Disponible'
)->get();

    return view('reservations.create', compact(
        'clients',
        'chambres'
    ));  //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    Reservation::create([
    'client_id' => $request->client_id,
    'chambre_id' => $request->chambre_id,
    'date_arrivee' => $request->date_arrivee,
    'date_depart' => $request->date_depart,
    'date_reservation' => now(),
    'statut' => 'Confirmée'
]);
    $chambre = Chambre::find($request->chambre_id);

    $chambre->update([
        'statut' => 'Occupée'
    ]);


    return redirect('/reservations');
}
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $reservation = Reservation::findOrFail($id);

    $clients = Client::all();
    $chambres = Chambre::all();

    return view('reservations.edit', compact(
        'reservation',
        'clients',
        'chambres'
    ));

        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);

    $reservation->update([
        'client_id' => $request->client_id,
        'chambre_id' => $request->chambre_id,
        'date_arrivee' => $request->date_arrivee,
        'date_depart' => $request->date_depart,
        'statut' => $request->statut,
    ]);

    return redirect('/reservations');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
{
    $reservation = Reservation::findOrFail($id);

    $chambre = $reservation->chambre;

    $reservation->factures()->delete();

    $reservation->delete();

    if ($chambre) {

        $chambre->update([
            'statut' => 'Disponible'
        ]);

    }

    return redirect('/reservations');
}
public function checkIn($id)
{
    $reservation = Reservation::findOrFail($id);

    $reservation->update([
        'statut' => 'En cours'
    ]);

    return redirect('/reservations');
}

public function checkOut($id)
{
    $reservation = Reservation::findOrFail($id);

    $reservation->update([
        'statut' => 'Terminée'
    ]);

    $reservation->chambre->update([
        'statut' => 'Disponible'
    ]);

    return redirect('/reservations');
}
}
