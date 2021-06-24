<?php

namespace App\Imports;
use Illuminate\Support\Facades\DB;
use App\Models\DataSiswa;
use App\Models\Administrasi;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;
class SiswaImport implements ToModel,WithChunkReading, ShouldQueue
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new DataSiswa([
            'nama'     => $row[0],
            'tmp_lahir'    => $row[1], 
            'tgl_lahir' => $row[2],
            'nisn' => $row[3],
            'no_induk' => $row[4],
            'kelas' => $row[5],
            'rombel' => $row[6],
            'no_tlp' => $row[7],
            'alamat' => $row[8],
            'password' => Hash::make($row[0]),
        ]);


    }
    public function chunkSize(): int
    {
        return 1000;
    }
}
