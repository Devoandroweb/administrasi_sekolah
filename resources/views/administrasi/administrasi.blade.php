@extends('template/template',['active' => $active ?? '2','title' => $title])




@section('content')

<div class="card p-2">
  <div class="card-header card-header-text card-header-success">
    <div class="card-text">
      <h4 class="card-title">Administrasi</h4>
    </div>
    <a href="cetak_administrasi" target="_blank" class="btn btn-info float-right pl-2 mr-1 print_excel"><i class="material-icons">print</i>Cetak</a>
  </div>
  <div class="card-body">
    <table class="table w-100" id="datatable_administrasi">
      <thead>
        <tr>
          <th class="font-weight-bold" width="5%">#</th>
          <th class="font-weight-bold">Nama</th>
          <th class="font-weight-bold">Kelas</th>
          <th class="text-center font-weight-bold" width="20%">Action</th>

        </tr>
      </thead>
      <tbody>

      </tbody>
    </table>


  </div>
</div>


<div class="modal fade" id="modaEditAdministrasi" tabindex="-1" role="">
  <div class="modal-dialog modal-login" role="document">
    <div class="modal-content">
      <div class="card card-signup card-plain">
        <div class="modal-header">
          <div class="card-header card-header-success w-100 text-center">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
              <i class="material-icons">clear</i>
            </button>

            <h4 class="card-title">Edit Administrasi</h4>

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

              <div class="form-group">
                <label>Nama Jenis</label>
                <input type="text" value="" name="nama" class="form-control" />
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
      $('#datatable_administrasi').DataTable({
        processing: true,
        serverSide: true,

        "scrollX": true,
        ajax: {
          url: '{{ url("jsonadministrasi") }}',
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
            data: 'nama',
            name: 'nama'
          },
          {
            data: 'kelas',
            name: 'kelas'
          },
          {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false
          },
        ],
        "drawCallback": function() {

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
          url: '/read_adm_by/' + id,
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
          $('#modaEditAdministrasi').modal('show');
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
          url: '/simpan_edit_adm/' + id,
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
          $('#datatable_administrasi').DataTable().destroy();
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



  });
</script>

@endpush