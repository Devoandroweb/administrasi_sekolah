<?php

namespace App\Imports;

use Illuminate\Support\Facades\DB;
use App\Models\DataSiswa;
use App\Models\Administrasi;
use App\Models\MJenisAdministrasi;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Collection;

class SiswaImport implements ToCollection, WithChunkReading, ShouldQueue, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $siswa = new DataSiswa;
            $siswa->nama = $row[0];
            $siswa->tmp_lahir = $row[1];
            $siswa->tgl_lahir = $row[2];
            $siswa->nisn = $row[3];
            $siswa->no_induk = $row[4];
            $siswa->no_tlp = $row[6];
            $siswa->alamat = $row[7];
            $siswa->password = Hash::make($row[4]);
            $siswa->save();

            $administrasi = new Administrasi;
            $administrasi->id_siswa = $siswa->id_siswa;


            //baca jenis_administrasi
            //lalu looping
            $administrasiSiswa = [];

            $mJenisAdministrasi = MJenisAdministrasi::get();
            foreach ($mJenisAdministrasi as $key) {
                $administrasiSiswa[] = array(
                    "id_jenis_adm" => $key->id,
                    "nama_adm" => $key->nama,
                    "value_adm" => 0
                );
            }
            $administrasi->value = json_encode($administrasiSiswa);
            $administrasi->save();
        }
    }
    public function chunkSize(): int
    {
        return 1000;
    }
    public function startRow(): int
    {
        return 2;
    }
}
