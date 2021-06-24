<?php 

  use Illuminate\Support\Facades\DB;

  $tahun_ajaran = DB::table('tahun_ajaran')->select("*")->first();
  // dd($tahun_ajaran);
?>

<!doctype html>

<html lang="en">

<head>
  <title>{{ $title }}</title>
  <!-- Required meta tags -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- Material Kit CSS -->
  <link href="{{url('assets/css/material-dashboard.css')}}" rel="stylesheet" />
  <link href="{{url('assets/css/sweetalert2.min.css')}}" rel="stylesheet" />
  <link href="{{url('assets/fontawesome/css/all.css')}}" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="{{url('assets/datatables/datatables.min.css')}}"/>
  <link rel="stylesheet" type="text/css" href="{{url('assets/date_picker_range/daterangepicker.css')}}"/>
  <link rel="icon" href="{{ url('assets/img/logo_sekolah.png')}}">
</head>
<style type="text/css">
  .texttop{
    vertical-align: top;
  }
  .bg-purple{
    background-color: #9c27b0; 
  }
  .active-purple{
    background-color: #9c27b0; 
    color: white;
    transition: background-color 1s;
  }
  .active-purple > span i{
    color: white !important;
  }
  .active-purple a:hover{
    background-color: rgba(200, 200, 200, 0.2);
    color: #3C4858;
    box-shadow: none;

  }
  .menu-dropdown{
    overflow: hidden;
    height: 0;
    transition: height 0.5s;
  }
  .menu-dropdownAdministrasi{
    overflow: hidden;
    height: 0;
    transition: height 0.5s;
  }
  .link-menu-dropdown{
    width: 100%;
    display: inline-block;
    margin: auto !important;
    padding: 0rem 1rem 0rem 1rem !important;
  }

  #dropdownMenu .show-menu-dropdown{
      height: 110px !important;
      transition: height 0.5s;
       margin-top:20px !important ;
      margin-bottom: 20px !important;

  }
  #dropdownMenu > .card {
    margin-top: 0px ;
    margin-bottom: 0px ;
  }
  #dropdownMenuAdministrasi .show-menu-dropdown{
      height: 110px !important;
      transition: height 0.5s;
       margin-top:20px !important ;
      margin-bottom: 20px !important;

  }
  #dropdownMenuAdministrasi > .card {
    margin-top: 0px ;
    margin-bottom: 0px ;
  }
  
  .link-menu:hover, .link-menu-administrasi:hover{
    cursor: pointer;
  }

  #arrow i{
    transform: rotate(0deg);
    transition: transform 0.5s;
  }
  #arrow .arrow-hidden{
    transform: rotate(90deg);
    transition: transform 0.5s;
  }
  #arrowAdministrasi i{
    transform: rotate(0deg);
    transition: transform 0.5s;
  }
  #arrowAdministrasi .arrow-hidden{
    transform: rotate(90deg);
    transition: transform 0.5s;
  }
</style>

