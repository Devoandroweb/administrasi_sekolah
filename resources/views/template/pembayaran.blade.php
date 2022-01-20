@include('template.head')
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
<style>
    h2 {
        font-weight: bold;
        text-align: center;
        margin: 2rem 0;
    }

    label {
        color: black;
        margin-bottom: 0;
        font-weight: bold;
    }

    .contex tr:nth-child(1) {
        background-color: #85f79c;
    }

    .price {
        font-weight: bold;
    }

    .bayar {
        font-weight: bold;
        /* background-color: #8a8a8a; */
    }

    .bayar input {
        font-weight: bold;
        border-width: 2px;
        border-style: dashed;
        padding: 20px 10px;
    }

    .bayar input:focus {
        border-color: red;
    }



    body {
        /* background-color: #28a745; */
    }

    .total {
        border-width: 3px;
        border-style: dashed;
        padding: 1rem;
        text-align: center;
        font-size: 20pt;
        font-weight: bold;
        /* border-radius: 10px; */
        animation-name: animate-border;
        animation-duration: 1s;
        animation-iteration-count: infinite;
    }

    @keyframes animate-border {
        0% {
            border-color: red;
        }

        50% {
            border-color: green;
        }

        100% {
            border-color: red;
        }
    }

    .table-1 td {
        padding: .5rem;
    }

    .push-total {
        display: flex;
        align-items: center;
        width: 100%;
    }

    .push-total .total {
        width: 60%;
    }

    .push-total .button {
        width: 20%;
        display: flex;
    }

    .push-total .button button {
        width: 100%;
        padding: 1.5rem 0;
        margin: 0 0 0 1rem;
    }

    .shadow {
        box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important
    }
</style>
<form action="{{url('pembayaran-save')}}" method="post">
    @csrf
    <div class="container-fluid pt-2">
        <div class="card mt-0 pt-3 p-2" style=" border: .5rem solid #d0d0d0;padding: 0rem 1rem !important;">
            <div class="card mt-4 shadow" style="border:2px solid green">
                <div class="card-body">
                    <table class=" w-100 table-1 mb-2">
                        <tr>
                            <td width="10%"><label for="">Kelas</label></td>
                            <td width="1%">:</td>
                            <td width="39%"><select name="kelas" id="select-kelas" class="form-control">
                                    <option value="1" disabled selected>Pilih Kelas</option>
                                    @foreach($kelas as $key)
                                    <option value="{{$key->id_kelas}}">{{$key->nama." ".$key->nama_jurusan}}</option>
                                    @endforeach
                                </select></td>
                            <td width="10%"><label for="">Nama</label></td>
                            <td width="1%">:</td>
                            <td><select name="siswa" id="select-siswa" class="form-control" disabled>
                                    <option value="1" disabled selected>Pilih Siswa</option>

                                </select></td>
                        </tr>

                    </table>
                </div>
            </div>

            <div class="push-total">
                <div class="total">
                    <span>Rp. 2.000.000</span>
                </div>
                <div class="button">
                    <button type="submit" class="btn btn-danger"><i class="material-icons">
                            save
                        </i> Simpan Pembayaran</button>
                </div>
                <div class="button">
                    <button type="submit" class="btn btn-info"><i class="material-icons">
                            qr_code_scanner
                        </i> Scan</button>
                </div>
            </div>
            <hr>
            <h6 class="text-center bg-warning">Administrasi yang perlu di Bayar</h6>
            <div class="row">
                <div class="col">
                    <h6>Biaya Dasar</h6>

                    <table class=" w-100 mb-2" id="info-bd">


                    </table>
                </div>
                <div class="col">
                    <h6>Biaya Tanggungan Jatuh Tempo</h6>
                    <table class=" w-100 mb-2" id="info-bjt">


                    </table>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col">
                    <table class="table w-100 table-biaya-dasar">


                        <tr class="bg-success text-white ">

                            <th>Nama Biaya</th>
                            <th>Dibayarkan</th>
                            <th></th>
                        </tr>

                        <tbody class="on-target-biaya-dasar">

                            <tr>

                                <td class="price">Total</td>
                                <td class="total-dasar price total-d text-right">0</td>
                                <td class="text-right"><button class="btn btn-danger btn-add-bdasar" id="" data-s="1"><i class="material-icons">
                                            add_circle_outline
                                        </i></button></td>
                            </tr>
                        </tbody>

                    </table>
                </div>
                <div class="col">
                    <table class="table w-100 table-biaya-jt">
                        <tr class="bg-danger text-white">

                            <th>Nama Biaya</th>
                            <th>Dibayarkan</th>
                            <th></th>
                        </tr>
                        <tbody class="on-target-biaya-jt">

                            <tr>

                                <td class="price">Total</td>
                                <td class="total-dasar price total-jt text-right">0</td>
                                <td class="text-right"><button class="btn btn-success btn-add-bdasar" id="" data-s="2"><i class="material-icons">
                                            add_circle_outline
                                        </i></button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</form>
