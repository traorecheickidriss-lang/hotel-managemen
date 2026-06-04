<?php

namespace App\Http\Controllers;

use App\Models\Chambre;
use Illuminate\Http\Request;

class ChambreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index(Request $request)
{
    $recherche = $request->recherche;

    $chambres = Chambre::where(
        'numero',
        'like',
        '%' . $recherche . '%'
    )
    ->where('statut', '!=', 'Inactive')
    ->get();

    return view(
        'chambres.index',
        compact(
            'chambres',
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
     
      return view('chambres.create'); // Afficher le formulaire de création
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       Chambre::create([
        'numero' => $request->numero,
        'type' => $request->type,
        'prix' => $request->prix,
        'statut' => $request->statut
    ]);

    return redirect('/chambres');  //
    }

    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Chambre  $chambre
     * @return \Illuminate\Http\Response
     */
    public function show(Chambre $chambre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Chambre  $chambre
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $chambre = Chambre::findOrFail($id);

    return view('chambres.edit', [
        'chambre' => $chambre
    ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Chambre  $chambre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $chambre = Chambre::findOrFail($id);

   $chambre = Chambre::findOrFail($id);

    $chambre->update([
        'numero' => $request->numero,
        'type' => $request->type,
        'prix' => $request->prix,
        'statut' => $request->statut,
        
    ]);

    return redirect('/chambres');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chambre  $chambre
     * @return \Illuminate\Http\Response
     */
  public function destroy($id)
{
    $chambre = Chambre::findOrFail($id);

    if (
        $chambre->reservations()
                ->where('statut', 'Confirmée')
                ->exists()
    ) {
        return redirect('/chambres')
            ->with(
                'error',
                'Impossible d’archiver cette chambre car elle possède une réservation active.'
            );
    }

    $chambre->update([
        'statut' => 'Inactive'
    ]);

    return redirect('/chambres')
        ->with(
            'success',
            'Chambre archivée avec succès.'
        );
}
}



