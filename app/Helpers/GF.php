<?php

namespace App\Helpers;



class GF
{
    public static function roleConvert($value)
    {
        switch ($value) {
            case 1:
                return "Administrator";
                break;
            case 2:
                return "Administrasi";
                break;
            case 3:
                return "Siswa";
                break;
            case 4:
                return "Guru";
                break;
            default:
                break;
        }
    }
    public static function formatRupiah($value)
    {
        $result = number_format($value, 0, ",", ".");
        return $result;
    }
    public static function format_date($tgl, $tampil_hari = true, $with_menit = true, $full_char_mount = true)
    {
        if ($tgl != null ||  $tgl != "") {
            $nama_hari    =   array(__("Senin"), __("Selasa"), __("Rabu"), __("Kamis"), __("Jumat"), __("Sabtu"), __("Minggu"));
            $nama_bulan   =   array(
                1 => __("Januari"), __("Februari"), __("Maret"), __("April"), __("Mei"), __("Juni"), __("Juli"), __("Gustus"), __("September"), __("Oktober"), __("November"), __("Desember")
            );
            $tahun        =   substr($tgl, 0, 4);
            if ($full_char_mount) {

                $bulan        =   $nama_bulan[(int)substr($tgl, 5, 2)];
            } else {
                $bulan        =   substr($nama_bulan[(int)substr($tgl, 5, 2)], 0, 3);
            }
            $tanggal      =   substr($tgl, 8, 2);

            $text         =   "";

            if ($tampil_hari) {

                $urutan_hari  =   date('w', mktime(0, 0, 0, substr($tgl, 5, 2), $tanggal, $tahun));
                $hari         =   $nama_hari[$urutan_hari];
                $text         .=  $hari . ", ";
            }

            $text         .= $tanggal . " " . $bulan . " " . $tahun;

            if ($with_menit) {

                $jam    =   substr($tgl, 11, 2);
                $menit  =   substr($tgl, 14, 2);

                $text   .=  ", " . $jam . ":" . $menit;
            }
        } else {

            $text = "-";
        }
        return $text;
    }
    public static function convertDayJadwal($day)
    {
        switch ($day) {
            case 1:
                return "senin";
            case 2:
                return "selasa";
            case 3:
                return "rabu";
            case 4:
                return "kamis";
            case 5:
                return "jumat";
            case 6:
                return "sabtu";
        }
    }
    public static function convertDay($day)
    {
        switch ($day) {
            case 'Sun':
                return "senin";
            case 'Mon':
                return "selasa";
            case 'Tue':
                return "rabu";
            case 'Wed':
                return "kamis";
            case 'Thu':
                return "jumat";
            case 'Fri':
                return "sabtu";
            case 'Sad':
                return "minggu";
        }
    }
}
