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
            $nama_hari    =   array(__("Sunday"), __("Monday"), __("Tuesday"), __("Wednesday"), __("Thursday"), __("Friday"), __("Saturday"));
            $nama_bulan   =   array(
                1 => __("January"), __("February"), __("March"), __("April"), __("May"), __("June"), __("July"), __("August"), __("September"), __("October"), __("November"), __("December")
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
}
