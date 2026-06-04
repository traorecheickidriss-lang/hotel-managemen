<?php

namespace App\Exports;

use App\Models\Facture;
use Maatwebsite\Excel\Concerns\FromCollection;

class FacturesExport implements FromCollection
{
    public function collection()
    {
        return Facture::all();
    }
}