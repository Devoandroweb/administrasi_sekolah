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
          <th class="font-weight-bold">No Induk</th>
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

              <div class="box-dashed">
                <input type="text" name="nama">
              </div>

              <div class="my-2">
                <!-- target input -->
                <table class="table w-100" id="target-input">

                </table>
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
    var jenisAdm = <?= json_encode($jenis_adm_array) ?>;
    console.log(jenisAdm);

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
            data: 'no_induk',
            name: 'no_induk'
          },
          {
            data: 'nama_siswa',
            name: 'nama_siswa'
          },
          {
            data: 'kelas_conv',
            name: 'kelas_conv'
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

      $.ajax({
          url: '{{url("read_adm_by")}}/' + id,
          type: 'POST',
          dataType: 'JSON',
        })
        .done(function(data) {
          console.log(data);
          $('input[name=nama]').val(data.nama);
          var adm = JSON.parse(data.value);
          var html = "";
          console.log(Object.keys(adm).length);
          for (var i = 0; i < Object.keys(adm).length; i++) {

            html += '<tr>' +
              '<td>' + adm[i].nama_adm + '</td>' +
              '<td>:</td>' +
              '<td>' +
              '<input type="hidden" name="id_adm[]" value="' + adm[i].id_jenis_adm + '">' +
              '<input type="hidden" class="form-control text-right" name="nama_adm[]" value="' + adm[i].nama_adm + '">' +
              '<input type="text" class="form-control text-right" name="value_adm[]" value="' + adm[i].value_adm + '"></td>' +
              '</tr>';
            console.log("id jenis adm : " + jenisAdm[i].id)
            // if (jenisAdm.indexOf(adm[i].id_jenis_adm) != -1) {
            //   // element found
            // }
            var index = -1;
            for (var j = 0; j < jenisAdm.length; j++) {
              if (jenisAdm[j].id == adm[i].id_jenis_adm) {
                index = j;
              }
            }
            if (index !== -1) {
              jenisAdm.splice(index, 1);
            }
            console.log(jenisAdm);
            console.log("index ----> " + index);
          }
          for (var k = 0; k < jenisAdm.length; k++) {
            html += '<tr>' +
              '<td>' + jenisAdm[k].nama + '</td>' +
              '<td>:</td>' +
              '<td><input type="hidden" name="id_adm[]" value="' + jenisAdm[k].id + '"><input type="hidden" name="nama_adm[]" value="' + jenisAdm[k].nama + '"><input type="text" name="value_adm[]" class="form-control text-right" value="0"></td>' +
              '</tr>';
          }

          $('#target-input').html(html);
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
      var data = $("#modaEditAdministrasi").find("form").serialize();
      console.log(id);
      $.ajax({
          url: '{{url("simpan_edit_adm")}}/' + id,
          type: 'POST',
          dataType: 'JSON',
          data: data,
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