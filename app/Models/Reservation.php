<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Facture;

class Reservation extends Model
{
    protected $fillable = [
        'client_id',
        'chambre_id',
        'date_arrivee',
        'date_depart',
        'date_reservation',
        'statut'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function chambre()
    {
        return $this->belongsTo(Chambre::class);
    }

    public function factures()
{
    return $this->hasMany(Facture::class);
}
}