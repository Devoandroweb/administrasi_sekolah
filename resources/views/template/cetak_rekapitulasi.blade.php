<?php 
dd($pemasukan);
use App\Helpers\Time;
?>

<!doctype html>
<html lang="en">

<head>
  <title>Rekapitulasi</title>
  <!-- Required meta tags -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- Material Kit CSS -->
  <link href="{{asset('css/material-dashboard.css')}}" rel="stylesheet" />
  <link href="{{asset('css/sweetalert2.min.css')}}" rel="stylesheet" />
  <link href="{{asset('fontawesome/css/all.css')}}" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="{{asset('datatables/datatables.min.css')}}"/>
</head>
<style type="text/css">
  #cetak{
    position: fixed;
    background: red;
    right: 0;
    bottom: 0;
    width: 100px;
    color: white;
    margin: 10px;
    text-align: center;
    padding: 10px;
    border-radius: 5px;
    z-index: 9999;
    display: flex;
    align-items: center;
  }
  #cetak:hover {
    cursor: pointer;
  }
   td{
      padding: 5px;
    }
  ul{
    margin-bottom: 0rem !important;
    display: contents;
  }
  .text-black{
    color: black !important;
  }
  @media print{
    #cetak{
      display: none;
    }
    
    .card{
      width: 100% !important;
    }
   
    body{
      background: white;
    }

    @page {
      size: landscape;
      margin:0;
    }
  
  }
</style>
<body>
  <div id="cetak">
    <div style="margin: auto; display: flex; align-items: center;">
      <i class="material-icons">print</i><strong>Print</strong>
    </div>
    
  </div>

