@extends('template/template',['active' => $active ?? '2','title' => $title])




@section('content')
<style>
  @import url(https://fonts.googleapis.com/css?family=Lato:400,700);

  body {

    font-family: 'Lato';
  }

  .heading-primary {
    font-size: 2em;
    padding: 2em;
    text-align: center;
  }

  tbody>tr>td {
    vertical-align: top !important;
  }

  .accordion dl,
  .accordion-list {
    /* border: 1px solid #ddd; */

    &:after {
      content: "";
      display: block;
      height: 1em;
      width: 100%;
      background-color: darken(#38cc70, 10%);
    }
  }

  .accordion dd,
  .accordion__panel {
    background-color: #eee;
    font-size: 1em;
    line-height: 1.5em;
  }

  .accordion p {
    padding: 1em 2em 1em 2em;
  }

  .accordion {
    position: relative;
    /* background-color: #eee; */
  }

  .container {
    max-width: 960px;
    margin: 0 auto;
    padding: 2em 0 2em 0;
  }

  .accordionTitle,
  .accordion__Heading {
    /* background-color: #eee; */
    text-align: left;
    font-weight: 700;
    /* padding: 1em; */
    display: block;
    text-decoration: none;
    /* color: #fff; */
    transition: background-color 0.5s ease-in-out;
    /* border-bottom: 1px solid darken(#38cc70, 5%); */

    &:before {
      content: "+";
      font-size: 1.5em;
      line-height: 0.5em;
      float: left;
      transition: transform 0.3s ease-in-out;
    }

    &:hover {
      background-color: darken(#38cc70, 10%);
    }
  }

  .accordionTitleActive,
  .accordionTitle.is-expanded {
    background-color: darken(#38cc70, 10%);

    &:before {

      transform: rotate(-225deg);
    }
  }

  .accordionItem {
    height: auto;
    overflow: hidden;
    //SHAME: magic number to allow the accordion to animate

    max-height: 50em;
    transition: max-height 1s;


    @media screen and (min-width:48em) {
      max-height: 15em;
      transition: max-height 0.5s
    }


  }

  .accordionItem.is-collapsed {
    max-height: 0;
  }

  .no-js .accordionItem.is-collapsed {
    max-height: auto;
  }

  .animateIn {
    animation: accordionIn 0.45s normal ease-in-out both 1;
  }

  .animateOut {
    animation: accordionOut 0.45s alternate ease-in-out both 1;
  }

  @keyframes accordionIn {
    0% {
      opacity: 0;
      transform: scale(0.9) rotateX(-60deg);
      transform-origin: 50% 0;
    }

    100% {
      opacity: 1;
      transform: scale(1);
    }
  }

  @keyframes accordionOut {
    0% {
      opacity: 1;
      transform: scale(1);
    }

    100% {
      opacity: 0;
      transform: scale(0.9) rotateX(-60deg);
    }
  }
</style>
<div class="card p-2">
  <div class="card-header card-header-text card-header-success">
    <div class="card-text">
      <h4 class="card-title">Pemasukan</h4>
    </div>



    <div class="input-group w-75 float-right">
      <div class="input-group-prepend">
        <span class="input-group-text">
          <i class="material-icons">date_range</i>
        </span>
      </div>
      <input type="text" class="form-control m-2" name="date_range" data-a-dec="." placeholder="Cari data berdasarkan jarak tanggal .....">
      <span class="input-group-btn">
        <button type="button" class="btn btn-primary cari_pertanggal">
          <i class="material-icons">filter_list</i>
        </button>
        <button type="button" class="btn btn-default refresh">
          <i class="material-icons">refresh</i>
        </button>
        <a href="{{ url('export_pemasukan') }}" class="btn btn-success">
          <i class="material-icons">save_alt</i>
        </a>
        <a href="cetak_pemasukan" target="_blank" class="btn btn-info float-right ml-1 pl-2 print_excel"><i class="material-icons">print</i>Cetak</a>
      </span>
    </div>




  </div>
  <div class="card-body">
    <table class="table" id="datatable_pemasukan" style="width:100%;">
      <thead>
        <tr>
          <th class="text-center font-weight-bold">#</th>
          <th class="font-weight-bold">Tanggal</th>
          <th class="font-weight-bold" width="70%">Uraian</th>
          <th class="font-weight-bold" width="">Total</th>
        </tr>
      </thead>
      <tbody>

      </tbody>
    </table>


  </div>
</div>

<div class="modal fade" id="modaleditPemasukan" tabindex="-1" role="">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="card card-signup card-plain">
        <div class="modal-header">
          <div class="card-header card-header-success w-100 text-center">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="material-icons">clear</i>
            </button>

            <h4 class="card-title">Edit Pemasukkan</h4>

          </div>
        </div>
        <div class="modal-body">
          <form id="form_data_uppemasukan" class="form" method="" action="">
            @csrf
            <div class="card-body">

              <div class="row mb-4">
                <div class="col d-flex align-items-center">
                  <i class="material-icons">face</i>
                  <span class="pr-2 nama_pemasukan"></span>
                </div>
              </div>


              <div class="row">
                <div class="col">

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text border pt-2 pb-2 border-secondary m-2 text-secondary rounded " style="width: 100px;">
                        SPP
                      </span>
                    </div>
                    <input type="text" class="form-control pt-2 pb-2 text-right pr-2" data-a-dec="." name="up_spp" placeholder="0">
                  </div>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text border pt-2 pb-2 border-secondary m-2 text-secondary rounded" style="width: 100px;">
                        PSB
                      </span>
                    </div>
                    <input type="text" class="form-control pt-2 pb-2 text-right pr-2" data-a-dec="." name="up_psb" placeholder="0">
                  </div>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text border pt-2 pb-2 border-secondary m-2 text-secondary rounded" style="width: 100px;">
                        PAS 1
                      </span>
                    </div>
                    <input type="text" class="form-control pt-2 pb-2 text-right pr-2" name="up_pas_1" data-a-dec="." placeholder="0">
                  </div>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text border pt-2 pb-2 border-secondary m-2 text-secondary rounded" style="width: 100px;">
                        PAS 2
                      </span>
                    </div>
                    <input type="text" class="form-control pt-2 pb-2 text-right pr-2" name="up_pas_2" data-a-dec="." placeholder="0">
                  </div>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text border pt-2 pb-2 border-secondary m-2 text-secondary rounded" style="width: 100px;">
                        UTS 1
                      </span>
                    </div>
                    <input type="text" class="form-control pt-2 pb-2 text-right pr-2" name="up_uts_1" data-a-dec="." placeholder="0">
                  </div>
                </div>
                <div class="col">

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text border pt-2 pb-2 border-secondary m-2 text-secondary rounded" style="width: 100px;">
                        UTS 2
                      </span>
                    </div>
                    <input type="text" class="form-control pt-2 pb-2 text-right pr-2" name="up_uts_2" data-a-dec="." placeholder="0">
                  </div>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text border pt-2 pb-2 border-secondary m-2 text-secondary rounded" style="width: 100px;">
                        LKS 1
                      </span>
                    </div>
                    <input type="text" class="form-control pt-2 pb-2 text-right pr-2" name="up_lks_1" data-a-dec="." placeholder="0">
                  </div>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text border pt-2 pb-2 border-secondary m-2 text-secondary rounded" style="width: 100px;">
                        LKS 2
                      </span>
                    </div>
                    <input type="text" class="form-control pt-2 pb-2 text-right pr-2" name="up_lks_2" data-a-dec="." placeholder="0">
                  </div>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text border pt-2 pb-2 border-secondary m-2 text-secondary rounded" style="width: 100px;">
                        UNAS
                      </span>
                    </div>
                    <input type="text" class="form-control pt-2 pb-2 text-right pr-2" name="up_unas" data-a-dec="." placeholder="0">
                  </div>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text border pt-2 pb-2 border-secondary m-2 text-secondary rounded" style="width: 100px;">
                        Daftar Ulang
                      </span>
                    </div>
                    <input type="text" class="form-control pt-2 pb-2 text-right pr-2" name="up_daftar_ulang" data-a-dec="." placeholder="0">
                  </div>
                </div>

              </div>
              <div class="row">
                <div class="col">
                  <div class="bg-danger text-white p-2 rounded">
                    <h6 class="mb-0">Tanggungan Sebelumnya</h6>
                  </div>
                  <div class="input-tgg-prev">

                  </div>

                </div>
              </div>


            </div>
          </form>
        </div>
        <div class="modal-footer justify-content-center">
          <a id="simpan_editpemasukan" href="#pablo" class="btn btn-primary btn-link btn-wd btn-lg">Simpan</a>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@push('javascript')
<script type="text/javascript">
  $(document).ready(function() {
    var id = 0;
    var tggprev;
    var no_induk;
    var status = 0;
    var date_start = '0';
    var date_end = '0';

    read_data(status, date_start, date_end);

    function read_data(status, param_tgl_awal, param_tgl_akhir) {
      console.log('cari tanggal : ' + param_tgl_awal + ' -> ' + param_tgl_akhir);
      var tgl_awal = param_tgl_awal;
      var tgl_akhir = param_tgl_akhir;
      var url = "{{ url('pemasukan-datatable') }}";
      console.log(url + '/' + status + '/' + tgl_awal + '/' + tgl_akhir);

      $('#datatable_pemasukan').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url: url + '/' + status + '/' + tgl_awal + '/' + tgl_akhir,
        },
        rowReorder: {
          selector: 'td:nth-child(2)'
        },
        responsive: true,
        columns: [{
            "data": 'DT_RowIndex',
            orderable: false,
            searchable: false
          },
          {
            data: 'tanggal_conv',
            name: 'tanggal_conv',
            className: "align-top"
          },
          {
            data: 'uraian_conv',
            name: 'uraian_conv',
            className: "align-top"
          },
          {
            data: 'saldo_conv',
            name: 'saldo_conv',
            className: "align-top"
          },


        ],
        // columnDefs: [{
        //   "targets": [4, 5],
        //   "orderable": false
        // }],
        "drawCallback": function() {

          $('.numeric').attr('data-a-dec', ',');
          $('.numeric').attr('data-a-sep', '.');
          $('.linumeric').attr('data-a-dec', ',');
          $('.linumeric').attr('data-a-sep', '.');

          $('.numeric').autoNumeric('init');
          $('.linumeric').autoNumeric('init');
        },
      });

    }
    $(document).on('click', '.edit', function(event) {
      $('.input-tgg-prev').html("");
      event.preventDefault();
      id = $(this).attr('id');
      $.ajax({
          url: '/search_pemasukan/' + id,
          type: 'POST',
          dataType: 'JSON',
          data: {
            _token: '{{ csrf_token() }}'
          },
        })
        .done(function(data) {

          var er = JSON.parse(data.uraian);
          // console.log(er.tanggunganprev);
          $('.nama_pemasukan').html('<label class="mb-0 ml-2">' + data.nama + '</label>');
          $('input[name=up_spp]').val(er.spp);
          $('input[name=up_psb]').val(er.psb);
          $('input[name=up_uts_1]').val(er.uts_1);
          $('input[name=up_uts_2]').val(er.uts_2);
          $('input[name=up_pas_1]').val(er.pas_1);
          $('input[name=up_pas_2]').val(er.pas_2);
          $('input[name=up_lks_1]').val(er.lks_1);
          $('input[name=up_lks_2]').val(er.lks_2);
          $('input[name=up_daftar_ulang]').val(er.daftar_ulang);
          $('input[name=up_unas]').val(er.unas);
          tggprev = er.tanggunganprev;

          for (var i = 0; i < tggprev.length; i++) {
            var value = tggprev[i].value;
            var html = '';
            no_induk = tggprev[i].no_induk;
            html += '<div class="input-group">' +
              '<div class="input-group-prepend">' +
              '<span class="input-group-text bg-danger m-2 text-white rounded" style="width: 100px;">' +
              '<small>' + tggprev[i].tgg + '</small>' +
              '</span>' +
              '</div>' +
              '<input type="text" class="form-control text-right pr-2 numeric tgg-prev-' + i + '" name="' + tggprev[i].tgg.replaceAll(' ', '_').toLowerCase() + '" data-kelas="' + tggprev[i].kelas + '" data-a-dec="." placeholder="0" value="' + value + '">' +
              '</div>';

            $('.input-tgg-prev').append(html);
          }

          $(".numeric").autoNumeric('init', {
            aPad: false
          });
          $('input[name=up_spp],input[name=up_psb],input[name=up_uts_1],input[name=up_uts_2],input[name=up_pas_1],input[name=up_pas_2],input[name=up_lks_1],input[name=up_lks_2],input[name=up_unas],input[name=up_daftar_ulang]').autoNumeric('init', {
            aPad: false
          });
          var total = 0;
          var spp = er.spp;
          var psb = er.psb;
          var uts_1 = er.uts_1;
          var uts_2 = er.uts_2;
          var pas_1 = er.pas_1;
          var pas_2 = er.pas_2;
          var lks_1 = er.lks_1;
          var lks_2 = er.lks_2;
          var unas = er.unas;
          var daftar_ulang = er.daftar_ulang;

          if (spp == "") {
            spp = "0";
          }
          if (psb == "") {
            psb = "0";
          }
          if (pas_1 == "") {
            pas_1 = "0";
          }
          if (pas_2 == "") {
            pas_2 = "0";
          }
          if (uts_1 == "") {
            uts_1 = "0";
          }
          if (uts_2 == "") {
            uts_2 = "0";
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
            daftar_ulang = 0;
          }
          total = total + parseInt(spp);
          total = total + parseInt(psb);
          total = total + parseInt(uts_1);
          total = total + parseInt(uts_2);
          total = total + parseInt(pas_1);
          total = total + parseInt(pas_2);
          total = total + parseInt(lks_1);
          total = total + parseInt(lks_2);
          total = total + parseInt(unas);
          total = total + parseInt(daftar_ulang);

          for (var i = 0; i < er.tanggunganprev.length; i++) {
            total = total + parseInt(er.tanggunganprev[i].value);
          }


          $('#modaleditPemasukan').modal('show');
        });

    });
    $('#simpan_editpemasukan').click(function(event) {
      event.preventDefault();
      /* Act on the event */
      var data = $('#form_data_uppemasukan').serialize();

      var spp = $('input[name=up_spp]').val();
      var psb = $('input[name=up_psb]').val();
      var pas_1 = $('input[name=up_pas_1]').val();
      var pas_2 = $('input[name=up_pas_2]').val();
      var uts_1 = $('input[name=up_uts_1]').val();
      var uts_2 = $('input[name=up_uts_2]').val();
      var lks_1 = $('input[name=up_lks_1]').val();
      var lks_2 = $('input[name=up_lks_2]').val();
      var unas = $('input[name=up_unas]').val();
      var daftar_ulang = $('input[name=up_daftar_ulang]').val();

      var tanggunganprev = [];
      var go = 0;
      while (go < tggprev.length) {
        console.log(tanggunganprev);
        var tgg = $(".tgg-prev-" + go).attr('name');
        var kelas = $(".tgg-prev-" + go).data('kelas');
        var value = $(".tgg-prev-" + go).val();
        var valuefix = value.replaceAll(',', '');
        var tggfix = tgg.replaceAll('_', ' ');
        tanggunganprev.push({
          tgg: tggfix.toUpperCase(),
          no_induk: no_induk,
          kelas: kelas,
          value: valuefix
        });
        go++;
      }
      var up_tanggunganprev = JSON.stringify(tanggunganprev);


      console.log('ini tanggunganprev = ' + up_tanggunganprev);

      $.ajax({
          url: '/simpan_editpemasukan/' + id,
          type: 'POST',
          dataType: 'JSON',
          data: {
            _token: '{{csrf_token()}}',
            up_spp: spp,
            up_psb: psb,
            up_pas_1: pas_1,
            up_pas_2: pas_2,
            up_uts_1: uts_1,
            up_uts_2: uts_2,
            up_lks_1: lks_1,
            up_lks_2: lks_2,
            up_unas: unas,
            up_daftar_ulang: daftar_ulang,
            up_tanggunganprev: up_tanggunganprev
          },
        })
        .done(function() {
          Swal.fire(
            'Selamat !!',
            'Data berhasil disimpan',
            'success'
          );
          $('#datatable_pemasukan').DataTable().destroy();
          $('#modaleditPemasukan').modal('hide');
          read_data();
        })
        .fail(function() {
          console.log("error");
        })
        .always(function() {
          console.log("complete");
        });

    });
    $(document).on('click', '.hapus', function(event) {
      event.preventDefault();
      var id = $(this).attr('id');
      Swal.fire({
        title: 'Apakah anda yakin ingn menghapus data ini ?',
        text: "Pastikan yang anda pilih benar",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus ini!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
              url: '/hapus_pemasukan/' + id,
              type: 'POST',
              dataType: 'JSON',
              data: {
                _token: '{{csrf_token()}}'
              },
            })
            .done(function() {
              Swal.fire(
                'Selamat !!',
                'Data berhasil terhapus',
                'success'
              );
              $('#datatable_pemasukan').DataTable().destroy();
              read_data();
            })
            .fail(function() {
              console.log("error");
            })
            .always(function() {
              console.log("complete");
            });
        }
      })


    });
    // date range
    $(function() {
      $('input[name=date_range]').daterangepicker({
        opens: 'left'
      }, function(start, end, label) {
        date_start = start.format('YYYY-MM-DD');
        date_end = end.format('YYYY-MM-DD');
        console.log('date start: ' + date_start);

      });
    });
    //cari pertanggal
    $('.cari_pertanggal').click(function(event) {
      console.log($('input[name=date_range]').val());
      $('#datatable_pemasukan').DataTable().destroy();
      read_data(1, date_start, date_end);
    });
    $('.refresh').click(function(event) {
      /* Act on the event */
      $('#datatable_pemasukan').DataTable().destroy();
      read_data(0, " ", " ");
    });
    //uses classList, setAttribute, and querySelectorAll
    //if you want this to work in IE8/9 youll need to polyfill these

  });
</script>

@endpush