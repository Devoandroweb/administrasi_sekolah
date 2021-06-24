<?php 

use App\Helpers\Time;
?>

<!doctype html>
<html lang="en">

<head>
  <title>Pengeluaran | Print</title>
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
  .cetak{
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
  .cetak:hover {
    cursor: pointer;
  }
  @media-print{
    .cetak{
      display: none;
    }
  }
</style>
<body>
  <div class="cetak">
    <div style="margin: auto; display: flex; align-items: center;">
      <i class="material-icons">print</i><strong>Print</strong>
    </div>
    
  </div>
<div class="container">
  

      <div class="card m-4">
        <div class="card-body">
          <h4 class="text-center font-weight-bold">Pengeluaran</h4>
          <table class="table mt-4">
            <thead class="bg-info">
              <tr>
                <th class="font-weight-bold text-center">No</th>
                <th class="font-weight-bold text-center">Tanggal</th>
                <th class="font-weight-bold text-center">Uraian</th>
                <th class="font-weight-bold text-center">Total</th>
           

              </tr>
            </thead>
            <tbody>
              <?php $totalall = 0; ?>
             @foreach($data_pengeluaran as $key)

                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><?php $date_indo = Time::time_indo_convert(strtotime($key->created_at)); echo $date_indo[0]; ?></td>
                    <td><?php
                        $uraian = json_decode($key->uraian);
        
                        $html = "<ul>";
                        for ($i=0; $i < count($uraian); $i++) { 
                           
                            $html .= "<li class='text-justify' style='list-style:none; display:content;'><label class='font-weight-bold'>".$uraian[$i]->key."</label><span class='linumeric float-right'>".$uraian[$i]->value."</span>";
                        }
                        $html .= "</li></ul>";
                        echo $html;
                       
                     ?></td>
                     <td class="linumeric" style="text-align:right;" data-a-dec="."><?php 

                      $uraian = json_decode($key->uraian);
                      $total = 0;
                      for ($i=0; $i < count($uraian); $i++) { 
                         $total = $total + $uraian[$i]->value;
                      }
                      $totalall = $total;
                      echo $total;
                      ?></td>
                     
                     
                  </tr>
              @endforeach
              <tr  style="background: bisque;">
                <td></td>
                <td></td>
                <td></td>
        
                <td class="text-right font-weight-bold numerikalltotal">{{ $totalall }}</td>
                

              </tr>
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
      $('.numerikalltotal').autoNumeric('init',{aSign:' Rp. '});
      $('.cetak').click(function(event) {
        /* Act on the event */
        $.ajax({
          url: '/add_riw_pengeluaran',
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
