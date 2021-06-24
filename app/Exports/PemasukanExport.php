<?php

namespace App\Exports;

use App\Models\Pemasukan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class PemasukanExport implements FromCollection, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    var $no = 0;
    public function collection()
    {

        return Pemasukan::all();
    }
     public function map($row): array{
            $no = 1;
           return [
            $no,
            $row->no_induk_siswa,
            $row->uraian,
            $row->total,
            $row->created_at,
        ];
    }
}