<body>


  <div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white" style="overflow-y: visible; scrollbar-width: none; overflow-x: hidden;">
      <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
      <div class="logo">
        <a href="http://www.alhikmahmalang.com" class="simple-text logo-mini">
          <img src="{{ url('assets/img/logo_sekolah.png') }}" style="width: 15%;">
        </a>
        <a href="http://www.creative-tim.com" class="simple-text logo-normal font-weight-bold">
          SMAI AL-HIKMAH 
         
          <?php 

           if(!$tahun_ajaran == null){
              echo "<div><small>TAHUN AJARAN ".$tahun_ajaran->tahun_awal." - ".$tahun_ajaran->tahun_akhir."</small></div>";
            }
          ?>
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav " >
          <li class="nav-item @if ($active == 1) active @endif " >
            <a class="nav-link " href="dashboard" >
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
           
          </li>



          <li class="nav-item @if ($active == 2) active @endif ">
            <a class="nav-link" href="pemasukan">
              <i class="material-icons"> arrow_downward</i>
              <p>Pemasukan</p>
            </a>
          </li>
         
           <li class="nav-item @if ($active == 3) active @endif ">
            <a class="nav-link" href="pengeluaran">
              <i class="material-icons">arrow_upward</i>
              <p>Pengeluaran</p>
            </a>
          </li>
         
            
          <li class="nav-item" style="margin: 10px 15px 0; ">
            <div id="dropdownMenuAdministrasi" class="nav-link  @if ($active == 4) active-purple @endif "  style="border-radius: 3px;">
              <span class="link-menu-administrasi pb-2">
                <i class="material-icons">toys</i>
                <p  id="arrowAdministrasi">Administrasi <i class="material-icons float-right mr-0 @if ($active == 4) arrow-hidden @endif">keyboard_arrow_right</i></p>
              </span>
              
              <div class="card menu-dropdownAdministrasi @if ($active == 4) show-menu-dropdown @endif ">
                <div class="card-body p-2" style="line-height: 3rem;">
                  <a class="link-menu-dropdown" href="administrasi">Dasar</a>
                  <a class="link-menu-dropdown" href="tanggungan_ijazah">Ijazah</a>
                </div>
              </div>
            </div>
            
          </li>
          <li class="nav-item" style="margin: 10px 15px 0; ">
            <div id="dropdownMenu" class="nav-link  @if ($active == 5) active-purple @endif "  style="border-radius: 3px;">
              <span class="link-menu pb-2">
                <i class="material-icons">face</i>
                <p  id="arrow">Data Siswa <i class="material-icons float-right mr-0 @if ($active == 5) arrow-hidden @endif">keyboard_arrow_right</i></p>
              </span>
              
              <div class="card menu-dropdown @if ($active == 5) show-menu-dropdown @endif ">
                <div class="card-body p-2" style="line-height: 3rem;">
                  <a class="link-menu-dropdown" href="siswa">Siswa Aktif</a>
                  <a class="link-menu-dropdown" href="alumni">Siswa Alumni</a>
                </div>
              </div>
            </div>
            
          </li>

          <li class="nav-item @if ($active == 6) active @endif ">
            <a class="nav-link" href="riwayat_laporan">
              <i class="material-icons"> local_printshop</i>
              <p>Riwayat Laporan</p>
            </a>
          </li>
          <li class="nav-item @if ($active == 7) active @endif ">
            <a class="nav-link" href="cetak_rekapitulasi" target="_blank">
              <i class="material-icons">history_edu</i>
              <p>Rekapitulasi</p>
            </a>
          </li>
          <li class="nav-item @if ($active == 8) active @endif ">
            <a class="nav-link" href="tanggungan_lalu">
              <i class="material-icons">low_priority</i>
              <p>Tanggungan Lalu</p>
            </a>
          </li>
          <!-- your sidebar here -->
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="javascript:;">{{ $title }}</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
              <li class="nav-item">
                <div class="btn-group ml-1">
                  <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user-secret fa-lg"></i> {{Auth()->user()->name}}
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="ubahpassowrd" data-toggle="modal" data-target="#modalPassword">Ubah Password</a>
                    <a class="dropdown-item updatetggprev" href="/updatetggprev" >Update Data Tanggungan Prev</a>
                    <a class="dropdown-item updatetthnajaran" data-toggle="modal" data-target="#modalTahunAjaran" href="updatetthnajaran" >Tahun Ajaran</a>
                    <a class="dropdown-item" href="/logout">Logout</a>
                  </div>
                </div>
              </li>

              <li id="addpemasukan" class="nav-item" data-toggle="modal" data-target="#modalPemasukan">
                <a class="nav-link text-white btn-success" href="#" >
                  <i class="fas fa-plus-circle fa-lg"></i> <span class="ml-1">Tambah Pemasukkan</span>
                </a>
              </li>
              <li id="addpengeluaran" class="nav-item" data-toggle="modal" data-target="#modalPengeluaran">
                <a class="nav-link text-white btn-danger" href="#">
                  <i class="fas fa-plus-circle fa-lg"></i> <span class="ml-1">Tambah Pengeluaran</span>
                </a>
              </li>
          
              <!-- your navbar here -->
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <!-- your content here -->
          @yield('content')
        </div>
      </div>
      <footer class="footer">
        <div class="container-fluid">
          <nav class="float-left">
            <ul>
              <li>
                <a href="#">
                  ARJATI TEKHNO
                </a>
              </li>
            </ul>
          </nav>
          <div class="copyright float-right">
            &copy;
            <script>
              document.write(new Date().getFullYear())
            </script>, made with <i class="material-icons">favorite</i> by
            <a href="https://www.creative-tim.com" target="_blank">ARJATI TEHKNO</a> Developer Web and Android.
          </div>
          <!-- your footer here -->
        </div>
      </footer>
    </div>
  </div>
<!-- modal pemsukan -->

