@extends('template/template',['active' => $active ?? '2','title' => $title])




@section('content')

<div class="card p-2">
  <div class="card-header card-header-text card-header-success">
    <div class="card-text">
      <h4 class="card-title">Tanggungan Lalu</h4>
    </div>
    <a href="cetak_tanggungan_lalu" target="_blank" class="btn btn-info float-right pl-2 mr-1 print_excel"><i class="material-icons">print</i>Cetak</a>
  </div>
  <div class="card-body">
    <table class="table" id="datatable_tanggunganprev" style="width:150%;">
      <thead>
        <tr>
          <th class="font-weight-bold">#</th>
          <th class="text-center font-weight-bold">Action</th>
          <th class="font-weight-bold">Nama</th>
          <th class="font-weight-bold">Kelas</th>
          <th class="font-weight-bold">Tahun Ajaran</th>
          <th class="font-weight-bold">SPP</th>
          <th class="font-weight-bold">PSB</th>
          <th class="font-weight-bold">UTS 1</th>
          <th class="font-weight-bold">UTS 2</th>
          <th class="font-weight-bold">PAS 1</th>
          <th class="font-weight-bold">PAS 2</th>
          <th class="font-weight-bold">LKS 1</th>
          <th class="font-weight-bold">LKS 2</th>
          <th class="font-weight-bold">UNAS</th>
          <th class="font-weight-bold">Daftar Ulang</th>
          <th class="font-weight-bold">Total</th>

        </tr>
      </thead>
      <tbody>

      </tbody>
    </table>


  </div>
</div>


<div class="modal fade" id="modaEdittggprev" tabindex="-1" role="">
  <div class="modal-dialog modal-login" role="document">
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
          <form id="form_update" class="form" method="" action="">
            @csrf
            <div class="card-body">

              <div class="form-group bmd-form-group">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="material-icons">face</i>
                    </span>
                  </div>
                  <input type="text" name="nama" class="form-control pl-2" placeholder="0" readonly="">
                </div>
              </div>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-dark m-2 text-white rounded " style="width: 100px;">
                    SPP
                  </span>
                </div>
                <input type="text" name="up_spp" class="form-control text-right pr-2" placeholder="0">
              </div>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-dark m-2 text-white rounded" style="width: 100px;">
                    PSB
                  </span>
                </div>
                <input type="text" name="up_psb" class="form-control text-right pr-2" placeholder="0">
              </div>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-dark m-2 text-white rounded" style="width: 100px;">
                    PAS 1
                  </span>
                </div>
                <input type="text" name="up_pas_1" class="form-control text-right pr-2" placeholder="0">
              </div>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-dark m-2 text-white rounded" style="width: 100px;">
                    PAS 2
                  </span>
                </div>
                <input type="text" name="up_pas_2" class="form-control text-right pr-2" placeholder="0">
              </div>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-dark m-2 text-white rounded" style="width: 100px;">
                    UTS 1
                  </span>
                </div>
                <input type="text" name="up_uts_1" class="form-control text-right pr-2" placeholder="0">
              </div>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-dark m-2 text-white rounded" style="width: 100px;">
                    UTS 2
                  </span>
                </div>
                <input type="text" name="up_uts_2" class="form-control text-right pr-2" placeholder="0">
              </div>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-dark m-2 text-white rounded" style="width: 100px;">
                    LKS 1
                  </span>
                </div>
                <input type="text" name="up_lks_1" class="form-control text-right pr-2" placeholder="0">
              </div>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-dark m-2 text-white rounded" style="width: 100px;">
                    LKS 2
                  </span>
                </div>
                <input type="text" name="up_lks_2" class="form-control text-right pr-2" placeholder="0">
              </div>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-dark m-2 text-white rounded" style="width: 100px;">
                    UNAS
                  </span>
                </div>
                <input type="text" name="up_unas" class="form-control text-right pr-2" placeholder="0">
              </div>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-dark m-2 text-white rounded" style="width: 100px;">
                    Daftar Ulang
                  </span>
                </div>
                <input type="text" name="up_daftar_ulang" class="form-control text-right pr-2" placeholder="0">
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer justify-content-center">
          <button type="button" class="simpan_edit btn btn-primary btn-link btn-wd btn-lg">Simpan</button>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('javascript')
