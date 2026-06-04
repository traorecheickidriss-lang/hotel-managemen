<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
   protected $fillable = [
    'numero_facture',
    'reservation_id',
    'date_facture',
    'nombre_nuits',
    'montant_total',
    'tva',
    'statut',
    'mode_paiement',
    'date_paiement'
];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
    public function factures()
{
    return $this->hasMany(Facture::class);
}
}