@extends('template/template',['active' => $active ?? '2','title' => $title])
@section('content')

<div class="card p-2">
    <div class="card-header card-header-text card-header-warning">
        <div class="card-text">
            <h4 class="card-title">{{$title}}</h4>
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

                        <h4 class="card-title">Jurusan</h4>

                    </div>
                </div>
                <div class="modal-body">
                    <form id="form_update" class="form">
                        @csrf
                        <div class="card-body">
                            <form action="">
                                <div class="form-group">
                                    <label>Nama Jurusan</label>
                                    <input type="text" value="" name="nama" class="form-control" />
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
                url: '{{ url("admin/jurusan-datatable") }}',
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
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },

            ],

        });
    }
    //modal form
    $(document).on("click", ".b-modal", function() {
        var jmodal = $(this).data("type");
        var id = $(this).attr("id");

        if (jmodal == "tambah") {
            modal.find('input[name=nama]').val("");
            modal.find('button').attr('data-type', 'tambah');
            modal.modal("show");
        } else if (jmodal == "edit") {
            //ajax-edit
            var id = $(this).attr('id');
            $.ajax({
                type: "get",
                url: "{{url('admin/jurusan-show')}}/" + id,
                dataType: "json",
                success: function(response) {
                    if (response.status) {
                        modal.find('input[name=nama]').val(response.data.nama);
                        modal.find('button').attr('data-type', 'edit');
                        modal.find('button').attr('id', id);
                        var data = $(modal).find("form").serializeArray();
                        formCheck(data, $(modal).find("form"));
                        modal.modal('show');

                    }

                }
            });

        }
    });
    $(document).on('click', ".btn-simpan", function() {
        var data = $(modal).find("form").serializeArray();
        var checkForm = formCheck(data, $(modal).find("form"));
        var type = $(this).attr("data-type");
        var id = $(this).attr("id");
        console.log(type);
        if (checkForm) {
            if (type == 'tambah') {
                //ajax add
                $.ajax({
                    type: "post",
                    url: "{{url('admin/jurusan-add')}}",
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        if (response.status) {
                            modal.modal("hide");
                            $('#datatable').DataTable().destroy();
                            readData();
                            var html = '<div class="alert alert-success" role="alert">' + response.msg + '</div>';
                            $(".msg").html(html);
                            modal.modal('hide');
                        } else {
                            var html = '<div class="alert alert-danger" role="alert">' + response.msg + '</div>';
                            $(".msg").html(html);
                        }

                    }
                });
            } else if (type == 'edit') {
                $.ajax({
                    type: "post",
                    url: "{{url('admin/jurusan-save-update')}}/" + id,
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        if (response.status) {
                            modal.modal("hide");
                            $('#datatable').DataTable().destroy();
                            readData();
                            var html = '<div class="alert alert-success" role="alert">' + response.msg + '</div>';
                            $(".msg").html(html);
                            modal.modal('hide');
                        } else {
                            var html = '<div class="alert alert-danger" role="alert">' + response.msg + '</div>';
                            $(".msg").html(html);
                        }

                    }
                });
            }

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