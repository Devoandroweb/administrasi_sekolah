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
<div class="container-fluid pt-2">
    <div class="card mt-0 pt-3 p-2" style=" border: .5rem solid #d0d0d0;padding: 0rem 1rem !important;">
        <div class="card mt-4 shadow" style="border:2px solid green">
            <div class="card-body">
                <table class=" w-100 table-1 mb-2">
                    <tr>
                        <td width="10%"><label for="">Kelas</label></td>
                        <td width="1%">:</td>
                        <td><select name="kelas" id="" class="form-control">
                                <option value="1" disabled selected>Pilih Kelas</option>
                                <option value="1">Kelas 12 IPA</option>
                            </select></td>
                        <td width="5%"></td>
                        <td width="10%"><label for="">Nama</label></td>
                        <td width="1%">:</td>
                        <td><select name="siswa" id="select-siswa" class="form-control" disabled>
                                <option value="1" disabled selected>Pilih Nama</option>
                                <option value="1">M. Fathur Rosyidin</option>
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
                <table class=" w-100 mb-2">
                    <tr>
                        <td>SPP Bulanan</td>
                        <td>:</td>
                        <td class="text-right">Rp. 300.000</td>
                    </tr>

                </table>
            </div>
            <div class="col">
                <table class=" w-100 mb-2">
                    <tr>
                        <td>SPP Bulanan</td>
                        <td>:</td>
                        <td class="text-right">Rp. 300.000</td>
                    </tr>

                </table>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col">
                <h6>Biaya Dasar</h6>
                <table class="table w-100 table-biaya-dasar">


                    <tr class="bg-success text-white ">

                        <th>Nama Biaya</th>
                        <th>Dibayarkan</th>
                        <th></th>
                    </tr>

                    <tbody class="on-target-biaya-dasar">

                        <tr>

                            <td class="price">Total</td>
                            <td class="total-dasar price">2.000.00</td>
                            <td class="text-right"><button class="btn btn-danger btn-add-bdasar" id="" data-s="1"><i class="material-icons">
                                        add_circle_outline
                                    </i></button></td>
                        </tr>
                    </tbody>

                </table>
            </div>
            <div class="col">
                <h6>Biaya Tanggungan Jatuh Tempo</h6>
                <table class="table w-100 table-biaya-jt">
                    <tr class="bg-danger text-white">

                        <th>Nama Biaya</th>
                        <th>Dibayarkan</th>
                        <th></th>
                    </tr>
                    <tbody class="on-target-biaya-jt">

                        <tr>

                            <td class="price">Total</td>
                            <td class="total-dasar price">2.000.00</td>
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
        var biayaDasar = [
            [0, "SPP", "0"],
            [1, "LKS", "0"]
        ];
        var biayaJT = [
            [0, "SPP_JT", "0"],
            [1, "LKS_JT", "0"]
        ];
        var statusModal = "";

        var biayaDasarActive = [];
        var biayaJTActive = [];
        $(document).on('click', '.btn-add-bdasar', function() {
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
            if (statusModal == "1") {
                b = biayaDasar;
            } else {
                b = biayaJT;
            }
            console.log(statusModal);
            console.log(b);
            for (let i = 0; i < Object.keys(b).length; i++) {
                var active = "";

                if (b[i][2] != "1") {
                    html += '<button type="button" class="btn btn-outline-success ' + active + ' btn-ops" data-text="' + b[i][1] + '" data-index="' + b[i][0] + '" data-check="' + b[i][2] + '">' + b[i][1] + '</button>';
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
                                '<td class="bayar"><input type="text" class="form-control text-right without-rupiah" ></td>' +
                                '<td class="text-right"><button data-text="' + ops[i].innerText + '" data-tr="' + ops[i].attributes['data-index'].nodeValue + '" data-id="' + idGenerate + '" class="btn btn-default btn-remove-bdasar">' +
                                '<i class="material-icons">' +
                                'delete_outline' +
                                '</i></button></td>' +
                                '</tr>';
                        }
                    }
                    if (statusModal == "2") {

                        var e = biayaJTActive.indexOf(ops[i].innerText);
                        console.log(e);
                        if (e == -1) {
                            biayaJTActive.push(ops[i].innerText);
                            html += '<tr id="' + idGenerate + '">' +

                                '<td> ' + ops[i].innerText + ' </td>' +
                                '<td class="bayar"><input type="text" class="form-control text-right without-rupiah"></td>' +
                                '<td class="text-right"><button data-text="' + ops[i].innerText + '" data-tr="' + ops[i].attributes['data-index'].nodeValue + '" data-id="' + idGenerate + '" class="btn btn-default btn-remove-bdasar">' +
                                '<i class="material-icons">' +
                                'delete_outline' +
                                '</i></button></td>' +
                                '</tr>';
                        }
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
            } else {
                biayaJT[indexTr][2] = "0";
                var i = biayaJTActive.indexOf(text);
                biayaJTActive.splice(i, 1);
                console.log(biayaJT);
                console.log(biayaJTActive);
            }

        });

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