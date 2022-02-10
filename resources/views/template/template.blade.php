@include('template.head')
<?php

use Illuminate\Support\Facades\DB;

$tahun_ajaran = DB::table('tahun_ajaran')->select("*")->first();
// dd($tahun_ajaran);
?>
<style type="text/css">
  .texttop {
    vertical-align: top;
  }

  .bg-purple {
    background-color: #9c27b0;
  }

  .active-purple {
    background-color: #9c27b0;
    color: white;
    transition: background-color 0.5s;
  }

  .active-purple>span i {
    color: white !important;
  }

  .active-purple a:hover {
    background-color: rgba(200, 200, 200, 0.2);
    color: #3C4858;
    box-shadow: none;

  }

  .menu-dropdown {
    overflow: hidden;

    max-height: 0vh;
    transition: all 0.1s;
  }

  .menu-dropdownAdministrasi {
    overflow: hidden;
    height: 0vh;
    transition: height 0.1s;
  }

  .link-menu-dropdown {
    width: 100%;
    display: inline-block;
    margin: auto !important;
    padding: 0rem 1rem 0rem 1rem !important;
  }

  #dropdownMenu .show-menu-dropdown {
    max-height: 100vh !important;
    margin-top: 20px !important;
    margin-bottom: 20px !important;
    display: inline-table;
    background-color: #fff;
    transition: all 1s;

  }

  #dropdownMenu>.card {
    margin-top: 0px;
    margin-bottom: 0px;
  }

  #dropdownMenuAdministrasi .show-menu-dropdown {
    height: 110px !important;
    transition: height 0.5s;
    margin-top: 20px !important;
    margin-bottom: 20px !important;

  }

  #dropdownMenuAdministrasi>.card {
    margin-top: 0px;
    margin-bottom: 0px;
  }

  .link-menu:hover,
  .link-menu-administrasi:hover {
    cursor: pointer;
  }

  #arrow i {
    transform: rotate(0deg);
    transition: transform 0.5s;
  }

  #arrow .arrow-hidden {
    transform: rotate(90deg);
    transition: transform 0.5s;
  }

  #arrowAdministrasi i {
    transform: rotate(0deg);
    transition: transform 0.5s;
  }

  #arrowAdministrasi .arrow-hidden {
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
          <img src="{{ url('public/assets/img/logo_sekolah.png') }}" style="width: 15%;">
        </a>
        <a href="http://www.alhikmahmalang.com" class="simple-text logo-normal font-weight-bold">
          SMAI AL-HIKMAH

          <?php

          if (!$tahun_ajaran == null) {
            echo "<div><small>TAHUN AJARAN " . $tahun_ajaran->tahun_awal . " - " . $tahun_ajaran->tahun_akhir . "</small></div>";
          }
          ?>
        </a>
      </div>
      @if(Auth::user()->role == 2)
      @include("template.sidebar-administrasi")
      @elseif(Auth::user()->role == 1)
      @include("template.sidebar-admin")
      @endif
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
                    <a class="dropdown-item updatetggprev" href="/updatetggprev">Update Data Tanggungan Prev</a>
                    <a class="dropdown-item updatetthnajaran" data-toggle="modal" data-target="#modalTahunAjaran" href="updatetthnajaran">Tahun Ajaran</a>
                    <a class="dropdown-item" href="{{url('logout')}}">Logout</a>
                  </div>
                </div>
              </li>
              @if(Auth::user()->role == 2)
              <!-- <li id="addpemasukan" class="nav-item" data-toggle="modal" data-target="#modalPemasukan"> -->
              <li id="addpemasukan" class="nav-item">
                <a class="nav-link text-white btn-success" href="{{url('pembayaran')}}" target="_blank">
                  <i class="fas fa-plus-circle fa-lg"></i> <span class="ml-1">Pembayaran Siswa</span>
                </a>
              </li>
              <li id="addpengeluaran" class="nav-item" data-toggle="modal" data-target="#modalPengeluaran">
                <a class="nav-link text-white btn-danger" href="#">
                  <i class="fas fa-plus-circle fa-lg"></i> <span class="ml-1">Pengeluaran</span>
                </a>
              </li>
              @endif
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
                  
                </a>
              </li>
            </ul>
          </nav>
          <div class="copyright float-right">
            &copy;
            <script>
              document.write(new Date().getFullYear())
            </script><i class="material-icons">favorite</i> by
            <a href="https://www.creative-tim.com" target="_blank">MAHASISWA UNIRA</a>
          </div>
          <!-- your footer here -->
        </div>
      </footer>
    </div>
  </div>
  @include('template.modal')
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


  @include('template.include-js')

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
          html_option_awal += "<option selected>" + i + "</option>";
        } else {
          html_option_awal += "<option >" + i + "</option>";
        }
        if (i == value_tahun_akhir) {
          html_option_akhir += "<option selected>" + i + "</option>";
        } else {
          html_option_akhir += "<option >" + i + "</option>";
        }

      }


      $("#tahun_ajaran_awal_select").html(html_option_awal);
      $("#tahun_ajaran_akhir_select").html(html_option_akhir);
    }

    function chart_1() {
      $.ajax({
          url: "{{url('chart_pemasukan')}}",
          type: 'GET',
          dataType: 'JSON',
          data: {
            _token: '{{ csrf_token() }}'
          },
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
          if (pem_1 > pem_2) {
            $('.alert-pemasukan').html('<span class="text-success"><i class="fas fa-check-circle"></i> Pemasukan mengalami kenaikan</span>');
          } else if (pem_1 < pem_2) {
            $('.alert-pemasukan').html('<span class="text-danger"><i class="fas fa-exclamation-circle"></i> Pemasukan mengalami penurunan</span>');
          } else if (pem_1 == pem_2) {
            $('.alert-pemasukan').html('<span class="text-warning"><i class="fas fa-exclamation-triangle"></i> Pemasukan masih sama</span>');
          }


          new Chartist.Bar('.ct-chart', {
            labels: ['1', '2', '3', '4', '5', '6', '7'],
            series: [
              dataArray
            ]
          }, {
            fullWidth: true,
            chartPadding: {
              left: 40,
              top: 20
            },
            referenceValue: 5,
            scaleMinSpace: 20,
            low: 0,
            high: 100000000,
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
          url: "{{url('chart_pengeluaran')}}",
          type: 'GET',
          dataType: 'JSON',
          data: {
            _token: '{{ csrf_token() }}'
          },
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
          if (peng_1 < peng_2) {
            $('.alert-pengeluaran').html('<span class="text-success"><i class="fas fa-check-circle"></i> Pengeluaran mengalami kenaikan</span>');
          } else if (peng_1 > peng_2) {
            $('.alert-pengeluaran').html('<span class="text-danger"><i class="fas fa-exclamation-circle"></i> Pengeluaran mengalami penurunan</span>');
          } else if (peng_1 == peng_2) {
            $('.alert-pengeluaran').html('<span class="text-warning"><i class="fas fa-exclamation-triangle"></i> Pengeluaran masih sama</span>');
          }

          new Chartist.Line('#ct-chart2', {
            labels: ['1', '2', '3', '4', '5', '6', '7'],
            series: [
              dataArray
            ]
          }, {
            fullWidth: true,
            chartPadding: {
              left: 40,
              top: 20
            },
            low: 0,
            high: 100000000,
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

      $('#input_pass_lama').keyup(function(event) {
        var value = $(this).val();
        $.ajax({
            url: "{{url('checkPass')}}",
            type: 'POST',
            dataType: 'JSON',
            data: {
              _token: '{{ csrf_token() }}',
              password_lama: value
            },
          })
          .done(function(data) {
            if (data == 500) {
              $('#alert_pass_lama').text('Password tidak sama');
            } else {
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
        } else {
          $('#alert_pass_baru_confirm').text('');
          $('#alert_pass_baru').text('');
        }
      });
      $('#input_pass_baru_confirm').keyup(function(event) {
        var passbaru = $("#input_pass_baru").val();
        var passbaru_confirm = $(this).val();
        if (passbaru != passbaru_confirm) {
          $('#alert_pass_baru_confirm').text('Password tidak sama');
        } else {
          $('#alert_pass_baru_confirm').text('');
          $('#alert_pass_baru').text('');
        }
      });

      $('.dropdownMenu').click(function(event) {
        $(this).find('.menu-dropdown').toggleClass('show-menu-dropdown');
        $(this).toggleClass('active-purple');
        $(this).find('#arrow > i').toggleClass('arrow-hidden');
      });

      $('.link-menu-administrasi').click(function(event) {
        $('.menu-dropdownAdministrasi').toggleClass('show-menu-dropdown');
        $('#dropdownMenuAdministrasi').toggleClass('active-purple');
        $('#arrowAdministrasi > i').toggleClass('arrow-hidden');
      });


    });
    $(function() {
      $('[data-toggle="popover"]').popover()
    })
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
  </script>
  @include('template.topbar-page-js');
  @stack('javascript')


</body>

</html>