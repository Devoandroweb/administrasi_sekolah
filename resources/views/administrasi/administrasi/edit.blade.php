@extends('template/template',['active' => $active ?? '5','title' => "Edit Administrasi"])




@section('content')
<?php
$json = json_decode($data->value);

?>

<form action="{{url('simpan_edit_adm/'.$data->id_administrasi)}}" method="post">
    @csrf
    <div class="card p-2">
        <div class="card-header card-header-text card-header-danger">
            <div class="card-text">
                <h4 class="card-title">Data Siswa</h4>
            </div>

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
            <table class="w-100 table table-stripped">
                <tr>
                    <td>Nama Siswa</td>
                    <td width="1%">:</td>
                    <td class="font-weight-bold">{{$data->nama_siswa}}</td>
                    <td>Kelas</td>
                    <td width="1%">:</td>
                    <td class="font-weight-bold">{{$data->nama_kelas." ".$data->nama_jurusan}}</td>
                    <td>No Induk</td>
                    <td width="1%">:</td>
                    <td class="font-weight-bold">{{$data->no_induk}}</td>
                </tr>
            </table>
            <hr>
            <div class="row">
                @foreach($json as $key)
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">{{$key->nama_adm}}</label>
                        <input type="hidden" name="bdasarid[]" value="{{$key->id_jenis_adm}}">
                        <input type="hidden" name="bdasar[]" value="{{$key->nama_adm}}">
                        <input type="text" value="{{GF::formatRupiah($key->value_adm)}}" name="bjt[]" class="form-control text-right without-rupiah" />
                    </div>
                </div>
                @endforeach
            </div>
            <input type="submit" value="simpan" class="btn btn-pimary">
        </div>
    </div>
</form>

@endsection
@push("javascript")
<script>
    $(".without-rupiah").keyup(function(e) {
        var a = $(this).val();
        var b = a.replaceAll(".", "");
        $(this).val(formatRupiah(b))
    })
</script>

@endpush