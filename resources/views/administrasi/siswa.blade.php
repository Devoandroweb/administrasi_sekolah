@extends('template/template',['active' => $active ?? '5','title' => $title])




@section('content')



<div class="card p-2">
  <div class="card-header card-header-text card-header-danger">
    <div class="card-text">
      <h4 class="card-title">Data Siswa</h4>
    </div>
    <button class="btn btn-warning float-right pl-2" data-target="#modaladdSiswa" data-toggle="modal"><i class="material-icons">add_circle</i>Tambah</button>
    <a href="export_excel" class="btn btn-success float-right pl-2 mr-1 print_excel"><i class="material-icons">download</i> Save Excel</a>
    <a href="cetak_data_siswa" target="_blank" class="btn btn-info float-right pl-2 mr-1 print_biasa"><i class="material-icons">print</i> Print</a>
    <a href="import_siswa" class="btn btn-primary float-right pl-2 mr-1 print_excel " data-target="#modalImport" data-toggle="modal"><i class="material-icons">cloud_download</i>Import</a>
    @if ($errors->has('file_import_siswa'))
    <span class="alert alert-info" role="alert">
      <strong>{{ $errors->first('file_import_siswa') }}</strong>
    </span>
    @endif
    <div class="alert alert-success text-center font-weight-bold d-none mt-4 {{session('import_display')}}" role="alert">
      {{session('sukses_import')}}
    </div>
  </div>
  <div class="card-body">
    <table class="table table-hover" id="datatable_siswa" style="width:100%">
      <thead>
        <tr>
          <th class="font-weight-bold">No</th>
          <th class="font-weight-bold">No. Induk</th>
          <th class="font-weight-bold">NISN</th>
          <th class="font-weight-bold">Nama</th>
          <th class="font-weight-bold">Kelas</th>
          <th class="font-weight-bold">Jurusan</th>
          <th class="font-weight-bold">Actions</th>
        </tr>
      </thead>
      <tbody>

      </tbody>
    </table>


  </div>
</div>



@include("administrasi.siswa.modal");

@endsection
@push('javascript')
<script type="text/javascript">
  // data siwa
  jQuery(document).ready(function() {
    read_data();

    function read_data() {
      $('#datatable_siswa').DataTable({
        processing: true,
        serverSide: true,

        "scrollX": true,
        ajax: {
          url: '{{ url("jsonsiswa") }}',
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
            data: 'nisn',
            name: 'nisn'
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
            data: 'rombel',
            name: 'rombel'
          },
          {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false
          },


        ],
        "columnDefs": [{
          "targets": [3, -1],
          "orderable": false
        }, ],
      });
    }
    //simpan data
    $('#simpan-siswa').click(function(event) {
      event.preventDefault();
      var token = $('input[name=_token]').val();
      var nama = $('input[name=nama]').val();
      var tmp_lahir = $('input[name=tmp_lahir]').val();
      var tgl_lahir = $('input[name=tgl_lahir]').val();
      var nisn = $('input[name=nisn]').val();
      var no_induk = $('input[name=no_induk]').val();
      var kelas = $('input[name=kelas]').val();
      var rombel = $('input[name=rombel]').val();
      var no_tlp = $('input[name=no_tlp]').val();
      var alamat = $('textarea[name=alamat]').val();
      var password = nama;

      $.ajax({
          url: '{{url("addsiswa")}}',
          type: 'POST',
          dataType: 'json',
          data: {
            _token: token,
            nama: nama,
            tmp_lahir: tmp_lahir,
            tgl_lahir: tgl_lahir,
            nisn: nisn,
            no_induk: no_induk,
            kelas: kelas,
            rombel: rombel,
            no_tlp: no_tlp,
            alamat: alamat,
            password: password
          },
        })
        .done(function() {
          $('#datatable_siswa').DataTable().destroy();
          read_data();
          Swal.fire(
            'Selamat',
            'Data Siswa Tersimpan',
            'success'
          );
          $('input[name=nama]').val('');
          $('input[name=tmp_lahir]').val('');
          $('input[name=tgl_lahir]').val('');
          $('input[name=nisn]').val('');
          $('input[name=no_induk]').val('');
          $('input[name=no_tlp]').val('');
          $('textarea[name=alamat]').val('');
          $('#modaladdSiswa').modal('hide');
        })
        .fail(function() {
          Swal.fire(
            'Wah !!!',
            'Jangan ada yang kosong bro !',
            'error'
          )
        })
        .always(function() {

        });

    });
    //edit data
    $(document).on('click', '.edit', function(event) {
      event.preventDefault();
      var id = $(this).attr('id');
      $.ajax({
          url: '{{url("read_siswa_by")}}/' + id,
          type: 'GET',
          dataType: 'json',
          async: false
        })
        .done(function(data) {
          console.log(data);
          $('input[name=up_nama]').val(data['data_siswa'].nama);
          $('input[name=up_tmp_lahir]').val(data['data_siswa'].tmp_lahir);

          $('input[name=up_tgl_lahir]').val(data['tanggal_lahir']);
          $('input[name=up_nisn]').val(data['data_siswa'].nisn);
          $('input[name=up_no_induk]').val(data['data_siswa'].no_induk);
          $('input[name=up_no_tlp]').val(data['data_siswa'].no_tlp);
          $('textarea[name=up_alamat]').val(data['data_siswa'].alamat);
          $('.simpan-edit').attr('id', data['data_siswa'].id_siswa);
          $('#modalEdit').modal('show');

        })
        .fail(function() {
          console.log("error");
        })
        .always(function() {
          console.log("complete");
        });


    });
    $('.simpan-edit').click(function(event) {
      event.preventDefault();
      var id = $(this).attr('id');
      var token = $('#form_edit_siswa input[name=_token]').val();
      var nama = $('input[name=up_nama]').val();
      var tmp_lahir = $('input[name=up_tmp_lahir]').val();
      var tgl_lahir = $('input[name=up_tgl_lahir]').val();
      var nisn = $('input[name=up_nisn]').val();
      var no_induk = $('input[name=up_no_induk]').val();
      var no_tlp = $('input[name=up_no_tlp]').val();
      var alamat = $('textarea[name=up_alamat]').val();
      $.ajax({
          url: '{{url("update_siswa")}}/' + id,
          type: 'POST',
          dataType: 'JSON',
          data: {
            _token: token,
            up_nama: nama,
            up_tmp_lahir: tmp_lahir,
            up_tgl_lahir: tgl_lahir,
            up_nisn: nisn,
            up_no_induk: no_induk,
            up_no_tlp: no_tlp,
            up_alamat: alamat
          },
        })
        .done(function() {
          $('#datatable_siswa').DataTable().destroy();
          read_data();
          Swal.fire(
            'Selamat',
            'Data Siswa Teredit',
            'success'
          );
          $('#modalEdit').modal('hide');
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
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          var id = $(this).attr('id');
          var token = '{{ csrf_token() }}';
          $.ajax({
              url: '{{url("delete_siswa")}}/' + id,
              type: 'POST',
              dataType: 'JSON',
              data: {
                _token: token
              }
            })
            .done(function() {
              $('#datatable_siswa').DataTable().destroy();
              read_data();
              Swal.fire(
                'Selamat',
                'Data Siswa Terhapus',
                'success'
              );
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