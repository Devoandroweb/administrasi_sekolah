<script>
    $('#select_siswa').prop('selectedIndex', 0);
    $('#select_siswa').change(function() {

        var id = $(this).val();
        $.ajax({
            type: "post",
            url: '{{url("read_adm_by_siswa")}}/' + id,
            dataType: "JSON",
            success: function(response) {
                var adm = JSON.parse(response.value);
                var html = "";
                console.log(Object.keys(adm).length);
                for (var i = 0; i < Object.keys(adm).length; i++) {

                    html += '<tr>' +
                        '<td>' + adm[i].nama_adm + '</td>' +
                        '<td>:</td>' +
                        '<td>' +
                        '<input type="hidden" name="id_adm[]" value="' + adm[i].id_jenis_adm + '">' +
                        '<input type="hidden" class="form-control text-right" name="nama_adm[]" value="' + adm[i].nama_adm + '">' +
                        '<input type="text" class="form-control text-right" name="value_adm[]" value="' + adm[i].value_adm + '"></td>' +
                        '</tr>';


                }
                $('#target-input-pembayaran-siswa').html(html);
            }
        });

    })
</script>