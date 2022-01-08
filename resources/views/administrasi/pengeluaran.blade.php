@extends('template/template',['active' => $active ?? '3','title' => $title])




@section('content')

<div class="card p-2">
  <div class="card-header card-header-text card-header-danger">
    <div class="card-text">
      <h4 class="card-title">Pengeluaran</h4>
    </div>

    <div class="input-group w-75 float-right">
      <div class="input-group-prepend">
        <span class="input-group-text">
          <i class="material-icons">date_range</i>
        </span>
      </div>
      <input type="text" class="form-control m-2" name="date_range" data-a-dec="." placeholder="Cari data berdasarkan jarak tanggal .....">
      <span class="input-group-btn">
        <a href="cetak_pengeluaran" target="_blank" class="btn btn-info print_excel">
          <i class="material-icons">print</i>
        </a>
        <button type="button" class="btn btn-primary cari_pertanggal">
          <i class="material-icons">filter_list</i>
        </button>
        <a href="import_siswa" class="btn btn-success print_excel " data-target="#modalImport" data-toggle="modal">
          <i class="material-icons">cloud_download</i>
        </a>
        <button type="button" class="btn btn-default refresh">
          <i class="material-icons">refresh</i>
        </button>
      </span>
    </div>
  </div>
  <div class="card-body">
    <table class="table" id="datatable_pengeluaran" style="width: 100%;">
      <thead>
        <tr>
          <th class="text-center font-weight-bold">#</th>
          <th class="font-weight-bold">Tanggal</th>
          <th class="font-weight-bold">Uraian</th>
          <th class="font-weight-bold">Total</th>
          <th class="font-weight-bold">Actions</th>
        </tr>
      </thead>
      <tbody>

      </tbody>
    </table>


  </div>
</div>

<div class="modal fade bd-example-modal-lg" id="modalEdit" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h5 class="modal-title card-title">Edit Pengeluaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="material-icons">clear</i>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col">
            <h6 class="text-right tgl-pengeluaran"></h6>
            <form id="form_e_pengeluaran">
              @csrf
              <div class="form">

              </div>
            </form>
          </div>
        </div>
        <div style="display: block; width: 100%; border: 1px solid green; padding: 20px; margin-top:10px; text-align: center; border-radius: 0.3rem; font-weight: bold;">
          <div style="position: absolute;margin-top: -2rem;background: white;padding: 0px 10px 0px 10px;letter-spacing: 0.1rem;color: #38823b;">Total</div>
          <span class="total_e_pengeluaran numeric" data-a-dec=".">0</span>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary simpanEditPengeluaran">SIMPAN</button>
      </div>
    </div>
  </div>
</div>
<!-- modal import -->
<div class="modal fade" id="modalImport" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">

    <div class="modal-content">
      <div class="modal-header">
        <i class="material-icons mr-2">cloud_download</i>
        <h5 class="modal-title"> Import Excel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="import_pengeluaran" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">

          <div id="loading" class="d-none" style="position: absolute; z-index: 9999;text-align: center;width: 100%;  height: 100%">
            <img class="m-auto" src="{{ url('public/image/808.gif') }}">
          </div>
          <div class="form-group form-file-upload form-file-multiple">
            <input type="file" id="inputFileImport" class="d-none" name="file_import_pengeluaran" multiple="">
            <div class="input-group">

              <input id="inputFile1" type="text" class="form-control inputFileVisible" readonly placeholder="Import File Excel" multiple>
              <span class="input-group-btn">
                <button type="button" id="inputFile2" class="btn btn-fab btn-round btn-info">
                  <i class="material-icons">layers</i>
                </button>
              </span>
            </div>
          </div>
          <small>Unduh contoh Exelnya <u><a href="download_excel_pengeluaran">disini</a></small></u>
        </div>
        <div class="modal-footer">
          <input name="kirim" type="submit" class="btn btn-primary" value="Kirim">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        </div>
      </form>
    </div>

  </div>
</div>
@endsection

