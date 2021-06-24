<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\ModelTanggunganSebelumnya;
class ExportTanggungaSebelumnya implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ModelTanggunganSebelumnya::all();
    }
}
