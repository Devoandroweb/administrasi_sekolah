@extends('template/template',['active' => $active ?? '2','title' => $title])

@section('content')

<div class="card p-2">
    <div class="card-header card-header-text card-header-warning">
        <div class="card-text">
            <h4 class="card-title">Jenis Administrasi</h4>
        </div>
        <a href="#" class="btn btn-danger float-right pl-2 mr-1 b-modal" data-type="tambah">
            <i class="material-icons">add</i>Tambah
        </a>
    </div>
    <div class="card-body">
        <div class="msg">
            @if(session('msg'))
            <div class="alert alert-danger" role="alert">{{session('msg')}}</div>
            @endif
        </div>
        <table class="table w-100" id="datatable">
            <thead>
                <tr>
                    <th class="font-weight-bold" width="5%">#</th>
                    <th class="font-weight-bold">Nama</th>
                    <th class="font-weight-bold">Nilai</th>
                    <th class="text-center font-weight-bold" width="20%">Action</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>


    </div>
</div>


<div class="modal fade" id="modal-form" tabindex="-1" role="">
    <div class="modal-dialog modal-login" role="document">
        <div class="modal-content">
            <div class="card card-signup card-plain">
                <div class="modal-header">
                    <div class="card-header card-header-success w-100 text-center">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            <i class="material-icons">clear</i>
                        </button>

                        <h4 class="card-title">Tambah Jenis Administrasi</h4>

                    </div>
                </div>
                <div class="modal-body">
                    <form id="form_update" class="form">
                        @csrf
                        <input type="hidden" name="id">
                        <div class="card-body">
                            <form action="">
                                <div class="form-group">
                                    <label>Nama Jenis</label>
                                    <input type="text" value="" name="nama" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>Nilai</label>
                                    <input type="text" value="" name="nilai" class="form-control numeric" />
                                </div>


                            </form>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn-simpan btn btn-primary btn-link btn-wd btn-lg">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection

@push('javascript')
<script type="text/javascript">
    readData();
    var modal = $("#modal-form");

    function readData() {
        $('#datatable').DataTable({
            processing: true,
            serverSide: true,

            ajax: {
                url: '{{ url("jenis-administrasi-datatable") }}',
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
                    data: 'value',
                    name: 'value',
                    className :'numeric'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },

            ],
            "drawCallback": function(settings) {
                $('.dataTables_scrollBody').addClass('overflow-inherit');
                $(".numeric").autoNumeric('init', {
                    aPad: false,
                    aDec: ',',
                    aSep: '.'
                });
            }

        });
    }
    //modal form
    $(document).on("click", ".b-modal", function() {
        var jmodal = $(this).data("type");

        if (jmodal == "tambah") {
            modal.find("input[name=nama]").val("");
            modal.find("input[name=nilai]").val("");
            modal.find(".btn-simpan").attr("data-type", 1);
            modal.modal("show");
        } else if (jmodal == "edit") {
            var id = $(this).attr("id");
            $.ajax({
                type: "post",
                url: "{{url('jenis-administrasi-show')}}/" + id,
                dataType: "json",
                success: function(response) {
                    if (response.status) {
                        modal.find("input[name=id]").val(response.data.id);
                        modal.find("input[name=nama]").val(response.data.nama);
                        modal.find("input[name=nilai]").autoNumeric('init');
                        modal.find("input[name=nilai]").autoNumeric('set',response.data.value);
                        modal.find(".btn-simpan").attr("data-type", 2);
                        modal.modal("show");
                    }
                }
            });

        }
    });
    $(".btn-simpan").click(function() {
        var data = $(".modal").find("form").serialize();
        //ajax add
        if ($(this).data('type') == 1) {

            $.ajax({
                type: "post",
                url: "{{url('jenis-administrasi-add')}}",
                data: data,
                dataType: "json",
                success: function(response) {
                    if (response.status) {
                        modal.modal("hide");
                        $('#datatable').DataTable().destroy();
                        readData();
                        var html = '<div class="alert alert-success" role="alert">' + response.msg + '</div>';
                        $(".msg").html(html);

                    } else {
                        var html = '<div class="alert alert-danger" role="alert">' + response.msg + '</div>';
                        $(".msg").html(html);
                    }

                }
            });
        } else if ($(this).data('type') == 2) {
            $.ajax({
                type: "post",
                url: "{{url('jenis-administrasi-update')}}",
                data: data,
                dataType: "json",
                success: function(response) {
                    if (response.status) {
                        modal.modal("hide");
                        $('#datatable').DataTable().destroy();
                        readData();
                        var html = '<div class="alert alert-success" role="alert">' + response.msg + '</div>';
                        $(".msg").html(html);

                    } else {
                        var html = '<div class="alert alert-danger" role="alert">' + response.msg + '</div>';
                        $(".msg").html(html);
                    }

                }
            });
        }
    });
    //hapus
    $(document).on("click", ".btn-delete", function(e) {
        e.preventDefault();
        var href = $(this).attr("href");
        Swal.fire({
            title: 'Apakah ingin menghapus data ini?',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            denyButtonText: 'Batal',
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                window.location = href;
            }
        })


    });
</script>

@endpush