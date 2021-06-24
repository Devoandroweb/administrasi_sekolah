<?php 

use App\Helpers\Time;
?>

<!doctype html>
<html lang="en">

<head>
  <title>Tanggungan Lalu | Print</title>
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
          <h4 class="text-center font-weight-bold">Tanggungan Sebelumnya</h4>
          <table class="table mt-4">
            <thead>
              <tr>
                <th class="font-weight-bold text-center">No</th>
                <th class="font-weight-bold text-center">Nama</th>
                <th class="font-weight-bold text-center">Kelas</th>
                <th class="font-weight-bold text-center">SPP</th>
                <th class="font-weight-bold text-center">PSB</th>
                <th class="font-weight-bold text-center">UTS 1</th>
                <th class="font-weight-bold text-center">UTS 2</th>
                <th class="font-weight-bold text-center">PAS 1</th>
                <th class="font-weight-bold text-center">PAS 2</th>
                <th class="font-weight-bold text-center">LKS 1</th>
                <th class="font-weight-bold text-center">LKS 1</th>
                <th class="font-weight-bold text-center">UNAS</th>
                <th class="font-weight-bold text-center">Daftar Ulang</th>
                <th class="font-weight-bold text-center">Total</th>

              </tr>
            </thead>
            <tbody>
             @foreach($tanggunganprev as $key)

                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $key->nama }}</td>
                    <td>{{ $key->kelas_prev }}</td>
                    <td class="text-right linumeric">{{ $key->spp }}</td>
                    <td class="text-right linumeric">{{ $key->psb }}</td>
                    <td class="text-right linumeric">{{ $key->uts_1 }}</td>
                    <td class="text-right linumeric">{{ $key->uts_2 }}</td>
                    <td class="text-right linumeric">{{ $key->pas_1 }}</td>
                    <td class="text-right linumeric">{{ $key->pas_2 }}</td>
                    <td class="text-right linumeric">{{ $key->lks_1 }}</td>
                    <td class="text-right linumeric">{{ $key->lks_1 }}</td>
                    <td class="text-right linumeric">{{ $key->unas }}</td>
                    <td class="text-right linumeric">{{ $key->daftar_ulang }}</td>
                     <td class="linumeric font-weight-bold" style="text-align:right;" data-a-dec="."><?php 

     
                      $total = 0;
                      $total = $total + $key->spp;
                      $total = $total + $key->psb;
                      $total = $total + $key->uts_1;
                      $total = $total + $key->uts_2;
                      $total = $total + $key->pas_1;
                      $total = $total + $key->pas_2;
                      $total = $total + $key->lks_1;
                      $total = $total + $key->lks_2;
                      $total = $total + $key->unas;
                      $total = $total + $key->daftar_ulang;
                      echo $total;
                      ?></td>
                     
                     
                  </tr>
              @endforeach
            </tbody>
          </table>
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