<div class="container">
      

      <div class="card m-4">
        <div class="card-body">
            <div class="row">
            <div class="col d-flex align-items-center">
              <span class="w-25  d-block text-center">
                <img src="{{ asset('img/logo_sekolah.png') }}" style="width: 60%;">
              </span>
              <span class="w-75 d-block text-center " style="line-height: 15px;">
                <h5 class="text-uppercase mb-1 font-weight-bold">Yayasan Pedidikan Al-hikmah</h5>
                <h3 class="text-uppercase mb-0 mt-0 font-weight-bold " style="font-family: Times New Roman; display: contents;">SMA Islam " AL-Hikmah " Bululawang</h3>
                <h6 class="text-uppercase mb-0">Terakreditasi A</h6>
                <table style="width: 55%; margin:auto; font-size: 10pt;" class="font-weight-bold">
                  <tr>
                    <td>NPSN : 20517814 </td>
                    <td>NSS : 304051813067 </td>
                  </tr>
                </table>
                <table style="width: 70%; margin:auto; font-size: 10pt;" class="font-weight-bold">
                  <tr>
                    <td>SK NOMOR : Ma. 007945 </td>
                    <td>TANGGAL : 30 OKTOBER 2010 </td>
                  </tr>
                </table>
                <small style="font-family: Times New Roman;">Email : smaial_hikmah@yahoo.com</small><br>
                <small style="font-family: Times New Roman;">Alamat : Jl. Raya Tanjungsari 150 PO BOX 02 Kuwolu Bululawang Malang [65171] <i class="fas fa-phone-square"></i> (0341) 8221185</small>
              </span>
            </div>
          </div>
          <hr style="border: 1px solid black;">
          <h4 class="text-center font-weight-bold">Rekapitulasi</h4>
          <h5 class="font-weight-bold">Bulan : <?php $date_indo = Time::time_indo_convert(strtotime(date("Y-m-d H:i:s"))); echo $date_indo[0]; ?></h5>
          <div class="d-block" style="overflow: hidden;">
          
          <table border="1" style="float: left; width: 49%;">
            <thead class="bg-danger">
              <tr>
                <th class="font-weight-bold text-center">Tanggal</th>
                <th class="font-weight-bold text-center">Pengeluaran</th>
                <th class="font-weight-bold text-center">Jumlah (Rp)</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                  $total_pemasukan = 0;
                  $total_pengeluaran = 0;
              ?>
             @foreach($pengeluaran as $key)

                  <tr>
                   
                    <td class="created_at_{{ $loop->iteration }}"><?php 
                    $date = $key->created_at;
                    $date_indo = Time::time_indo_convert(strtotime($date)); echo $date_indo[0];?></td>
                    
                      <td><?php
                          $uraian = json_decode($key->uraian);
                          // dd($uraian);
                          $html = "<ul>";
                          $no = 1;
                          for($i = 0; $i < count($uraian);$i++) {

                            $html .= "<li class='text-justify' style='list-style:none; display:content;'><label class='font-weight-bold text-black'>".$no." ".$uraian[$i]->key."</label><span class='linumeric float-right'>".$uraian[$i]->value."</span>";
                            $no++;

                          } 
                          $html .= "</li></ul>";
                          echo $html;
                          $total_pengeluaran = $total_pengeluaran + intval($key->total);
                      ?></td>
                      <td class="text-right linumeric font-weight-bold">{{ $key->total }}</td>
                     
                     
                  </tr>
              @endforeach
            </tbody>
          </table>
          <table border="1" style="float: right; width: 49%">
            <thead class="bg-success">
              <tr>
                <th class="font-weight-bold text-center">No</th>
                <th class="font-weight-bold text-center">Pemasukan</th>
                <th class="font-weight-bold text-center">Jumlah (Rp)</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                $spp = 0;
                $psb = 0;
                $pas_1 = 0;
                $pas_2 = 0;
                $lks_1 = 0;
                $lks_2 = 0;
                $uts_1 = 0;
                $uts_2 = 0;
                $daftar_ulang = 0;
                $unas = 0;
                $lainnya = 0;


                for ($i=0; $i < count($pemasukan) ; $i++) { 
                  $uraian_pemasukan = json_decode($pemasukan[$i]->uraian);
                  $spp = $spp + intval($uraian_pemasukan->spp);
                }
                for ($i=0; $i < count($pemasukan) ; $i++) { 
                  $uraian_pemasukan = json_decode($pemasukan[$i]->uraian);
                  $psb = $psb + intval($uraian_pemasukan->psb);
                }
                for ($i=0; $i < count($pemasukan) ; $i++) { 
                  $uraian_pemasukan = json_decode($pemasukan[$i]->uraian);
                  $pas_1 = $pas_1 + intval($uraian_pemasukan->pas_1);
                }
                for ($i=0; $i < count($pemasukan) ; $i++) { 
                  $uraian_pemasukan = json_decode($pemasukan[$i]->uraian);
                  $pas_2 = $pas_2 + intval($uraian_pemasukan->pas_2);
                }
                for ($i=0; $i < count($pemasukan) ; $i++) { 
                  $uraian_pemasukan = json_decode($pemasukan[$i]->uraian);
                  $lks_1 = $lks_1 + intval($uraian_pemasukan->lks_1);
                }
                for ($i=0; $i < count($pemasukan) ; $i++) { 
                  $uraian_pemasukan = json_decode($pemasukan[$i]->uraian);
                  $lks_1 = $lks_1 + intval($uraian_pemasukan->lks_1);
                }
                for ($i=0; $i < count($pemasukan) ; $i++) { 
                  $uraian_pemasukan = json_decode($pemasukan[$i]->uraian);
                  $uts_1 = $uts_1 + intval($uraian_pemasukan->uts_1);
                }
                for ($i=0; $i < count($pemasukan) ; $i++) { 
                  $uraian_pemasukan = json_decode($pemasukan[$i]->uraian);
                  $uts_2 = $uts_2 + intval($uraian_pemasukan->uts_2);
                }
                for ($i=0; $i < count($pemasukan) ; $i++) { 
                  $uraian_pemasukan = json_decode($pemasukan[$i]->uraian);
                  $daftar_ulang = $daftar_ulang + intval($uraian_pemasukan->daftar_ulang);
                }
                for ($i=0; $i < count($pemasukan) ; $i++) { 
                  $uraian_pemasukan = json_decode($pemasukan[$i]->uraian);
                  $unas = $unas + intval($uraian_pemasukan->unas);
                }

              $uts = $uts_1 + $uts_2;
              $pas = $pas_1 + $pas_2;
              $lks = $lks_1 + $lks_2;

              $total_all[] = array("key" => "SPP", "value"  => $spp);
              $total_all[] = array("key" => "PSB", "value"  => $psb);
              $total_all[] = array("key" => "UTS", "value"  => $uts);
              $total_all[] = array("key" => "LKS", "value"  => $lks);
              $total_all[] = array("key" => "PAS", "value"  => $pas);
              $total_all[] = array("key" => "DAFTAR ULANG", "value"  => $daftar_ulang);
              $total_all[] = array("key" => "UNAS", "value"  => $unas);

              $html = "";
              $no = 1;
              for ($i=0; $i < count($total_all) ; $i++) { 
                if ($total_all[$i]['value'] != 0) {
                    $html .= "<tr>";
                    $html .= "<td class='text-center'>".$no."</td>";
                    $html .= "<td>".$total_all[$i]['key']."</td>";
                    $html .= "<td class='linumeric text-right font-weight-bold'>".$total_all[$i]['value']."</td>";
                    $html .= "</tr>";
                    $no++;
                }
                  
              }
              echo $html;
               
              for ($i=0; $i < count($total_all) ; $i++) { 
                    $total_pemasukan = $total_pemasukan + $total_all[$i]['value'];
              }
              ?>
            </tbody>
          </table>
  
          </div>
          <div class="d-block w-50 m-auto" style="padding: 2rem;">
             <table border="1" style="width: 100%; border: 2px solid black;">
              <tr>
                <td class="font-weight-bold">Total Pemasukan</td>
                <td class="linumeric font-weight-bold text-right">{{ $total_pemasukan }}</td>
              </tr>
              <tr>
                <td class="font-weight-bold">Total Pengeluaran</td>
                <td class="linumeric font-weight-bold text-right">{{ $total_pengeluaran}}</td>
              </tr>
              <tr>
                <td class="font-weight-bold text-center">Jumlah (Rp)</td>
                <td class="linumeric font-weight-bold text-right"><?php 
                $total_allol = $total_pemasukan - $total_pengeluaran; 
                if ($total_allol < 0) {
                  echo "(-) <span class='linumeric'>".abs($total_allol)."</span>";
                }else{
                  echo $total_allol;
                }
                 ?></td>
                }
              </tr>
            </table>
          </div>
         
        </div>
      </div>


