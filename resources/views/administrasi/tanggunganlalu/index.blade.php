@extends('template/template',['active' => $active ?? '2','title' => 'Tanggungan Lalu'])




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
          <th class="font-weight-bold">Tahun Ajaran</th>
          <th class="font-weight-bold">Uraian</th>
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


    function read_data() {
      $('#datatable_administrasi').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url: '{{ url("tanggungan_lalu-datatable") }}',
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
            data: 'tahun_ajaran',
            name: 'tahun_ajaran'
          },
          {
            data: 'uraian_conv',
            name: 'uraian_conv'
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




  });
</script>

@endpush