@extends('template/template',['active' => $active ?? '2','title' => $title])
@section('content')

<div class="card p-2">
    <div class="card-header card-header-text card-header-warning">
        <div class="card-text">
            <h4 class="card-title">{{$title}}</h4>
        </div>
        <a href="{{url('admin/tugas-add')}}" class="btn btn-danger float-right pl-2 mr-1">
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
                    <!-- <th class="font-weight-bold">Kode</th> -->
                    <th class="font-weight-bold">Judul</th>
                    <th class="font-weight-bold">Kelas</th>
                    <th class="font-weight-bold">Guru</th>
                    <th class="text-center font-weight-bold" width="20%">Action</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>


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
                url: '{{ url("admin/tugas-datatable") }}',
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
                    data: 'judul',
                    name: 'judul'
                },
                {
                    data: 'kelas',
                    name: 'kelas'
                },
                {
                    data: 'nama_guru',
                    name: 'nama_guru'
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