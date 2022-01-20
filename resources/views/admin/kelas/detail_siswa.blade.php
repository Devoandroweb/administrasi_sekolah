@extends('template/template',['active' => $active ?? '2','title' => $title])
@section('content')

<div class="card p-2">
    <div class="card-header card-header-text card-header-warning">
        <div class="card-text">
            <h4 class="card-title">{{$title}}</h4>
        </div>
        <!-- <a href="#" class="btn btn-danger float-right pl-2 mr-1 btn-simpan" data-type="tambah">
            <i class="material-icons">save</i>Simpan
        </a> -->
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
                    <th class="font-weight-bold">No Induk</th>
                    <th class="font-weight-bold">Nama</th>
                </tr>
            </thead>
            <tbody>
                @foreach($siswa as $key)
                <tr>
                    <td>{{$key->no_induk}}</td>
                    <td>{{$key->nama}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>


    </div>
</div>





@endsection
@push('javascript')
<script>
    $(".checkbox").prop("checked", false);
    $("#datatable").DataTable();
    var siswa = [];
    $(".checkbox").click(function() {
        if ($(this).prop("checked")) {
            siswa.push($(this).val());
        } else {
            var a = siswa.indexOf($(this).val());
            if (a > -1) {
                siswa.splice(a, 1);
            }
        }
    });
</script>
@endpush