<div class="modal fade" id="modalPemasukan" tabindex="-1" role="">
    <div class="modal-dialog modal-login" role="document">
        <div class="modal-content">
            <div class="card card-signup card-plain">
                <div class="modal-header">
                  <div class="card-header card-header-success w-100 text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                      <i class="material-icons">clear</i>
                    </button>

                    <h4 class="card-title">Tambah Pemasukkan</h4>
                    
                  </div>
                </div>
                <div class="modal-body">
                    <form id="form_data_pemasukan" class="form" method="" action="">
                        @csrf
                        <div class="card-body">

                            <div class="form-group bmd-form-group">
                               <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text">
                                      <i class="material-icons">face</i>
                                    </span>
                                  </div>
                                  <select class="form-control" data-style="btn btn-link" id="select_siswa" name="nama">
                                    
                                    
                                  </select>
                                </div>
                            </div>
                            <div class="input-group">
                              <div class="input-group-prepend" >
                                <span class="input-group-text bg-dark m-2 text-white rounded " style="width: 100px;">
                                    SPP
                                </span>
                              </div>
                              <input type="text" class="form-control text-right pr-2 input" data-a-dec="." name="spp" placeholder="0">
                            </div>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text bg-dark m-2 text-white rounded" style="width: 100px;">
                                    PSB
                                </span>
                              </div>
                              <input type="text" class="form-control text-right pr-2 input" data-a-dec="." name="psb" placeholder="0">
                            </div>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text bg-dark m-2 text-white rounded" style="width: 100px;">
                                    PAS 1
                                </span>
                              </div>
                              <input type="text" class="form-control text-right pr-2 input" name="pas_1" data-a-dec="." placeholder="0">
                            </div>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text bg-dark m-2 text-white rounded" style="width: 100px;">
                                    PAS 2
                                </span>
                              </div>
                              <input type="text" class="form-control text-right pr-2 input" name="pas_2" data-a-dec="." placeholder="0">
                            </div>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text bg-dark m-2 text-white rounded" style="width: 100px;">
                                    UTS 1
                                </span>
                              </div>
                              <input type="text" class="form-control text-right pr-2 input" name="uts_1"  data-a-dec="." placeholder="0">
                            </div>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text bg-dark m-2 text-white rounded" style="width: 100px;">
                                    UTS 2
                                </span>
                              </div>
                              <input type="text" class="form-control text-right pr-2 input" name="uts_2" data-a-dec="." placeholder="0">
                            </div>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text bg-dark m-2 text-white rounded" style="width: 100px;">
                                    LKS 1
                                </span>
                              </div>
                              <input type="text" class="form-control text-right pr-2 input" name="lks_1" data-a-dec="." placeholder="0">
                            </div>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text bg-dark m-2 text-white rounded" style="width: 100px;">
                                    LKS 2
                                </span>
                              </div>
                              <input type="text" class="form-control text-right pr-2 input" name="lks_2" data-a-dec="." placeholder="0">
                            </div>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text bg-dark m-2 text-white rounded" style="width: 100px;">
                                    UNAS
                                </span>
                              </div>
                              <input type="text" class="form-control text-right pr-2 input" name="unas" data-a-dec="." placeholder="0">
                            </div>
                             <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text bg-dark m-2 text-white rounded" style="width: 100px;">
                                    Daftar Ulang
                                </span>
                              </div>
                              <input type="text" class="form-control text-right pr-2 input" name="daftar_ulang" data-a-dec="." placeholder="0">
                            </div>

                            <!-- acuan tgg prev -->
                            <div class="display-tgg-prev mt-2">
                              <div class="bg-danger p-2 text-white rounded">Tanggungan Sebelumnya</div>
                              <form class="form" method="" action="">
                              @csrf
                                  <div class="form-group">
                                     <select class="form-control" data-style="btn btn-link" id="select_tgg_prev" name="title_tgg_prev">
                                    
                                    
                                  </select>
                                  </div>
                                   <div class="input-group">
                                      <input type="text" class="form-control text-right" name="nominal_tgg_prev" data-a-dec="." placeholder="Nominal">
                                      <span class="input-group-btn">
                                          <button type="button" class="btn btn-fab btn-round btn-primary add-tgg-prev">
                                              <i class="material-icons">add_circle</i>
                                          </button>
                                      </span>
                                  </div>
                              </form>
                              <div style="width: 100%;">
                                <!-- data tgg prev -->
                                <ul class="data-tgg-prev" style="display: contents; list-style: none;">
                                  
                                </ul>
                              </div>
                            </div>



                            <div style="display: block; width: 100%; border: 1px solid green; padding: 20px; margin-top:10px; text-align: center; border-radius: 0.3rem; font-weight: bold;">
                              <div style="position: absolute;margin-top: -2rem;background: white;padding: 0px 10px 0px 10px;letter-spacing: 0.1rem;color: #38823b;">Total</div>
                             <span class="total">0</span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-center">
                    <a id="simpan_pemasukan" href="#pablo" class="btn btn-primary btn-link btn-wd btn-lg">Simpan</a>
                    <button id="clear_pemasukan" type="button" class="btn btn-danger btn-link btn-wd btn-lg">Clear</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal pengeluaran -->
<div class="modal fade" id="modalPengeluaran" tabindex="-1" role="">
    <div class="modal-dialog modal-login" role="document">
        <div class="modal-content">
            <div class="card card-signup card-plain">
                <div class="modal-header">
                  <div class="card-header card-header-danger w-100 text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                      <i class="material-icons">clear</i>
                    </button>

                    <h4 class="card-title">Tambah Pengeluaran</h4>
                    
                  </div>
                </div>
                <div class="modal-body">
                    <form class="form" method="" action="">
                      @csrf
                          <div class="form-group">
                              <input type="text" class="form-control" placeholder="Title" name="key" data-a-dec=".">
                          </div>
                           <div class="input-group">
                              <input type="text" class="form-control text-right" name="nominal_data" data-a-dec="." placeholder="Nominal">
                              <span class="input-group-btn">
                                  <button type="button" class="btn btn-fab btn-round btn-primary add-data">
                                      <i class="material-icons">add_circle</i>
                                  </button>
                              </span>
                          </div>
                      </form>
                    <div class="card p-4">
                      <div class="card-body">
                        <h4 class="text-center font-weight-bold">Uraian</h4>
                        <hr>
                        <div style="width: 100%;">
                          <!-- data uraian -->
                          <ul class="data-uraian" style="display: contents; list-style: none;">
                            
                          </ul>
                        </div>
                          <div style="display: block; width: 100%; border: 1px solid green; padding: 20px; margin-top:10px; text-align: center; border-radius: 0.3rem; font-weight: bold;">
                              <div style="position: absolute;margin-top: -2rem;background: white;padding: 0px 10px 0px 10px;letter-spacing: 0.1rem;color: #38823b;">Total</div>
                             <span class="totalbiaya">0</span>
                          </div>
                      </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button id="save_pengeluaran" type="button" class="btn btn-primary btn-link btn-wd btn-lg">Simpan</button>
                    <button id="clear_pengeluaran" type="button" class="btn btn-danger btn-link btn-wd btn-lg">Clear</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->
