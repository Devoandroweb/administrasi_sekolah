@extends('template/template',['active' => $active ?? '2','title' => $title])
@section('content')
<style>
    .ck-editor {
        padding-top: 20px !important;
    }

    .ck-editor__editable_inline {
        min-height: 500px;
    }
</style>
<div class="card p-2">
    <div class="card-header card-header-text card-header-warning">
        <div class="card-text">
            <h4 class="card-title">{{$title}}</h4>
        </div>
    </div>
    <div class="card-body">
        <div class="card-body">
            <form action="{{url('admin/tugas-add-save')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <div>
                        <label>Judul</label>
                    </div>
                    <input type="text" value="" name="judul" class="form-control" />
                </div>
                <div class="form-group">
                    <label class="mb-4">Deskripsi</label>
                    <textarea name="isi" class="form-control" id="editor" rows="10"></textarea>
                </div>
                <div class="form-group">
                    <div>
                        <label>Type Tugas</label>
                    </div>
                    <div class="form-check form-check-radio form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="type" id="semua-siswa" value="1"> Semua Siswa
                            <span class="circle">
                                <span class="check"></span>
                            </span>
                        </label>
                    </div>
                    <div class="form-check form-check-radio form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="type" id="satu-siswa" value="2"> Satu Siswa
                            <span class="circle">
                                <span class="check"></span>
                            </span>
                        </label>
                    </div>
                </div>
                <div class="form-group en-type-individu d-none">
                    <label>Siswa</label>
                    <select name="id_siswa" class="form-control" id="">

                    </select>
                </div>
                <div class="form-group">
                    <label>Kelas</label>
                    <select name="id_kelas" class="form-control" id="">
                        <option value="" disabled selected>-- Pilih Kelas --</option>
                        @foreach($kelas as $key)
                        <option value="{{$key->id_kelas}}">{{$key->nama_kelas.' '.$key->nama_jurusan}}</option>
                        @endforeach
                    </select>
                </div>

                <div class=" form-group">
                    <label>File</label>
                    <div class="form-group form-file-upload form-file-multiple bmd-form-group">
                        <input type="file" id="inputFileImport" class="d-none" name="file" multiple="">
                        <div class="input-group">

                            <input id="inputFile1" type="text" class="form-control inputFileVisible" readonly="" placeholder="Klik disini untuk menambahkan File" multiple="">
                            <span class="input-group-btn">
                                <button type="button" id="inputFile2" class="btn btn-fab btn-round btn-info">
                                    <i class="material-icons">layers</i>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Pengajar</label>
                    <select name="id_guru" class="form-control" id="">

                        <option value="" disabled selected>-- Pilih Pengajar --</option>
                        @foreach($guru as $key)
                        <option value="{{$key->id_guru}}">{{$key->nama}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>

@endsection
@push("javascript")
<script>
    $(document).ready(function() {
        $("input[name=type]").prop('checked', false);

        $("input[name=type]").click(function() {
            checkType(this);
        });

        function checkType(a) {
            var val = $(a).val();
            if (val == 1) {
                $(".en-type-individu").addClass("d-none");
            } else {
                $(".en-type-individu").removeClass("d-none");

            }
        }
        ClassicEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    })
</script>
@endpush