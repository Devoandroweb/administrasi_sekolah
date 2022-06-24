@extends('template/template',['active' => $active ?? '2','title' => $title])

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col">
                <div class="card card-nav-tabs card-plain">
                    <div class="card-header card-header-info">
                        <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
                        <div class="nav-tabs-navigation">
                            <div class="nav-tabs-wrapper">
                                <ul class="nav nav-tabs" data-tabs="tabs">
                                    <li class="nav-item text-center w-100">
                                        <div class="nav-link" href="#bulanan">Pembayaran Bulanan</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body ">
                        <div class="tab-content">
                            <div class="tab-pane active" id="bulanan">
                                <style>
                                    table tr td,th{
                                        padding: 1rem;
                                        border:1px solid rgb(167, 167, 167);
                                    }
                                </style>
                                <table class="w-100 mb-4">
                                    <thead>
                                        <tr>
                                            <th>Nama Biaya</th>
                                            <th>Update Per-Tanggal</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tgl-biaya">
                                        
                                    </tbody>
                                </table>
                                <a href="#" target="_blank" class="btn btn-success">Tambah Biaya</a>
                                <a href="#" target="_blank" class="btn btn-primary">Simpan</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card card-nav-tabs card-plain">
                    <div class="card-header card-header-danger">
                        <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
                        <div class="nav-tabs-navigation">
                            <div class="nav-tabs-wrapper">
                                <ul class="nav nav-tabs" data-tabs="tabs">
                                    <li class="nav-item text-center w-100">
                                        <div class="nav-link" href="#whatsapp">Whatsapp Gateway</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body ">

                        <div class="tab-content">
                            <div class="tab-pane active" id="whatsapp">
                                <table class="w-100 mb-4">
                                    <tr>
                                        <td>Nama </td>
                                        <td class="text-right" id="nama">{{(isset($data['response'])) ? $data['response']['pushname'] : '-'}}</td>
                                    </tr>
                                    <tr>
                                        <td>Nomor </td>
                                        <td class="text-right" id="nomor">{{(isset($data['response'])) ? "+".$data['response']['me']['user'] : '-'}}</td>
                                    </tr>
                                    <tr>
                                        <td>platform </td>
                                        <td class="text-right" id="platform">{{(isset($data['response'])) ? $data['response']['platform'] : '-'}}</td>
                                    </tr>
                                    <tr>
                                        <td>Status </td>
                                        <td class="text-right" id="status">
                                            @if(isset($data['response']))
                                            <span class="badge badge-success">On</span>
                                            @else
                                            <span class="badge badge-danger">Off</span>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                                <a href="http://localhost:8000/" target="_blank"
                                    class="btn btn-primary">Open App</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        
    </div>
</div>



@endsection

@push('javascript')
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;
    //berjalan ketika pusher di akses
    var pusherClient = new Pusher('58eafcd4dda22b156f9f', {
        cluster: 'ap1'
    });
    var channel = pusherClient.subscribe('my-channel');
    channel.bind('my-event', function(data) {
        console.log(data);
        if(data != null){
            $("#nama").text(data.pushname);
            $("#nomor").text("+"+data.me.user);
            $("#platform").text(data.platform);
            $("#status").html('<span class="badge badge-success">On</span>');
        }else{
            $("#nama").text("-");
            $("#nomor").text("-");
            $("#platform").text("-");
            $("#status").html('<span class="badge badge-danger">Off</span>');
        }
    });
    //date input
    var data = <?php ($biayaUpdater == null) ? [] : $biayaUpdater; ?>
    console.log(data);
    generateTableBiayaBulanan(data);
    function generateTableBiayaBulanan(data = []){
        var html = '';
        for(var i = 0; i < data.length; i++){    
            html += '<tr>\
                <td>SPP</td>\
                <td>';
                html += '<select name="tgl_biaya[]">';
                for (let index = 1; index <= 31; index++) {
                    if(data.tanggal == index){
                        html += '<option selected value="'+index+'">'+index+'</option>';
                    }else{
                        html += '<option value="'+index+'">'+index+'</option>';
                    }
                }
                html += '</select>';
            html += '</td></tr>';
        }
        if(data.length == 0){
            html = "<tr><td colspan='2'><p class='text-center mb-0'>Data Kosong</p></td></tr>";
        }
        $('#tgl-biaya').html(html);

    }
</script>
@endpush