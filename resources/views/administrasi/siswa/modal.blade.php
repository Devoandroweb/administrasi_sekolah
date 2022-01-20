<div class="modal fade" id="modaladdSiswa" tabindex="-1" role="">
    <div class="modal-dialog modal-login modal-lg" role="document">
        <div class="modal-content">
            <div class="card card-signup card-plain">
                <div class="modal-header">
                    <div class="card-header card-header-warning text-center w-100">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            <i class="material-icons">clear</i>
                        </button>

                        <h4 class="card-title">Tambah Siswa</h4>

                    </div>
                </div>
                <form class="form" id="form_data_siswa">
                    <div class="modal-body">

                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">

                                    <div class="form-group bmd-form-group">
                                        <div class="input-group" tooltip="Nama Siswa">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="material-icons">face</i></div>
                                            </div>
                                            <input type="text" name="nama" class="form-control" placeholder="Nama Siswa" required="">
                                        </div>
                                    </div>

                                    <div class="form-group bmd-form-group">
                                        <div class="input-group" tooltip="Tempat Lahir">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="material-icons">house</i></div>
                                            </div>
                                            <input type="text" name="tmp_lahir" class="form-control" placeholder="Tempat Lahir" required="">
                                        </div>
                                    </div>

                                    <div class="form-group bmd-form-group">
                                        <div class="input-group" tooltip="Tanggal Lahir">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="material-icons">event_available</i></div>
                                            </div>
                                            <input type="date" class="form-control" name="tgl_lahir" required="">
                                        </div>
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group bmd-form-group">
                                        <div class="input-group" tooltip="Nomer Induk Sekolah">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="material-icons">stop_circle</i></div>
                                            </div>
                                            <input type="text" class="form-control" name="no_induk" placeholder="Nomer Induk Sekolah" required="">
                                        </div>
                                    </div>
                                    <div class="form-group bmd-form-group">
                                        <div class="input-group" tooltip="Pilih Kelas">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="material-icons">class</i></div>
                                            </div>
                                            <select name="kelas" class="form-control">
                                                <option disabled selected value="default">Pilih Kelas</option>
                                                @foreach($kelas as $key)
                                                <option value="{{$key->id_kelas}}">{{$key->nama." ".$key->nama_jurusan}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group bmd-form-group">
                                        <div class="input-group" tooltip="Nomer Telepon">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="material-icons">phone_in_talk</i></div>
                                            </div>
                                            <input type="number" class="form-control" name="no_tlp" placeholder="Nomer Telepon" required="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group bmd-form-group">
                                <div class="input-group" tooltip="Nomer Induk Siswa National">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="material-icons">reduce_capacity</i></div>
                                    </div>
                                    <input type="text" class="form-control" name="nisn" placeholder="Nomer Induk Siswa National" maxlength="12" required="">
                                </div>
                            </div>

                            <div class="form-group bmd-form-group">
                                <div class="input-group" tooltip="Alamat">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="material-icons">add_location_alt</i></div>
                                    </div>
                                    <textarea class="form-control" name="alamat" placeholder="Alamat" required=""></textarea>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="submit" id="simpan-siswa" class="btn btn-primary btn-link btn-wd btn-lg">simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- modal edit -->
<div class="modal fade" id="modalEdit">
    <div class="modal-dialog modal-login modal-lg" role="document">
        <div class="modal-content">
            <div class="d-block p-4">
                <h5 class="float-left d-flex">Edit Siswa</h5>
                <button type="button" class="close float-right d-relative" data-dismiss="modal" aria-hidden="true">
                    <i class="material-icons">clear</i>
                </button>
            </div>
            <form class="form" id="form_edit_siswa">

                <div class="modal-body">

                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group bmd-form-group">
                                    <div class="input-group" tooltip="Nama Siswa">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="material-icons">face</i></div>
                                        </div>
                                        <input type="text" name="up_nama" class="form-control" placeholder="Nama Siswa" required="">
                                    </div>
                                </div>

                                <div class="form-group bmd-form-group">
                                    <div class="input-group" tooltip="Tempat Lahir">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="material-icons">house</i></div>
                                        </div>
                                        <input type="text" name="up_tmp_lahir" class="form-control" placeholder="Tempat Lahir" required="">
                                    </div>
                                </div>
                                <div class="form-group bmd-form-group">
                                    <div class="input-group" tooltip="Tanggal Lahir">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="material-icons">event_available</i></div>
                                        </div>
                                        <input type="date" class="form-control" name="up_tgl_lahir" required="">
                                    </div>
                                </div>


                            </div>
                            <div class="col">


                                <div class="form-group bmd-form-group">
                                    <div class="input-group" tooltip="Nomer Induk Sekolah">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="material-icons">stop_circle</i></div>
                                        </div>
                                        <input type="number" class="form-control" name="up_no_induk" placeholder="Nomer Induk Sekolah" required="">
                                    </div>
                                </div>
                                <div class="form-group bmd-form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="material-icons">class</i></div>
                                        </div>
                                        <select name="up_kelas" class="form-control">
                                            <option disabled selected value="default">Pilih Kelas</option>
                                            @foreach($kelas as $key)
                                            <option value="{{$key->id_kelas}}">{{$key->nama." ".$key->nama_jurusan}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group bmd-form-group">
                                    <div class="input-group" tooltip="Nomer Telepon">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="material-icons">phone_in_talk</i></div>
                                        </div>
                                        <input type="number" class="form-control" name="up_no_tlp" placeholder="Nomer Telepon" required="">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group bmd-form-group">
                            <div class="input-group" tooltip="Nomer Induk Siswa National">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="material-icons">reduce_capacity</i></div>
                                </div>
                                <input type="number" class="form-control" name="up_nisn" placeholder="Nomer Induk Siswa National" maxlength="10" required="">
                            </div>
                        </div>
                        <div class="form-group bmd-form-group">
                            <div class="input-group" tooltip="Alamat">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="material-icons">add_location_alt</i></div>
                                </div>
                                <textarea class="form-control" name="up_alamat" placeholder="Alamat" required=""></textarea>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" id="" class="btn btn-primary btn-link btn-wd btn-lg simpan-edit">simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modalImport" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <i class="material-icons mr-2">cloud_download</i>
                <h5 class="modal-title"> Import Excel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{url('admin/import_siswa')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">

                    <div id="loading" class="d-none" style="position: absolute; z-index: 9999;text-align: center;width: 100%;  height: 100%">
                        <img class="m-auto" src="{{ url('public/image/808.gif') }}">
                    </div>
                    <div class="form-group form-file-upload form-file-multiple">
                        <input type="file" id="inputFileImport" class="d-none" name="file_import_siswa" multiple="">
                        <div class="input-group">

                            <input id="inputFile1" type="text" class="form-control inputFileVisible" readonly placeholder="Import File Excel" multiple>
                            <span class="input-group-btn">
                                <button type="button" id="inputFile2" class="btn btn-fab btn-round btn-info">
                                    <i class="material-icons">layers</i>
                                </button>
                            </span>
                        </div>
                    </div>
                    <small>Unduh contoh Exelnya <u><a href="download_excel_siswa">disini</a></small></u>
                </div>
                <div class="modal-footer">
                    <input name="kirim" type="submit" class="btn btn-primary" value="Kirim">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>

    </div>
</div>