<!-- modal password -->
<!-- <div class="modal" id="modalPassword" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ubah Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Modal body text goes here.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div> -->
<!-- modal password -->
<div class="modal fade" id="modalPassword" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <i class="material-icons">lock</i>
        <h5 class="modal-title"> Ubah Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ url('change_pass') }}">
        @csrf
        <div class="form-group">
          <label for="exampleInputEmail1">Password Lama</label>
          <input id="input_pass_lama" type="password" class="form-control" name="current_password" autocomplete="current_password">
          <small id="alert_pass_lama" class="form-text text-danger"></small> 
          
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Password Baru</label>
          <input id="input_pass_baru" type="password" class="form-control" name="password_baru" autocomplete="change_pass">
          <small id="alert_pass_baru" class="form-text text-danger"></small> 

        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Konfirmasi Password Baru</label>
          <input id="input_pass_baru_confirm" type="password" class="form-control" name="confirm_password_baru" autocomplete="change_pass">
          <small id="alert_pass_baru_confirm" class="form-text text-danger"></small> 

        </div>
        
      


      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- end modal -->
<!-- modal tahun ajaran -->
<div class="modal fade" id="modalTahunAjaran" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tahun Ajaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form_tahun_ajaran" action="/simpan_tahun_ajaran/1" method="POST">
          @csrf
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="material-icons">flight_takeoff</i>
                </span>
              </div>
              <select class="form-control" data-style="btn btn-link" id="tahun_ajaran_awal_select" name="tahun_awal">
               
              </select>
            </div>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="material-icons">flight_land</i>
                </span>
              </div>
              <select class="form-control" data-style="btn btn-link" id="tahun_ajaran_akhir_select" name="tahun_akhir">
                
              </select>
            </div>
        
        

      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-primary" value="Simpan">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
      </form>
    </div>
  </div>
</div>


