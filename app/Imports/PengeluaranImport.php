<?php

namespace App\Imports;
use App\Models\ModelPengeluaran;
use Illuminate\Support\Collection;
use App\Models\DataSiswa;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithChunkReading;
class PengeluaranImport implements ToCollection,WithChunkReading
{
    /**
    * @param Collection $collection
    */
    // $total = 0;
    public function collection(Collection $rows)
    {
        
        $uraian = [];
        $tanggal = "";
        $total = 0;
        foreach ($rows as $row) 
        {

            

            if ($tanggal == "") {
                $tanggal = $row[0];
            }
            $uraian[] = array('key' => $row[2] , 'value' => $row[3]);
            $total = $total + $row[3];

            if ($row[4] != "") {

                ModelPengeluaran::create([
                        'uraian' => json_encode($uraian),
                        'total' => $total,
                        'created_at' => $tanggal
                    ]);
                $tanggal = "";
                $uraian = [];
                $total = 0;
                
            }
            
        }
        // foreach ($rows as $row) {
        //      ModelPengeluaran::create([
        //                 'uraian' => $row[2],
        //                 'total' => $row[3],
        //                 'created_at' => $row[0]
        //             ]);
        // }
    }
    public function chunkSize(): int
    {
        return 1000;
    }
}
