<!-- modal pemsukan -->

<div class="modal fade" id="modalPemasukan" tabindex="-1" role="">
    <div class="modal-dialog modal-login modal-lg" role="document">
        <div class="modal-content">
            <div class="card card-signup card-plain">
                <div class="modal-header">
                    <div class="card-header card-header-success w-100 text-center">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            <i class="material-icons">clear</i>
                        </button>

                        <h4 class="card-title">Tambah Pemasukkan</h4>

                    </div>
                </div>
                <div class="modal-body">
                    <form id="form_data_pemasukan" class="form" method="" action="">
                        @csrf
                        <div class="card-body">

                            <div class="form-group bmd-form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="material-icons">face</i>
                                        </span>
                                    </div>
                                    <select class="form-control" data-style="btn btn-link" id="select_siswa" name="nama">
                                        <?php
                                        $siswa = DB::table("data_siswa")->where('deleted', 1)->get();
                                        ?>
                                        <option value="" selected disabled>--| Pilih Siswa |--</option>
                                        @foreach($siswa as $key)
                                        <option value="{{$key->id_siswa}}">{{$key->nama . " - ".$key->kelas." ".$key->rombel}}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>

                            <div class="my-2">
                                <!-- target input -->
                                <table class="table w-100" id="target-input-pembayaran-siswa">

                                </table>
                                <div class="row">

                                </div>
                            </div>
                            <!-- acuan tgg prev -->
                            <div class="display-tgg-prev mt-2">
                                <div class="bg-danger p-2 text-white rounded">Tanggungan Sebelumnya</div>
                                <form class="form" method="" action="">
                                    @csrf
                                    <div class="form-group">
                                        <select class="form-control" data-style="btn btn-link" id="select_tgg_prev" name="title_tgg_prev">


                                        </select>
                                    </div>
                                    <div class="input-group">
                                        <input type="text" class="form-control text-right" name="nominal_tgg_prev" data-a-dec="." placeholder="Nominal">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-fab btn-round btn-primary add-tgg-prev">
                                                <i class="material-icons">add_circle</i>
                                            </button>
                                        </span>
                                    </div>
                                </form>
                                <div style="width: 100%;">
                                    <!-- data tgg prev -->
                                    <ul class="data-tgg-prev" style="display: contents; list-style: none;">

                                    </ul>
                                </div>
                            </div>



                            <div style="display: block; width: 100%; border: 1px solid green; padding: 20px; margin-top:10px; text-align: center; border-radius: 0.3rem; font-weight: bold;">
                                <div style="position: absolute;margin-top: -2rem;background: white;padding: 0px 10px 0px 10px;letter-spacing: 0.1rem;color: #38823b;">Total</div>
                                <span class="total">0</span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-center">
                    <a id="simpan_pemasukan" href="#pablo" class="btn btn-primary btn-link btn-wd btn-lg">Simpan</a>
                    <button id="clear_pemasukan" type="button" class="btn btn-danger btn-link btn-wd btn-lg">Clear</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal pengeluaran -->
<div class="modal fade" id="modalPengeluaran" tabindex="-1" role="">
    <div class="modal-dialog modal-login" role="document">
        <div class="modal-content">
            <div class="card card-signup card-plain">
                <div class="modal-header">
                    <div class="card-header card-header-danger w-100 text-center">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            <i class="material-icons">clear</i>
                        </button>

                        <h4 class="card-title">Tambah Pengeluaran</h4>

                    </div>
                </div>
                <div class="modal-body">
                    <form class="form" method="" action="">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Title" name="key" data-a-dec=".">
                        </div>
                        <div class="input-group">
                            <input type="text" class="form-control text-right" name="nominal_data" data-a-dec="." placeholder="Nominal">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-fab btn-round btn-primary add-data">
                                    <i class="material-icons">add_circle</i>
                                </button>
                            </span>
                        </div>
                    </form>
                    <div class="card p-4">
                        <div class="card-body">
                            <h4 class="text-center font-weight-bold">Uraian</h4>
                            <hr>
                            <div style="width: 100%;">
                                <!-- data uraian -->
                                <ul class="data-uraian" style="display: contents; list-style: none;">

                                </ul>
                            </div>
                            <div style="display: block; width: 100%; border: 1px solid green; padding: 20px; margin-top:10px; text-align: center; border-radius: 0.3rem; font-weight: bold;">
                                <div style="position: absolute;margin-top: -2rem;background: white;padding: 0px 10px 0px 10px;letter-spacing: 0.1rem;color: #38823b;">Total</div>
                                <span class="totalbiaya">0</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button id="save_pengeluaran" type="button" class="btn btn-primary btn-link btn-wd btn-lg">Simpan</button>
                    <button id="clear_pengeluaran" type="button" class="btn btn-danger btn-link btn-wd btn-lg">Clear</button>
                </div>
            </div>
        </div>
    </div>
</div>