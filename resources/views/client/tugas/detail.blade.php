@extends("client.app")
@section("content")
<style>
    table tbody, tr td,tr{
        border: none;
    }
</style>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h2>Detail Tugas</h2>
                        <div class="row">
                            <div class="col-12 col-md">
                                Pengajar : <span class="text-danger">{{$tugas->mapel->guru->nama}}</span>
                            </div>
                            <div class="col-12 col-md">
                                Status : <?= $tugas->status() ?>
                            </div>
                        </div>
                        
                        
                        <hr>
                        <h3>{{$tugas->judul}}</h3>
                        <p><?= $tugas->isi ?></p>
                        <form action="{{url('client/tugas/jawaban-save/'.$tugas->id_tugas)}}" enctype="multipart/form-data" method="post">
                            @csrf
                            <input type="hidden" name="id_siswa" value="{{Auth::guard('siswa')->user()->id_siswa}}">
                            <div class="form-group">
                                <label for="">Jawaban : </label>
                                <textarea name="jawaban" class="form-control" id="editor" cols="30" style="height:500px"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Upload File : </label><br>
                                <input type="file" name="file" id="" class="form-control"  cols="30" rows="10"></input>
                            </div>
                            <input type="submit" class="btn btn-default" value="Simpan">
                            <a href="{{url('client/tugas')}}" class="btn btn-danger">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@push('js')
<script>
    ClassicEditor
    .create(document.querySelector('#editor'))
    .then(editor => {
        console.log(editor);
    })
    .catch(error => {
        console.error(error);
    });
</script>
@endpush