@push('javascript')
<script type="text/javascript">
  $(document).ready(function() {
    var id = 0;
    var status = 0;
    var date_start = '0';
    var date_end = '0';
    read_data(status, date_start, date_end);

    function read_data(status, param_tgl_awal, param_tgl_akhir) {
      var tgl_awal = param_tgl_awal;
      var tgl_akhir = param_tgl_akhir;
      var url = "{{ url('json_pengeluaran') }}";
      $('#datatable_pengeluaran').DataTable({
        processing: true,
        serverSide: true,

        "scrollX": true,
        ajax: {
          url: url + '/' + status + '/' + tgl_awal + '/' + tgl_akhir,
        },
        rowReorder: {
          selector: 'td:nth-child(2)'
        },
        "language": {

          "zeroRecords": "Data masih kosong",

        },
        responsive: true,
        columns: [{
            "data": 'DT_RowIndex',
            orderable: false,
            searchable: false
          },

          {
            data: 'created_at',
            name: 'created_at'
          },
          {
            data: 'uraianfix',
            name: 'uraianfix'
          },
          {
            data: 'total',
            name: 'total',
            className: "text-right numeric"
          },
          {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false,
            className: "text-center"
          },

        ],
        columnDefs: [{
          "targets": [1, 2, 3],
          "orderable": false
        }],
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
              url: '/hapus_pengeluaran/' + id,
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
              $('#datatable_pengeluaran').DataTable().destroy();
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


    var total_count_e_pengeluaran = 0;
    var id_pengeluaran = 0;
    $(document).on('click', '.edit', function(argument) {
      // body...
      id_pengeluaran = $(this).attr('id');

      $.ajax({
          url: '/edit_pengeluaran/' + id_pengeluaran,
          type: 'POST',
          dataType: 'JSON',
          data: {
            _token: '{{ csrf_token() }}'
          },
        })
        .done(function(data) {
          // console.log(data.data.uraian);
          var a = data.data.uraian;
          var html = '';
          var uraian = JSON.parse(a);
          var total = 0;
          total_count_e_pengeluaran = 0;
          $('.tgl-pengeluaran').text('Tanggal : ' + data.tanggal_indo);
          for (var i = 0; i < uraian.length; i++) {
            var name = uraian[i].key;
            var namefix = name.replaceAll(' ', '_');
            html += '<div class="form-group">' +
              '<label class="label-key-' + i + '">' + uraian[i].key + '</label>' +
              '<input type="text" name=data_' + i + '  data-a-dec="." class="form-control text-right numeric data-' + i + '"aria-describedby="emailHelp" value="' + uraian[i].value + '" placeholder="">' +
              '</div>';

            total_count_e_pengeluaran++;
            total = total + parseInt(uraian[i].value);
          }
          $('#form_e_pengeluaran .form').html(html);
          $('.total_e_pengeluaran').autoNumeric('init', {
            aPad: false,
            aSign: ' Rp. '
          });
          $('.total_e_pengeluaran').autoNumeric('set', total);
          $('.numeric').autoNumeric('init', {
            aPad: false
          });
          $('#modalEdit').modal('show');
        })
        .fail(function() {
          console.log("error");
        })
        .always(function() {
          console.log("complete");
        });

    });

    $(document).on('keyup', '#form_e_pengeluaran input', function() {
      var a = 0;

      var total = 0;
      console.log("total count :" + total_count_e_pengeluaran);

      for (var i = 0; i < total_count_e_pengeluaran; i++) {
        var value = $('.data-' + i).val();
        total = total + parseInt(value.replaceAll(',', ''));
      }


      $('.total_e_pengeluaran').autoNumeric('init', {
        aPad: false,
        aSign: ' Rp. '
      });
      $('.total_e_pengeluaran').autoNumeric('set', total);
    });
    // date range
    $(function() {
      $('input[name=date_range]').daterangepicker({
        opens: 'left'
      }, function(start, end, label) {
        date_start = start.format('YYYY-MM-DD');
        date_end = end.format('YYYY-MM-DD');

      });
    });
    //cari pertanggal
    $('.cari_pertanggal').click(function(event) {

      $('#datatable_pengeluaran').DataTable().destroy();
      read_data(1, date_start, date_end);
    });
    $('.refresh').click(function(event) {
      /* Act on the event */
      $('#datatable_pengeluaran').DataTable().destroy();
      read_data(0, "0", "0");
    });
    $(document).on('click', '.simpanEditPengeluaran', function(event) {


      var data = [];

      for (var i = 0; i < total_count_e_pengeluaran; i++) {
        var label_key = $(".label-key-" + i).text();
        var data_key = $(".data-" + i).val();
        data.push({
          key: label_key,
          value: data_key.replaceAll(',', '')
        });

      }
      $.ajax({
          url: '/simpan_edit_pengeluaran/' + id_pengeluaran,
          type: 'POST',
          dataType: 'JSON',
          data: {
            _token: '{{ csrf_token()}}',
            data
          }
        })
        .done(function(data) {
          if (data) {
            Swal.fire(
              'Selamat !!',
              'Data berhasil tersimpan',
              'success'
            );
            $('#datatable_pengeluaran').DataTable().destroy();
            read_data();
          } else {
            Swal.fire(
              'Selamat !!',
              'Data gagal tersimpan',
              'error'
            );
          }
        })
        .fail(function() {
          console.log("error");
        })
        .always(function() {
          console.log("complete");
        });

    });
    $('#inputFile1').click(function(event) {

      $('#inputFileImport').click();
    });
    $('#inputFile1').on('input', function(event) {

      $('#inputFileImport').click();

    });
    $('#inputFile2').click(function(event) {
      $('#inputFileImport').click();
    });
    $('#inputFileImport').change(function(event) {
      var file = $(this);
      var files_obj = file[0].files;
      var file_name = files_obj[0].name;
      $('#inputFile1').val(file_name);
    });
    $('input[name=kirim]').click(function(event) {
      /* Act on the event */
      $('#loading').removeClass('d-none');
    });

  });
</script>


@endpush