<script type="text/javascript">
  jQuery(document).ready(function() {
    read_data();
    var id = 0;

    function read_data() {
      $('#datatable_tanggunganprev').DataTable({
        processing: true,
        serverSide: true,

        "scrollX": true,
        ajax: {
          url: '{{ url('
          json_tanggunganprev ') }}',
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
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false
          },
          {
            data: 'nama',
            name: 'nama'
          },
          {
            data: 'kelas_prev',
            name: 'kelas_prev'
          },
          {
            data: 'tahun_ajaran',
            name: 'tahun_ajaran'
          },
          {
            data: 'spp',
            name: 'spp',
            className: "text-right dt-thead-left numeric"
          },
          {
            data: 'psb',
            name: 'psb',
            className: "text-right dt-thead-left numeric"
          },
          {
            data: 'uts_1',
            name: 'uts_1',
            className: "text-right dt-thead-left numeric"
          },
          {
            data: 'uts_2',
            name: 'uts_2',
            className: "text-right dt-thead-left numeric"
          },
          {
            data: 'pas_1',
            name: 'pas_1',
            className: "text-right dt-thead-left numeric"
          },
          {
            data: 'pas_2',
            name: 'pas_2',
            className: "text-right dt-thead-left numeric"
          },
          {
            data: 'lks_1',
            name: 'lks_1',
            className: "text-right dt-thead-left numeric"
          },
          {
            data: 'lks_2',
            name: 'lks_2',
            className: "text-right dt-thead-left numeric"
          },
          {
            data: 'unas',
            name: 'unas',
            className: "text-right dt-thead-left numeric"
          },
          {
            data: 'daftar_ulang',
            name: 'daftar_ulang',
            className: "text-right dt-thead-left numeric"
          },
          {
            data: 'total',
            name: 'total',
            className: "text-right dt-thead-left numeric"
          },
        ],
        "columnDefs": [{
            "targets": [1, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13],
            "orderable": false
          },
          {
            "targets": [2],
            "className": "w-25"
          },
          {
            "targets": [4],
            "width": "300px"
          },
          {
            "targets": [3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 14, 15],
            "width": "100px"
          },
          {
            "targets": [13],
            "width": "200px"
          },
          {
            "targets": [1],
            "width": "700px",
            "className": "text-center"
          }
        ],
        "drawCallback": function() {

          $('.numeric').attr('data-a-dec', ',');
          $('.numeric').attr('data-a-sep', '.');
          $('.numeric').autoNumeric('init');
        },
        "initComplete": function() {

          $('.numeric').attr('data-a-dec', ',');
          $('.numeric').attr('data-a-sep', '.');
          $('.numeric').autoNumeric('init');
        },
      });

    }
    $(document).on('click', '.edit', function(event) {
      event.preventDefault();
      /* Act on the event */
      id = $(this).attr('id');
      var token = $('input[name=_token]').val();

      $.ajax({
          url: '/read_tanggungan_lalu_by/' + id,
          type: 'POST',
          dataType: 'JSON',
          data: {
            _token: token
          },
        })
        .done(function(data) {

          console.log(data);
          $('input[name=nama]').val(data.nama);
          $('input[name=up_spp]').val(data.spp);
          $('input[name=up_psb]').val(data.psb);
          $('input[name=up_uts_1]').val(data.uts_1);
          $('input[name=up_uts_2]').val(data.uts_2);
          $('input[name=up_pas_1]').val(data.pas_1);
          $('input[name=up_pas_2]').val(data.pas_2);
          $('input[name=up_lks_1]').val(data.lks_1);
          $('input[name=up_lks_2]').val(data.lks_2);
          $('input[name=up_unas]').val(data.unas);
          $('input[name=up_daftar_ulang]').val(data.daftar_ulang);
          $('input[name=up_spp],input[name=up_psb],input[name=up_uts_1],input[name=up_uts_2],input[name=up_pas_1],input[name=up_pas_2],input[name=up_lks_1],input[name=up_lks_2],input[name=up_unas],input[name=up_daftar_ulang]').autoNumeric('init', {
            aPad: false
          });
          $('#modaEdittggprev').modal('show');
        })
        .fail(function() {
          console.log("error");
        })
        .always(function() {
          console.log("complete");
        });
    });
    $('.simpan_edit').click(function(event) {
      /* Act on the event */
      // $('#form_update input').autoNumeric('init');
      // $('#form_update input').autoNumeric('destroy');

      console.log(id);
      $.ajax({
          url: '/simpan_edit_tanggungan_lalu/' + id,
          type: 'POST',
          dataType: 'JSON',
          data: {
            _token: '{{ csrf_token() }}',
            spp: $('input[name=up_spp]').val(),
            psb: $('input[name=up_psb]').val(),
            uts_1: $('input[name=up_uts_1]').val(),
            uts_2: $('input[name=up_uts_2]').val(),
            pas_1: $('input[name=up_pas_1]').val(),
            pas_2: $('input[name=up_pas_2]').val(),
            lks_1: $('input[name=up_lks_1]').val(),
            lks_2: $('input[name=up_lks_2]').val(),
            unas: $('input[name=up_unas]').val(),
            daftar_ulang: $('input[name=up_daftar_ulang]').val()
          },
        })
        .done(function() {
          $('#datatable_tanggunganprev').DataTable().destroy();
          read_data();
          $('#modaEditAdministrasi').modal('hide');
          Swal.fire(
            'Selamat',
            'Data Siswa Tersimpan',
            'success'
          );

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
              url: '/hapus_tgg_prev/' + id,
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
              $('#datatable_tanggunganprev').DataTable().destroy();
              read_data();
            })
            .fail(function() {
              console.log("error");
            })
            .always(function() {
              console.log("complete");
            });
        }
      });

    });

  });
</script>

@endpush