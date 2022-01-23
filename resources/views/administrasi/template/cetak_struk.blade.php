<?php

use App\Helpers\Time;
use App\Helpers\Terbilang;
use App\Models\HTransaksi;

$hTransaksi = HTransaksi::where("kode", $kode)->first();

?>
<html>

<head>
    <title>Menampilkan List Printer</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

</head>
<style type="text/css">
    @font-face {

        src : url('{{ asset("public/assets/font/F25_Bank_Printer.ttf") }}');
        font-family: 'bankr';
    }

    .content {
        width: 70%;
        margin: auto;
        padding: 2rem;
        line-height: 0.2rem;
        overflow: hidden;
        border-top: none;
        border-right: none;
        border-left: none;
        border-bottom: 3px solid black;
        border-bottom-style: dashed;
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .header img {
        width: 40%;
    }

    .bag1 {
        text-align: center;
        width: 15%;
    }

    .bag2 {
        width: 50%;
    }

    .bag3 {
        width: 35%;
    }

    .bag3 p {
        font-size: 8pt;
        font-family: "bankr";
    }

    .bank-r {
        font-family: bankr;
    }

    .bag2>label {
        font-size: 10pt;
    }

    table {
        font-size: 8pt;
        width: 100%;
    }

    hr {
        margin-top: 0.5rem;
        margin-bottom: 0.5rem;
    }

    .terbilang {

        width: 100%;
        font-family: bankr;
        line-height: 1.5rem;
        display: flex;
        align-items: center;
        font-size: 8pt;

    }

    .terbilang-bag1 {
        width: 50%;
        /* background-image: url("{{url('public/assets/img/bg-pattern.png')}}"); */
    }

    .terbilang-bag2 {
        width: 50%;
        text-align: right;
    }

    .terbilang-bag1 .pattern {
        background-image: url('{{  asset("public/assets/img/pattern_line.jpg")  }}');
        background-size: 100px;
        padding: 10px;
    }

    .footer {
        font-size: 8pt;
        font-family: bankr;
        line-height: 1.5rem;
    }

    .ttd {
        width: 100%;
    }

    .ttd1 {
        width: 30%;
        float: right;
        text-align: center;
    }

    .print {
        position: fixed;
        bottom: 0;
        right: 0;
    }

    button {
        background: #084479;
        border: none;
        border-radius: 0.1rem;
        color: white;
        font-weight: bold;
        padding: 0.5rem 1rem 0.5rem 1rem;
        margin: 2rem;
        cursor: pointer;
    }

    @media print {
        * {
            -webkit-print-color-adjust: exact !important;
            /*Chrome, Safari */
            color-adjust: exact !important;
            /*Firefox*/
        }

        .content {
            width: 100%;
            padding: 0;
            padding-bottom: 10px !important;
        }

        .print {
            display: none;
        }

        @page {
            padding: 1rem;
            margin: 1rem;


        }

        @page {
            size: auto;
        }
    }
</style>

<body>
    <div class="print">
        <button type="button" class="printing">Print</button>
    </div>
    <div class="content">
        <div class="header">
            <div class="bag1">
                <img src="{{ asset('public/assets/img/logo_sekolah.png') }}">
            </div>
            <div class="bag2 bank-r">
                <h3>SMA ISLAM AL-HIKMAH</h3>
                <label><small>Jl. Raya Tanjungsari Kuwolu Bululawang Malang Jawa Timur</small></label>
            </div>
            <div class="bag3">
                <h5 class="bank-r" style="margin-bottom: 0rem;">BUKTI PEMBAYARAN</h5>
                <p>KODE TRANSAKSI : {{$hTransaksi->kode}}</p>
            </div>
        </div>
        <hr>
        <div class="body ">
            <table class="bank-r">
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td>{{ $hTransaksi->nama_siswa}}</td>
                    <td>Tanggal Transaksi</td>
                    <td>:</td>
                    <?php
                    $date_indo = Time::time_indo_convert(strtotime($hTransaksi->tanggal));
                    ?>
                    <td>{{ $date_indo[0] }}</td>
                    <td>Tanggungan</td>
                    <td>:</td>
                    <td class="numeric" style="text-align: right;">{{ GF::formatRupiah(intval($hTransaksi->total)) }}</td>
                </tr>
                <tr>
                    <td>NIS / Kelas</td>
                    <td>:</td>
                    <td>{{ $hTransaksi->no_induk." / ".$hTransaksi->kelas}}</td>
                    <td>Tanggal Cetak</td>
                    <td>:</td>
                    <td>{{ $hTransaksi->tanggal }}</td>
                    <td>Terbayar</td>
                    <td>:</td>
                    <td class="" style="text-align: right;">{{GF::formatRupiah(intval($hTransaksi->terbayar))}}</td>
                </tr>
                <tr>
                    <td>Penerima</td>
                    <td>:</td>
                    <td>{{$hTransaksi->penerima}}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Kurang</td>
                    <td>:</td>
                    <?php
                    $total = intval($hTransaksi->total) - intval($hTransaksi->terbayar);
                    ?>
                    <td class="" style="text-align: right;">{{ GF::formatRupiah(intval($total)) }}</td>
                </tr>
            </table>
            <hr>
            <table class="bank-r">
                <tr>
                    <td style="width: 5%;">No</td>
                    <td>Uraian Pembayaran</td>
                    <td style="text-align: right;">Jumlah (Rp)</td>
                </tr>
                <?php
                $tgg_now = json_decode($hTransaksi->tgg_now);
                $tgg_prev = json_decode($hTransaksi->tgg_prev);
                $no = 1;

                $html = '';

                // dd($data);
                for ($i = 0; $i < count($tgg_now); $i++) {
                    $html .= '<tr>';
                    $html .= '<td style="width: 5%;">' . $no . '</td>';
                    $html .= '<td>' . $tgg_now[$i]->name . '</td><td class="" style="text-align: right;">' . GF::formatRupiah($tgg_now[$i]->value) . '</td>';
                    $html .= '</tr>';
                    $no++;
                }

                for ($j = 0; $j < count($tgg_prev); $j++) {
                    $html .= '<tr>';
                    $html .= '<td style="width: 5%;">' . $no . '</td>';
                    $html .= '<td>' . $tgg_prev[$j]->name . '</td><td class="" style="text-align: right;">' . GF::formatRupiah($tgg_prev[$j]->value) . '</td>';
                    $html .= '</tr>';
                    $no++;
                }





                echo $html;

                ?>
            </table>
            <hr>
            <div class="terbilang">
                <div class="terbilang-bag1">
                    <label>Terbilang : </label>
                    <label class="pattern"><?php
                                            function penyebut($nilai)
                                            {
                                                $nilai = abs($nilai);
                                                $huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
                                                $temp = "";
                                                if ($nilai < 12) {
                                                    $temp = " " . $huruf[$nilai];
                                                } else if ($nilai < 20) {
                                                    $temp = penyebut($nilai - 10) . " Belas";
                                                } else if ($nilai < 100) {
                                                    $temp = penyebut($nilai / 10) . " Puluh" . penyebut($nilai % 10);
                                                } else if ($nilai < 200) {
                                                    $temp = " Seratus" . penyebut($nilai - 100);
                                                } else if ($nilai < 1000) {
                                                    $temp = penyebut($nilai / 100) . " ratus" . penyebut($nilai % 100);
                                                } else if ($nilai < 2000) {
                                                    $temp = " Seribu" . penyebut($nilai - 1000);
                                                } else if ($nilai < 1000000) {
                                                    $temp = penyebut($nilai / 1000) . " Ribu" . penyebut($nilai % 1000);
                                                } else if ($nilai < 1000000000) {
                                                    $temp = penyebut($nilai / 1000000) . " Juta" . penyebut($nilai % 1000000);
                                                } else if ($nilai < 1000000000000) {
                                                    $temp = penyebut($nilai / 1000000000) . " Milyar" . penyebut(fmod($nilai, 1000000000));
                                                } else if ($nilai < 1000000000000000) {
                                                    $temp = penyebut($nilai / 1000000000000) . " Trilyun" . penyebut(fmod($nilai, 1000000000000));
                                                }
                                                return $temp;
                                            }

                                            function terbilang($nilai)
                                            {
                                                if ($nilai < 0) {
                                                    $hasil = "Minus " . trim(penyebut($nilai));
                                                } else {
                                                    $hasil = trim(penyebut($nilai));
                                                }
                                                return $hasil;
                                            }
                                            echo terbilang($hTransaksi->terbayar) . " Rupiah";
                                            ?></label>
                </div>
                <div class="terbilang-bag2">
                    <label>Total : </label>
                    <label class="">{{ GF::formatRupiah($hTransaksi->terbayar) }}</label>
                </div>
            </div>
            <hr>
        </div>
        <div class="footer bankr">
            <label>NB : Simpanlah baik-baik slip ini. Slip ini sebagai bukti pembayaran yang sah.</label>
            <div class="ttd">
                <div class="ttd1">
                    <label>Penyetor</label>
                    <br>
                    <br>
                    <br>
                    <label>[ {{ $hTransaksi->nama_siswa }} ]</label>
                </div>
                <div class="ttd1">
                    <label>Teller/Penerima</label>
                    <br>
                    <br>
                    <br>
                    <label>[ {{ $hTransaksi->penerima }} ]</label>
                </div>
                <?php
                // dd($data['tanggunganprev']);
                ?>
            </div>

        </div>

    </div>
    <script src="{{asset('public/assets/js/core/jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/assets/js/core/popper.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/assets/js/plugins/autoNumeric.js')}}"></script>
</body>
<script type="text/javascript">
    $('.printing').click(function(event) {
        window.print();
    });
    window.print();

    // window.close();
</script>

</html>