<div class="modal" tabindex="-1" role="dialog" id="modalAddPembayaran">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambahkan Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body on-target">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-add-dasar">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


@include('template.include-js')
<script>
    $(document).ready(function() {
        $('#select-siswa').prop('selectedIndex', 0);
        $('#select-kelas').prop('selectedIndex', 0);
        var biayaDasar = [];
        var biayaJT = [];
        var statusModal = "";
        var biayaDasarActive = [];
        var biayaJTActive = [];



        $(document).on('click', '.btn-add-bdasar', function(e) {
            e.preventDefault();
            statusModal = $(this).data("s");
            attactBiaya();
            $("#modalAddPembayaran").modal("show");
        });
        $(document).on('click', ".btn-ops", function() {
            var index = $(this).data('index');
            $(this).toggleClass("btn-outline-danger");

            if (statusModal == "1") {
                if ($(this).attr("data-check") == "1") {
                    $(this).attr("data-check", "0");
                    biayaDasar[index][2] = "0";
                } else {
                    $(this).attr("data-check", "1");
                    biayaDasar[index][2] = "1";
                }
            }
            if (statusModal == "2") {
                if ($(this).attr("data-check") == "1") {
                    $(this).attr("data-check", "0");
                    biayaJT[index][2] = "0";
                } else {
                    $(this).attr("data-check", "1");
                    biayaJT[index][2] = "1";
                }
            }

        });
        // pilihan biaya dasar


        function attactBiaya() {
            var html = "";
            var a = 0;
            var b = [];
            var tahunAjaran = "";
            if (statusModal == "1") {
                b = biayaDasar;
            } else {
                b = biayaJT;
            }
            console.log("cek biaya");
            console.log(b);
            for (let i = 0; i < Object.keys(b).length; i++) {
                var active = "";

                if (b[i][2] != "1") {
                    if (b[i][4] != undefined) {

                        if (tahunAjaran != b[i][4]) {
                            html += '<h6 class="text-center mt-2 bg-warning">' + b[i][4] + '</h6>';
                            tahunAjaran = b[i][4];
                        }
                    }
                    html += '<button type="button" class="btn btn-outline-success ' + active + ' btn-ops" data-text="' + b[i][1] + ' ' + tahunAjaran + '" data-index="' + b[i][0] + '" data-ajaran="' + tahunAjaran + '" data-check="' + b[i][2] + '" data-id="' + b[i][3] + '">' + b[i][1] + '</button>';
                    a++;
                }

            }
            if (a == 0) {
                html = "<p class='text-default text-center'> Tidak ada yang tersedia </p>";
            }
            $("#modalAddPembayaran .on-target").html(html);
        }
        $(".btn-add-dasar").click(function() {
            var ops = $(".btn-ops");
            console.log(ops);
            var html = '';
            var ajaran = '';
            for (var i = 0; i < ops.length; i++) {
                var idGenerate = makeid(5);

                if (ops[i].attributes['data-check'].nodeValue == 1) {
                    if (statusModal == "1") {

                        var e = biayaDasarActive.indexOf(ops[i].innerText);
                        console.log(e);
                        if (e == -1) {
                            biayaDasarActive.push(ops[i].innerText);
                            html += '<tr id="' + idGenerate + '">' +

                                '<td> ' + ops[i].innerText + ' </td>' +
                                '<td class="bayar">' +
                                '<input type="hidden" name="bdasarid[]" value="' + ops[i].attributes['data-id'].nodeValue + '">' +
                                '<input type="text" class="form-control text-right biaya-d without-rupiah" name="bdasar[]"></td>' +
                                '<td class="text-right"><button data-text="' + ops[i].innerText + '" data-tr="' + ops[i].attributes['data-index'].nodeValue + '" data-id="' + idGenerate + '" class="btn btn-default btn-remove-bdasar">' +
                                '<i class="material-icons">' +
                                'delete_outline' +
                                '</i></button></td>' +
                                '</tr>';
                        }
                    }
                    if (statusModal == "2") {

                        var e = biayaJTActive.indexOf(ops[i].attributes['data-text'].nodeValue);
                        console.log(e);
                        if (e == -1) {
                            biayaJTActive.push(ops[i].attributes['data-text'].nodeValue);
                            ajaran = ops[i].attributes['data-ajaran'].nodeValue;


                            html += '<tr id="' + idGenerate + '">' +

                                '<td> ' + ops[i].innerText + ' <span class="badge badge-info">' + ajaran + '</span> </td>' +
                                '<td class="bayar"><input type="text" class="form-control text-right biaya-jt without-rupiah" name="bjt-' + ops[i].attributes['data-id'].nodeValue + '"></td>' +
                                '<td class="text-right"><button data-text="' + ops[i].innerText + '" data-tr="' + ops[i].attributes['data-index'].nodeValue + '" data-id="' + idGenerate + '" class="btn btn-default btn-remove-bdasar">' +
                                '<i class="material-icons">' +
                                'delete_outline' +
                                '</i></button></td>' +
                                '</tr>';
                        }
                        console.log("Check Ajaran");
                        console.log(ops[i].attributes['data-ajaran'].nodeValue);
                    }

                }
            }
            console.log(biayaDasarActive);
            console.log(biayaJTActive);
            if (statusModal == "1") {

                $(".on-target-biaya-dasar").prepend(html);
            } else {
                $(".on-target-biaya-jt").prepend(html);

            }
            $("#modalAddPembayaran").modal("hide");

        });
        $(document).on("click", ".btn-remove-bdasar", function() {
            var text = $(this).data("text");
            var indexTr = $(this).data("tr")
            var id = $(this).data("id");
            $("#" + id).remove();
            if (statusModal == "1") {
                biayaDasar[indexTr][2] = "0";
                var i = biayaDasarActive.indexOf(text);
                biayaDasarActive.splice(i, 1);
                console.log(biayaDasar);
                console.log(biayaDasarActive);

                hitungTotalD();


            } else {
                biayaJT[indexTr][2] = "0";
                var i = biayaJTActive.indexOf(text);
                biayaJTActive.splice(i, 1);
                hitungTotalJT();

            }

        });
        $("select[name=kelas]").change(function() {
            var id = $(this).val();
            $.ajax({
                type: "get",
                url: "{{url('pembayaran-get-siswa')}}/" + id,
                dataType: "JSON",
                success: function(response) {
                    var html = '<option disabled selected>Pilih Siswa</option>';
                    if (response.status) {
                        for (let i = 0; i < response.data.length; i++) {
                            html += '<option value="' + response.data[i].id_siswa + '">' + response.data[i].nama + '</option>';
                        }
                    }
                    $("select[name=siswa]").removeAttr("disabled");
                    $("select[name=siswa]").html(html);

                }
            });
        });
        $("select[name=siswa]").change(function() {
            var id = $(this).val();
            $.ajax({
                type: "get",
                url: "{{url('pembayaran-get-adm')}}/" + id,
                dataType: "JSON",
                success: function(response) {

                    if (response.status) {
                        // var biayaDasar = [
                        //     [0, "SPP", "0"],
                        //     [1, "LKS", "0"]
                        // ];
                        var htmlBd = "<tr><td colspan='3' class='bg-secondary text-light text-center'>Tahun Akademik : Sekarang</td><tr>";

                        for (let i = 0; i < response.data.length; i++) {

                            biayaDasar.push([i, response.data[i].nama_adm, "0", response.data[i].id_jenis_adm]);
                            htmlBd += "<tr>" +
                                "<td>" + response.data[i].nama_adm + "</td>" +
                                "<td>:</td>" +
                                "<td>Rp. " + response.data[i].value_adm + "</td>" +
                                "<tr>";
                        }
                        $("#info-bd").html(htmlBd);
                        var htmlJT = "";
                        var indexArray = -1;
                        for (let j = 0; j < response.data_before.length; j++) {
                            htmlJT += "<tr><td colspan='3' class='bg-secondary text-light text-center'>Tahun Akademik : " + response.data_before[j].tahun_ajaran + "</td><tr>";
                            var json = JSON.parse(response.data_before[j].value);
                            for (let k = 0; k < json.length; k++) {
                                indexArray++;
                                biayaJT.push([indexArray, json[k].nama_adm, "0", json[k].id_jenis_adm, response.data_before[j].tahun_ajaran]);
                                htmlJT += "<tr>" +
                                    "<td>" + json[k].nama_adm + "</td>" +
                                    "<td>:</td>" +
                                    "<td>Rp. " + json[k].value_adm + "</td>" +
                                    "<tr>";
                            }
                            $("#info-bjt").html(htmlJT);

                        }
                    }


                }
            });
        });


        $(document).on("keyup", ".biaya-d", function() {
            hitungTotalD();
        });
        $(document).on("keyup", ".biaya-jt", function() {
            hitungTotalJT();
        });

        function hitungTotalD() {
            var totalD = 0;

            $(".biaya-d").each(function(e) {
                var val = $(this).val();

                if (val == "") {
                    val = "0";
                }
                val = val.replace(".", "");
                console.log(val);

                console.log("cek total => " + totalD);
                totalD = totalD + parseInt(val);
                console.log("cek total => " + totalD);
                // console.log(result);
            });
            $(".total-d").text(formatRupiah(totalD.toString(), "."));
        }

        function hitungTotalJT() {
            var totalJT = 0;
            $(".biaya-jt").each(function(e) {
                var val = $(this).val();

                if (val == "") {
                    val = "0";
                }
                val = val.replace(".", "");
                console.log(val);

                totalJT = totalJT + parseInt(val);
                // console.log(result);
            });
            $(".total-jt").text(formatRupiah(totalJT.toString(), "."));
        }

        function makeid(length) {
            var result = '';
            var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            var charactersLength = characters.length;
            for (var i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() *
                    charactersLength));
            }
            return result;
        }
    });
</script>