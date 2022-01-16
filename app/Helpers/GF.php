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
}
