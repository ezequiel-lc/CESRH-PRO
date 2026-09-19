<?php

namespace App\Exports;

use App\Models\Encuestas360\Relacion;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportRelacionesDev implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Relacion::all();
    }
}