</div>  

<script src="{{asset('js/core/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/core/popper.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/core/bootstrap-material-design.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('fontawesome/js/all.js')}}"></script>
<!--  Google Maps Plugin    -->
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> -->
<!-- Chartist JS -->
<!-- Plugin for the momentJs  -->
  <script src="{{asset('js/plugins/moment.min.js')}}"></script>

  <!--  Plugin for Sweet Alert -->
  <script src="{{asset('js/plugins/sweetalert2.min.js')}}"></script>

  <!-- Forms Validations Plugin -->
  <script src="{{asset('js/plugins/jquery.validate.min.js')}}"></script>

  <!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
  <script src="{{asset('js/plugins/jquery.bootstrap-wizard.js')}}"></script>

  <!--  Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
  <script src="{{asset('js/plugins/bootstrap-selectpicker.js')}}" ></script>

  <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
  <script src="{{asset('js/plugins/bootstrap-datetimepicker.min.js')}}"></script>

  <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
  <script src="{{asset('js/plugins/jquery.datatables.min.js')}}"></script>

  <!--  Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
  <script src="{{asset('js/plugins/bootstrap-tagsinput.js')}}"></script>

  <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
  <script src="{{asset('js/plugins/jasny-bootstrap.min.js')}}"></script>

  <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
  <script src="{{asset('js/plugins/fullcalendar.min.js')}}"></script>

  <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
  <script src="{{asset('js/plugins/jquery-jvectormap.js')}}"></script>

  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="{{asset('js/plugins/nouislider.min.js')}}" ></script>

  <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>

  <!-- Library for adding dinamically elements -->
  <script src="{{asset('js/plugins/arrive.min.js')}}"></script>
  <script src="{{asset('js/plugins/autoNumeric.js')}}"></script>

  <!--  Google Maps Plugin    -->
  <!-- <script  src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> -->

  <!-- Chartist JS -->
  <script src="{{asset('js/plugins/chartist.min.js')}}"></script>

  <!--  Notifications Plugin    -->
  <script src="{{asset('js/plugins/bootstrap-notify.js')}}"></script>

  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{asset('js/material-dashboard.min.js')}}" type="text/javascript"></script>
  <script type="text/javascript" src="{{asset('datatables/datatables.min.js')}}"></script>
  <script type="text/javascript">
    jQuery(document).ready(function($) {
      $('.linumeric').autoNumeric('init');
      $('#cetak').click(function(event) {
        /* Act on the event */
        $.ajax({
          url: '/add_riw_adm',
          type: 'POST',
          dataType: 'JSON',
          data: {_token: '{{ csrf_token() }}'},
        })
        .done(function() {
          window.print();
        })
        .fail(function() {
          console.log("error");
        })
        .always(function() {
          console.log("complete");
        });
        
      });
    });
  </script>
</body>
</html>
