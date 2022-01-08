<?php 
    use App\Helpers\Time;
    use App\Helpers\Terbilang;
?>
<html>
    <head>
        <title>Menampilkan List Printer</title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

    </head>
    <style type="text/css">
        @font-face{
  
            src : url('{{ asset("font/F25_Bank_Printer.ttf") }}');
            font-family: 'bankr';
        }
        .content{
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
        .header{
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header img{
            width: 40%;
        }
        .bag1{
            text-align: center;
            width: 15%;
        }
        .bag2{
            width: 60%;
        }
        .bag3{
            width: 25%;
        }
        .bank-r{
            font-family: bankr;
        }
        .bag2 > label{
            font-size: 10pt;
        }
        table {
            font-size: 8pt;
            width: 100%;
        }
        hr{
            margin-top: 0.5rem;
            margin-bottom: 0.5rem;
        }
        .terbilang{
     
            width: 100%;
            font-family: bankr;
            line-height: 1.5rem;
            display: flex;
            align-items: center;
            font-size: 8pt;
    
        }
        
        .terbilang-bag1{
            width: 50%;
        }
        .terbilang-bag2{
            width: 50%;
            text-align: right;
        }
        .terbilang-bag1 .pattern{
            background-image: url('{{  asset("img/pattern_line.jpg")  }}');
            background-size: 100px;
            padding: 10px;
        }
        .footer{
            font-size: 8pt;
            font-family: bankr;
            line-height: 1.5rem;
        }
        .ttd{
            width: 100%;
        }
        .ttd1 {
            width: 30%;
            float: right;
            text-align: center;
        }
        .print{
            position: fixed;
            bottom: 0;
            right: 0;
        }
        button{
          background: #084479;
          border: none;
          border-radius: 0.1rem;
          color: white;
          font-weight: bold;
          padding: 0.5rem 1rem 0.5rem 1rem;
          margin: 2rem;
          cursor: pointer;
        }
        @media print{
            .content{
                width: 100%;
                padding: 0;
                padding-bottom: 10px !important;
            }
            .print{
              display: none;
            }
            @page{
                padding: 1rem;
                margin: 1rem;
                
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
                <img src="{{ asset('img/logo_sekolah.png') }}">
            </div>
             <div class="bag2 bank-r">
                <h3>SMA ISLAM AL-HIKMAH</h3>
                <label><small>Jl. Raya Tanjungsari Kuwolu Bululawang Malang Jawa Timur</small></label>
            </div>
             <div class="bag3">
                <h5 class="bank-r">BUKTI PEMBAYARAN</h5>
            </div>
           </div>
           <hr>
           <div class="body ">
               <table class="bank-r">
                   <tr>
                       <td>Nama</td>
                       <td>:</td>
                       <td>{{ session('trans_nama')}}</td>
                       <td>Tanggal Trans</td>
                       <td>:</td>
                       <?php 
                        $date_indo = Time::time_indo_convert(strtotime(session('tanggal_trans')));
                       ?>
                       <td>{{ $date_indo[0] }}</td>
                       <td>Tanggungan</td>
                       <td>:</td>
                       <td class="numeric" style="text-align: right;">{{ session('total_tanggungan_trans') }}</td>
                   </tr>
                    <tr>
                       <td>NIS / Kelas</td>
                       <td>:</td>
                       <td>{{ session('trans_nis')." / ".session('trans_kelas') }}</td>
                       <td>Tanggal Cetak</td>
                       <td>:</td>
                       <td>{{ session('tanggal_cetak_trans') }}</td>
                       <td>Terbayar</td>
                       <td>:</td>
                       <td class="numeric" style="text-align: right;">{{session('trans_terbayar')}}</td>
                   </tr>
                    <tr>
                       <td>Penerima</td>
                       <td>:</td>
                       <td>{{session('trans_penerima')}}</td>
                       <td></td>
                       <td></td>
                       <td></td>
                       <td>Kurang</td>
                       <td>:</td>
                       <?php
                            $total = session('total_tanggungan_trans') - session('trans_terbayar');
                        ?>
                       <td class="numeric" style="text-align: right;">{{ $total }}</td>
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
                $data = session('uraian_trans');
                $no = 1;
               
                $html ='';
                
                // dd($data);
                           
                if ($data['spp'] != 0 and $data['spp'] != "") {
                    $html .= '<tr>';
                    $html .= '<td style="width: 5%;">'.$no.'</td>';
                    $html .= '<td>SPP</td><td class="numeric" style="text-align: right;">'.$data['spp'].'</td>';
                    $html .= '</tr>';
                    $no++;
                }
                if ($data['psb'] != 0 and $data['psb'] != "") {
                    $html .= '<tr>';
                    $html .= '<td style="width: 5%;">'.$no.'</td>';
                    $html .= '<td>PSB</td><td class="numeric" style="text-align: right;">'.$data['psb'].'</td>';
                    $html .= '</tr>';
                    $no++;

                }
                if ($data['uts_1'] != 0 and $data['uts_1'] != "") {
                    $html .= '<tr>';
                    $html .= '<td style="width: 5%;">'.$no.'</td>';
                    $html .= '<td>UTS Semester 1</td><td class="numeric" style="text-align: right;">'.$data['uts_1'].'</td>';
                    $html .= '</tr>';
                    $no++;
                }
                if ($data['uts_2'] != 0 and $data['uts_2'] != "" ) {
                    $html .= '<tr>';
                    $html .= '<td style="width: 5%;">'.$no.'</td>';
                    $html .= '<td>UTS Semester 2</td><td class="numeric" style="text-align: right;">'.$data['uts_2'].'</td>';
                    $html .= '</tr>';
                    $no++;
                }
                if ($data['pas_1'] != 0 and $data['pas_1'] != "") {
                    $html .= '<tr>';
                    $html .= '<td style="width: 5%;">'.$no.'</td>';
                    $html .= '<td>PAS Semester 1</td><td class="numeric" style="text-align: right;">'.$data['pas_1'].'</td>';
                    $html .= '</tr>';
                    $no++;
                }
                if ($data['pas_2'] != 0 and $data['pas_2'] != "") {
                    $html .= '<tr>';
                    $html .= '<td style="width: 5%;">'.$no.'</td>';
                    $html .= '<td>PAS Semester 2</td><td class="numeric" style="text-align: right;">'.$data['pas_2'].'</td>';
                    $html .= '</tr>';
                    $no++;
                }
                if ($data['lks_1'] != 0 and $data['lks_1'] != "") {
                    $html .= '<tr>';
                    $html .= '<td style="width: 5%;">'.$no.'</td>';
                    $html .= '<td>LKS Semester 1</td><td class="numeric" style="text-align: right;">'.$data['lks_1'].'</td>';
                    $html .= '</tr>';
                    $no++;
                }
                if ($data['lks_2'] != 0 and $data['lks_2'] != "") {
                    $html .= '<tr>';
                    $html .= '<td style="width: 5%;">'.$no.'</td>';
                    $html .= '<td>LKS Semester 2</td><td class="numeric" style="text-align: right;">'.$data['lks_2'].'</td>';
                    $html .= '</tr>';
                    $no++;
                }
                if ($data['daftar_ulang'] != 0 and $data['daftar_ulang'] != "") {
                    $html .= '<tr>';
                    $html .= '<td style="width: 5%;">'.$no.'</td>';
                    $html .= '<td>Daftar Ulang</td><td class="numeric" style="text-align: right;">'.$data['daftar_ulang'].'</td>';
                    $html .= '</tr>';
                    $no++;
                }
                if ($data['unas'] != 0 and $data['unas'] != "") {
                    $html .= '<tr>';
                    $html .= '<td style="width: 5%;">'.$no.'</td>';
                    $html .= '<td>UNAS</td><td class="numeric" style="text-align: right;">'.$data['unas'].'</td>';
                    $html .= '</tr>';
                    $no++;
                }

              
                if (count($data['tanggunganprev']) != 0) {
                    $a = 1;
                    for ($i=0; $i < count($data['tanggunganprev']); $i++) { 
                      // dd($data['tanggunganprev'][$i]['tgg']);
                      
                          $html .= '<tr>';
                          $html .= '<td style="width: 5%;">'.$no.'</td>';
                          $html .= '<td>Tanggungan Kelas '.$data['tanggunganprev'][$i]['kelas'].'</td><td class="numeric" style="text-align: right;">'.$data['tanggunganprev'][$i]['value'].'</td>';
                          $html .= '</tr>';
                          $no++;
                    }
                }
                    
                
                echo $html;
                    
                ?>
               </table>
               <hr>
               <div class="terbilang">
                    <div class="terbilang-bag1">
                        <label>Terbilang : </label>
                        <label class="pattern"><?php 
                        function penyebut($nilai) {
                          $nilai = abs($nilai);
                          $huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
                          $temp = "";
                          if ($nilai < 12) {
                            $temp = " ". $huruf[$nilai];
                          } else if ($nilai <20) {
                            $temp = penyebut($nilai - 10). " Belas";
                          } else if ($nilai < 100) {
                            $temp = penyebut($nilai/10)." Puluh". penyebut($nilai % 10);
                          } else if ($nilai < 200) {
                            $temp = " Seratus" . penyebut($nilai - 100);
                          } else if ($nilai < 1000) {
                            $temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
                          } else if ($nilai < 2000) {
                            $temp = " Seribu" . penyebut($nilai - 1000);
                          } else if ($nilai < 1000000) {
                            $temp = penyebut($nilai/1000) . " Ribu" . penyebut($nilai % 1000);
                          } else if ($nilai < 1000000000) {
                            $temp = penyebut($nilai/1000000) . " Juta" . penyebut($nilai % 1000000);
                          } else if ($nilai < 1000000000000) {
                            $temp = penyebut($nilai/1000000000) . " Milyar" . penyebut(fmod($nilai,1000000000));
                          } else if ($nilai < 1000000000000000) {
                            $temp = penyebut($nilai/1000000000000) . " Trilyun" . penyebut(fmod($nilai,1000000000000));
                          }     
                          return $temp;
                        }
                       
                        function terbilang($nilai) {
                          if($nilai<0) {
                            $hasil = "Minus ". trim(penyebut($nilai));
                          } else {
                            $hasil = trim(penyebut($nilai));
                          }         
                          return $hasil;
                        }
                        echo terbilang(session('trans_terbayar'))." Rupiah";
                         ?></label>
                    </div>
                     <div class="terbilang-bag2">
                        <label>Total : </label>
                        <label class="numeric">{{ session('trans_terbayar') }}</label>
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
                       <label>[ {{ session('trans_nama') }} ]</label>
                   </div>
                   <div class="ttd1">
                       <label>Teller/Penerima</label>
                       <br>
                       <br>
                       <br>
                       <label>[ {{ session('trans_penerima') }} ]</label>
                   </div>
                   <?php 
                    // dd($data['tanggunganprev']);
                   ?>
               </div>
               
           </div>

       </div>
<script src="{{asset('js/core/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/core/popper.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/plugins/autoNumeric.js')}}"></script>
    </body>
    <script type="text/javascript">
        $('.numeric').autoNumeric('init',{aPad:false});
        $('.printing').click(function(event) {
          /* Act on the event */
          window.print();
        });
        
        // window.close();
    </script>
</html>