<script src="{{url('assets/js/core/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{url('assets/js/core/popper.min.js')}}" type="text/javascript"></script>
<script src="{{url('assets/js/core/bootstrap-material-design.min.js')}}" type="text/javascript"></script>
<script src="{{url('assets/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
<script type="text/javascript" src="{{url('assets/fontawesome/js/all.js')}}"></script>
<!--  Google Maps Plugin    -->
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> -->
<!-- Chartist JS -->
<!-- Plugin for the momentJs  -->
  <script src="{{url('assets/js/plugins/moment.min.js')}}"></script>

  <!--  Plugin for Sweet Alert -->
  <script src="{{url('assets/js/plugins/sweetalert2.min.js')}}"></script>

  <!-- Forms Validations Plugin -->
  <script src="{{url('assets/js/plugins/jquery.validate.min.js')}}"></script>

  <!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
  <script src="{{url('assets/js/plugins/jquery.bootstrap-wizard.js')}}"></script>

  <!--  Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
  <script src="{{url('assets/js/plugins/bootstrap-selectpicker.js')}}" ></script>

  <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
  <script src="{{url('assets/js/plugins/bootstrap-datetimepicker.min.js')}}"></script>

  <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
  <script src="{{url('assets/js/plugins/jquery.datatables.min.js')}}"></script>

  <!--  Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
  <script src="{{url('assets/js/plugins/bootstrap-tagsinput.js')}}"></script>

  <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
  <script src="{{url('assets/js/plugins/jasny-bootstrap.min.js')}}"></script>

  <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
  <script src="{{url('assets/js/plugins/fullcalendar.min.js')}}"></script>

  <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
  <script src="{{url('assets/js/plugins/jquery-jvectormap.js')}}"></script>

  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="{{url('assets/js/plugins/nouislider.min.js')}}" ></script>

  <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>

  <!-- Library for adding dinamically elements -->
  <script src="{{url('assets/js/plugins/arrive.min.js')}}"></script>
  <script src="{{url('assets/js/plugins/autoNumeric.js')}}"></script>

  <!--  Google Maps Plugin    -->
  <!-- <script  src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> -->

  <!-- Chartist JS -->
  <script src="{{url('assets/js/plugins/chartist.min.js')}}"></script>

  <!--  Notifications Plugin    -->
  <script src="{{url('assets/js/plugins/bootstrap-notify.js')}}"></script>

  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{url('assets/js/material-dashboard.min.js')}}" type="text/javascript"></script>
  <script type="text/javascript" src="{{url('assets/datatables/datatables.min.js')}}"></script>
  <script type="text/javascript" src="{{url('assets/date_picker_range/daterangepicker.js')}}"></script>
  <script src="{{url('assets/js/plugins/jquery.md5.js')}}"></script>
  

  <script type="text/javascript">
    chart_1();
    chart_2();
    select_picker();

    function select_picker() {
        var html_option_awal = "<option selected>2019</option>";
        var html_option_akhir = "<option selected>2019</option>";
        var value_tahun_awal = "{{ $tahun_ajaran->tahun_awal }}";
        var value_tahun_akhir = "{{ $tahun_ajaran->tahun_akhir }}";
        for (var i = 2020; i <= 2050; i++) {
          if (i == value_tahun_awal) {
              html_option_awal += "<option selected>"+i+"</option>";
          }else{
              html_option_awal += "<option >"+i+"</option>";
          }
          if (i == value_tahun_akhir) {
             html_option_akhir += "<option selected>"+i+"</option>";
          }else{
            html_option_akhir += "<option >"+i+"</option>";
          }
         
        }


        $("#tahun_ajaran_awal_select").html(html_option_awal);
        $("#tahun_ajaran_akhir_select").html(html_option_akhir);
      }
     
    function chart_1() {
      $.ajax({
        url: '/chart_pemasukan',
        type: 'GET',
        dataType: 'JSON',
        data: {_token: '{{ csrf_token() }}'},
      })
      .done(function(data) {
        var dataArray = [];
        
        for (var i = 0; i < data.data.length; i++) {
          
          dataArray.push(data.data[i].total)
        }
        //alert pemsukan
          var pem_1;
          var pem_2;
            
          if (data.pemasukan.length == 2) {
              pem_1 = data.pemasukan[0].total;
              pem_2 = data.pemasukan[1].total;
          }
          if (data.pemasukan.length == 1) {
              pem_1 = data.pemasukan[0].total;
              pem_2 = 0;
          }
           if (data.pemasukan.length == 0) {
              pem_1 = 0;
              pem_2 = 0;
          }
         if ( pem_1 > pem_2 ) {
            $('.alert-pemasukan').html('<span class="text-success"><i class="fas fa-check-circle"></i> Pemasukan mengalami kenaikan</span>');
          }else if(pem_1 < pem_2){
            $('.alert-pemasukan').html('<span class="text-danger"><i class="fas fa-exclamation-circle"></i> Pemasukan mengalami penurunan</span>');
          }else if(pem_1 == pem_2){
            $('.alert-pemasukan').html('<span class="text-warning"><i class="fas fa-exclamation-triangle"></i> Pemasukan masih sama</span>');
          }


        new Chartist.Bar('.ct-chart', {
          labels: ['1', '2', '3', '4','5', '6', '7'],
          series: [
            dataArray
          ]
        },{
            fullWidth: true,
            chartPadding: {
              left: 40,
              top:20
            },
            referenceValue: 5,
            scaleMinSpace: 20,
            low: 0,
            high:100000000,
            height: '400px',
            axisY: {
                 scaleMinSpace: 30
            }
          });
        // endchart

          
       
      })
      .fail(function() {
        console.log("error");
      })
      .always(function() {
        console.log("complete");
      });
      
    }
    
     function chart_2() {
       $.ajax({
         url: '/chart_pengeluaran',
         type: 'GET',
         dataType: 'JSON',
         data: {_token: '{{ csrf_token() }}'},
       })
       .done(function(data) {
          console.log(data);
          var dataArray = [];
          for (var i = 0; i < data.pengeluaran.length; i++) {
            dataArray.push(data.pengeluaran[i].total)
          }
          var peng_1;
          var peng_2;
            
          if (data.pengeluaran.length == 2) {
              peng_1 = data.pengeluaran[0].total;
              peng_2 = data.pengeluaran[1].total;
          }
          if (data.pengeluaran.length == 1) {
              peng_1 = data.pengeluaran[0].total;
              peng_2 = 0;
          }
           if (data.pengeluaran.length == 0) {
              peng_1 = 0;
              peng_2 = 0;
          }   
         if ( peng_1 < peng_2 ) {
            $('.alert-pengeluaran').html('<span class="text-success"><i class="fas fa-check-circle"></i> Pengeluaran mengalami kenaikan</span>');
          }else if(peng_1 > peng_2){
            $('.alert-pengeluaran').html('<span class="text-danger"><i class="fas fa-exclamation-circle"></i> Pengeluaran mengalami penurunan</span>');
          }else if(peng_1 == peng_2){
            $('.alert-pengeluaran').html('<span class="text-warning"><i class="fas fa-exclamation-triangle"></i> Pengeluaran masih sama</span>');
          }
           
          new Chartist.Line('#ct-chart2', {
              labels: ['1', '2', '3', '4','5', '6', '7'],
              series: [
                  dataArray
                  ]
                },{
                    fullWidth: true,
                    chartPadding: {
                      left: 40,
                      top:20
                    },
                    low: 0,
                    high:100000000,
                    height: '400px',
                    axisY: {
                         scaleMinSpace: 30
                    }
                  });
       })
       .fail(function() {
         console.log("error");
       })
       .always(function() {
         console.log("complete");
       });
       
     }
    
  // $(document).bind('keypress', function(event) {
  //   var data_elu = 0;
  //   if( event.which == 80 && event.which == 18 ) {

  //       $('#modalPassword').modal('show');
  //     }
  // });



  //crud
  jQuery(document).ready(function() {
      var data = [];
      var data_tgg_prev = [];
      var i = 0;
      var anjayani = 0;
      
      $('.linumeric').autoNumeric('init',{aPad:false});
      $('#addpemasukan').click(function(event) {
        read_siswa();
        $('input[name=nominal_tgg_prev]').autoNumeric('init',{aPad:false});
        $('input[name=nominal_lain]').autoNumeric('init',{aPad:false});
      });
      function read_siswa() {
        $.ajax({
          url: '/read_siswa',
          type: 'POST',
          dataType: 'JSON',
          async:false,
          data : {_token: '{{ csrf_token() }}' }
        })
        .done(function(data) {
          var html = '';
          html+='<option class="text-muted" disabled="" selected="">Pilih Siswa</option>';
          for (var i = 0; i < data.length; i++) {
            html += '<option value="'+data[i].no_induk+'"">'+data[i].nama+'</option>';
          }
          $('input[name=spp],input[name=psb],input[name=uts_1],input[name=uts_2],input[name=pas_1],input[name=pas_2],input[name=lks_1],input[name=lks_2],input[name=unas],input[name=daftar_ulang]').autoNumeric('init',{aPad: false});
          $('#select_siswa').html(html);
        })
        .fail(function() {
          console.log("error");
        })
        .always(function() {
          console.log("complete");
        });

        
      }
      function read_tgg_prev_by(id) {
        // body...
        $.ajax({
          url: '/tgg_prev_by/'+id,
          type: 'POST',
          dataType: 'JSON',
          data: {_token: '{{ csrf_token() }}'},
        })
        .done(function(data) {
          
          var value = data;
          var html = '';
   
          html+='<option class="text-muted" disabled="" selected="">Pilih Tanggungan</option>';
          for (var i = 0; i < value.length; i++) {
            if (value[i].spp != 0 ) {
              var data = ["SPP",value[i].kelas_prev];
              html+='<option class="text-justify" value="'+data+'">SPP '+value[i].kelas_prev+'</option>';
            }
            if (value[i].psb != 0 ) {
              var data = ["PSB",value[i].kelas_prev];
              html+='<option class="text-justify" value="'+data+'">PSB '+value[i].kelas_prev+'</option>';
            }
            if (value[i].uts_1 != 0 ) {
             var data = ["UTS 1",value[i].kelas_prev];
              html+='<option class="text-justify" value="'+data+'">UTS 1 '+value[i].kelas_prev+'</option>';
            }
            if (value[i].uts_2 != 0 ) {
              var data = ["UTS 2",value[i].kelas_prev];
              html+='<option class="text-justify" value="'+data+'">UTS 2 '+value[i].kelas_prev+'</option>';
            }
            if (value[i].pas_1 != 0 ) {
              var data = ["PAS 1",value[i].kelas_prev];
              html+='<option class="text-justify" value="'+data+'">PAS 1 '+value[i].kelas_prev+'</option>';
            }
            if (value[i].pas_2 != 0 ) {
              var data = ["PAS 2",value[i].kelas_prev];
              html+='<option class="text-justify" value="'+data+'">PAS 2 '+value[i].kelas_prev+'</option>';
            }
            if (value[i].lks_1 != 0 ) {
              var data = ["LKS 1",value[i].kelas_prev];
              html+='<option class="text-justify" value="'+data+'">LKS 1 '+value[i].kelas_prev+'</option>';
            }
            if (value[i].lks_2 != 0 ) {
              var data = ["LKS 2",value[i].kelas_prev];
              html+='<option class="text-justify" value="'+data+'">LKS 2 '+value[i].kelas_prev+'</option>';
            }
          }
          

          $('#select_tgg_prev').html(html);
    
        })
        .fail(function() {
          console.log("error");
        })
        .always(function() {
          console.log("complete");
        });
        
      }
      $('#select_siswa').change(function () {
        var siswa = $(this).val();

        read_tgg_prev_by(siswa);

      })
   
     
      $('#addpengeluaran').click(function(event) {
         /* Act on the event */
         $('input[name=nominal_data]').autoNumeric('init',{aPad:false});

         
       });

      $('.add-data').click(function(event) {
         /* Act on the event */
        
        
         if ($('input[name=title]').val() != "") {
           var title = $('input[name=key]').val();
           var nominal = $('input[name=nominal_data]').val();
           var nominal_fix = nominal.replaceAll(',','');
           

           data.push({key:title,value:nominal_fix});
           console.log(data);
            var html = "<li class='data_ur'>"+ data[i].key +" <span class='float-right numeric-data font-weight-bold'>"+ data[i].value +"</span></li>";
            i++;
            var totalbiaya = 0;
            for (var a = 0; a < data.length; a++) {
              totalbiaya = totalbiaya + parseInt(data[a].value);

            }
            $('.totalbiaya').autoNumeric('init',{aPad: false, aSign:' Rp. '});
            $('.totalbiaya').autoNumeric('set',totalbiaya);
            $('.data-uraian').append(html);
            $('.numeric-data').autoNumeric('init',{aPad:false});
            

         }
        
         
         
       });
       $('.add-tgg-prev').click(function(event) {
         /* Act on the event */

          if ($('#select_tgg_prev').val() != "") {
            var tgg_data_spit = $('#select_tgg_prev').val();
           var title = tgg_data_spit.split(",");

           var nominal = $('input[name=nominal_tgg_prev]').val();
           var nominal_fix = nominal.replaceAll(',','');
           var siswa = $('#select_siswa').val();

          
          if (title[0] != null) {
              data_tgg_prev.push({tgg:title[0],kelas:title[1],no_induk:siswa,value:nominal_fix});          
              var html = "<li class='data_pem_li'>"+ data_tgg_prev[anjayani].tgg+" "+data_tgg_prev[anjayani].kelas+" <span class='float-right numeric-data font-weight-bold'>"+data_tgg_prev[anjayani].value +"</span></li>";
              anjayani++;
           
              $('.data-tgg-prev').append(html);
              $('.numeric-data').autoNumeric('init',{aPad:false});
          }
           
          
          hitung_pemasukan();
         }
       });
       
      var totalbiaya;
      $('#clear_pengeluaran').click(function(event) {
         /* Act on the event */
          $('.data_ur').remove();
          $('.totalbiaya').text('0');
          totalbiaya = 0;
          read_siswa();
          $('input[name=nominal_tgg_prev]').autoNumeric('init',{aPad:false});
          $('input[name=nominal_lain]').autoNumeric('init',{aPad:false});
       });
      $('#clear_pemasukan').click(function(event) {
         /* Act on the event */
         $('.data_pem_li').remove();
         $('#form_data_pemasukan .total').text('0');
         $('.input').val('');
         totalbiaya = 0;
         data_tgg_prev = [];
         anjayani=0;
       });
        
      $('#form_data_pemasukan input').keyup(function() {
     
        /* Act on the event */
        hitung_pemasukan();
       
      });
       //close
      
       function hitung_pemasukan() {
           

            totalbiaya = 0;
            var total_pemasukan = 0;
            var spp = $('#form_data_pemasukan input[name=spp]').val();
            var psb = $('#form_data_pemasukan input[name=psb]').val();
            var uts_1 = $('#form_data_pemasukan input[name=uts_1]').val();
            var uts_2 = $('#form_data_pemasukan input[name=uts_2]').val();
            var pas_1 = $('#form_data_pemasukan input[name=pas_1]').val();
            var pas_2 = $('#form_data_pemasukan input[name=pas_2]').val();
            var lks_1 = $('#form_data_pemasukan input[name=lks_1]').val();
            var lks_2 = $('#form_data_pemasukan input[name=lks_2]').val();
            var unas = $('#form_data_pemasukan input[name=unas]').val();
            var daftar_ulang = $('#form_data_pemasukan input[name=daftar_ulang]').val();

          
            if (spp == "") {
                spp = "0";
            }
            if (psb == "") {
                psb = "0";
            }
            if (uts_1 == "") {
                uts_1 = "0";
            }
            if (uts_2 == "") {
                uts_2 = "0";
            }
            if (pas_1 == "") {
                pas_1 = "0";
            }
            if (pas_2 == "") {
                pas_2 = "0";
            }
            if (lks_1 == "") {
                lks_1 = "0";
            }
            if (lks_2 == "") {
                lks_2 = "0";
            }
            if (unas == "") {
                unas = "0";
            }
            if (daftar_ulang == "") {
                daftar_ulang = "0";
            }
            total_pemasukan = total_pemasukan + parseInt(spp.replaceAll(',',''));
            total_pemasukan = total_pemasukan + parseInt(psb.replaceAll(',',''));
            total_pemasukan = total_pemasukan + parseInt(uts_1.replaceAll(',',''));
            total_pemasukan = total_pemasukan + parseInt(uts_2.replaceAll(',',''));
            total_pemasukan = total_pemasukan + parseInt(pas_1.replaceAll(',',''));
            total_pemasukan = total_pemasukan + parseInt(pas_2.replaceAll(',',''));
            total_pemasukan = total_pemasukan + parseInt(lks_1.replaceAll(',',''));
            total_pemasukan = total_pemasukan + parseInt(lks_2.replaceAll(',',''));
            total_pemasukan = total_pemasukan + parseInt(unas.replaceAll(',',''));
            total_pemasukan = total_pemasukan + parseInt(daftar_ulang.replaceAll(',',''));
            
            
            for (var a = 0; a < data_tgg_prev.length; a++) {
              totalbiaya = totalbiaya + parseInt(data_tgg_prev[a].value);

            }

          

            totalbiaya = totalbiaya + total_pemasukan;
            $('#form_data_pemasukan .total').autoNumeric('init',{aSign:' Rp. '});
            $('#form_data_pemasukan .total').autoNumeric('set',totalbiaya);
          
            // console.log(totalbiaya);


       }
       //fungsi simpan
      $('#simpan_pemasukan').click(function(event) {
        /* Act on the event */

        var datax = $('#form_data_pemasukan').serialize();
        var nama = $('select[name=nama]').val();
        if (nama == null) {
           Swal.fire(
            'Aduh !!',
            'Nama tidak boleh kosong',
            'warning'
          );
          return false;
        }
        var token = $('input[name=_token]').val();
        var spp = $('input[name=spp]').val();
        var psb = $('input[name=psb]').val();
        var uts_1 = $('input[name=uts_1]').val();
        var uts_2 = $('input[name=uts_2]').val();
        var pas_1 = $('input[name=pas_1]').val();
        var pas_2 = $('input[name=pas_2]').val();
        var lks_1 = $('input[name=lks_1]').val();
        var lks_2 = $('input[name=lks_2]').val();
        var unas = $('input[name=unas]').val();
        var daftar_ulang = $('input[name=daftar_ulang]').val();
        $.ajax({
          url: '/add_pemasukan',
          type: 'POST',
          dataType: 'JSON',
          data:{_token:token,no_induk:nama,spp:spp,psb:psb,uts_1:uts_1,uts_2:uts_2,pas_1:pas_1,pas_2:pas_2,lks_1:lks_1,lks_2:lks_2,unas:unas,daftar_ulang:daftar_ulang,tgg_prev:data_tgg_prev},
        })
        .done(function(data) {
          if (data.statusCode == 505) {
            Swal.fire(
              'Maaf !!',
              'Data Administrasi Masih Kosong',
              'error'
            );
          }else if(data.statusCode == 200){
            $('#modalPemasukan').modal('hide');
            Swal.fire(
              'Selamat',
              'Data Berhasil dimasukkan',
              'success'
            );
            var pesan = data.pesan;
            var open = 'https://kirimwa.id/'+data.no_tlp+':'+pesan;
            // window.location.href = "{{ url('pemasukan') }}";
            window.open(open, '_blank'); 
            window.open( '{{ url("cetak_struk") }}', '_blank'); 
          }
          

        })
        .fail(function() {
          console.log("error");
        })
        .always(function() {
          console.log("complete");
        });
        
      });



      $('#save_pengeluaran').click(function(event) {
         /* Act on the event */
         var total_biaya = 0;
         for (var i = 0; i < data.length; i++) {
           total_biaya = total_biaya + parseInt(data[i].value);
         }
           $.ajax({
             url: '/simpan_pengeluaran',
             type: 'POST',
             dataType: 'JSON',
             data: {_token:'{{ csrf_token()}}',uraian:data,total:total_biaya},
           })
           .done(function() {
            Swal.fire({
                title: 'Data Berhasil tersimpan !!',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Oke',
              }).then((result) => {
                if (result.isConfirmed) {
                  window.location.href = "{{ url('pengeluaran') }}";
                }

            })
             
           })
           .fail(function() {
             console.log("error");
           })
           .always(function() {
             console.log("complete");
           });
         
       });
      //updatetggprev
      $('.updatetggprev').click(function(event) {
        /* Act on the event */
        event.preventDefault();
        Swal.fire({
              title: 'Apakah anda yakin ingin mengupdate Tanggungan Siswa Sebelumnya ?',
              text: "Fitur ini akan memindahkan tanggungan siswa sekarang ke tanggungan siswa sebelumnya.",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Ya, lakukan sekarang!',
              cancelButtonText:'Batal'
            }).then((result) => {
              if (result.isConfirmed) {
                window.location.href = '{{ url("/updatetggprev") }}';
                 // $.ajax({
                 //        url: '/updatetggprev',
                 //        type: 'POST',
                 //        dataType: 'JSON',
                 //        data: {_token: '{{csrf_token()}}'},
                 //    })
                 //    .done(function() {
                 //        Swal.fire(
                 //            'Selamat !!',
                 //            'Data berhasil Terupdate',
                 //            'success'
                 //      );
                       
                 //    })
                 //    .fail(function() {
                 //        console.log("error");
                 //    })
                 //    .always(function() {
                 //        console.log("complete");
                 //    });
              }
            })
      });
      $('#input_pass_lama').keyup(function(event) {
        var value = $(this).val();
          $.ajax({
            url: '/checkPass',
            type: 'POST',
            dataType: 'JSON',
            data: {_token: '{{ csrf_token() }}',password_lama:value},
          })
          .done(function(data) {
            if (data == 500) {
               $('#alert_pass_lama').text('Password tidak sama');
            }else{
               $('#alert_pass_lama').text('');
            }
          })
          .fail(function() {
            console.log("error");
          })
          .always(function() {
            console.log("complete");
          });
      });
      var passbaru = "";
      var passbaru_confirm = "";
      $('#input_pass_baru').keyup(function(event) {
          var passbaru = $(this).val();
          var passbaru_confirm = $("#input_pass_baru_confirm").val();
          if (passbaru != passbaru_confirm) {
              $('#alert_pass_baru').text('Password tidak sama');
          }else{
              $('#alert_pass_baru_confirm').text('');
              $('#alert_pass_baru').text('');
          }
      });
      $('#input_pass_baru_confirm').keyup(function(event) {
          var passbaru = $("#input_pass_baru").val(); 
          var passbaru_confirm = $(this).val();
          if (passbaru != passbaru_confirm) {
              $('#alert_pass_baru_confirm').text('Password tidak sama');
          }else{
              $('#alert_pass_baru_confirm').text('');
               $('#alert_pass_baru').text('');
          }
      });
  
     $('.link-menu').click(function(event) {
       $('.menu-dropdown').toggleClass('show-menu-dropdown');
       $('#dropdownMenu').toggleClass(' active-purple');
       $('#arrow > i').toggleClass('arrow-hidden');
     });
     $('.link-menu-administrasi').click(function(event) {
       $('.menu-dropdownAdministrasi').toggleClass('show-menu-dropdown');
       $('#dropdownMenuAdministrasi').toggleClass(' active-purple');
       $('#arrowAdministrasi > i').toggleClass('arrow-hidden');
     });


   });
   $(function () {
    $('[data-toggle="popover"]').popover()
  }) 

  </script>
   @stack('javascript')

  </body>
</html>