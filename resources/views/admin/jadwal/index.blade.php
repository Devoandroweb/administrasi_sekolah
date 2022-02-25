@extends('template/template',['active' => $active ?? '2','title' => $title])
@section('content')
<style>
    table{
        border-collapse: collapse;
    }
    table tr th{
        border: 1px solid black;
        text-align: center;
    }
    .accordion-day .head{
        display: flex;
        align-items: center;
    }
    .btn-show{
        display: flex;
        align-items: center;
    }
    .accordion-day{
        background-color: #fff;
        transition: all 0.5s;
        color: #fff;
    }
    .accordion-day:hover{
        background-color: rgb(220, 222, 223);
        transition: all 0.5s;
    }
    .btn-edit:hover{
        color: aqua;
    }
    /* ---------- Useful Button styling ---------- */

    .accordion-day{
        position: relative;
        background-color: black;
        border-radius: 4em;
        font-size: 16px;
        color: white;
        padding: 0.8em 1.8em;
        cursor:pointer;
        user-select:none;
        text-align: center;
        text-decoration: none;
        cursor: pointer;
        transition-duration: 0.4s;
        -webkit-transition-duration: 0.4s; /* Safari */
    }

    .accordion-day:hover {
    transition-duration: 0.1s;
    background-color: #3A3A3A;
    color: #fff;

    }
    .accordion-day:link{
        color: #fff;

    }

    .accordion-day:after {
    content: "";
    display: block;
    position: absolute;
    border-radius: 4em;
    left: 0;
    top:0;
    width: 100%;
    height: 100%;
    opacity: 0;
    transition: all 0.5s;
    box-shadow: 0 0 10px 40px rgb(243, 134, 134);
    }

    .accordion-day:active:after {
    box-shadow: 0 0 0 0 rgb(44, 43, 43);
    position: absolute;
    border-radius: 4em;
    left: 0;
    top:0;
    opacity: 1;
    transition: 0s;
    }

    .accordion-day:active {
    top: 1px;
    color: #fff;

    }


</style>
<div class="card p-2">
    <div class="card-header card-header-text card-header-warning">
        <div class="card-text">
            <h4 class="card-title">{{$title}}</h4>
        </div>
    </div>
    <div class="card-body">
        <div class="msg">
            @if(session('msg'))
            <div class="alert alert-danger" role="alert">{{session('msg')}}</div>
            @endif
        </div>
        <?php 
            $day = 0;
            $treadJadwal = [];
            $t = 0;
            $a = [];
        ?>
        @for($i=1;$i < 7 ;$i++)
        @if($i != $day)
        @php
            $longKelas = 0;
            $htmlHeadTableKelas = "";
            $htmlTdNamaKelas = "";
            $htmlPelajaranhead = "";
            $htmlMapel = "";
            $idKelas = [];
             
            foreach($kelas as $key){
                $longKelas = $longKelas + 2;
                $htmlTdNamaKelas .= "<th colspan='2' class='text-center bg-success'>".$key->nama_kelas." ".$key->nama_jurusan." id : ".$key->id_kelas."</th>";
                $htmlPelajaranhead .= "<th class='bg-info'>KG</th><th class='bg-warning'>MAPEL</th>";
                array_push($idKelas,$key->id_kelas);
            }
            
            
            $t++;
            $day = $i; 
        @endphp
        <a class="accordion-day card p-2 pl-3 pr-3 position-relative" href="{{GF::convertDayJadwal($i)}}">
            <div class="head">
                <h6 class="mb-0">Hari {{GF::convertDayJadwal($i)}}</h6>
                <span class="btn-show position-absolute" style="right: 1rem;z-index: 2;">
                    <small class="btn-edit" data-href="{{url('admin/jadwal-edit/'.$i)}}">
                        <i class="material-icons">drive_file_rename_outline</i> Edit        
                    </small>
                    
                    </span>
            </div>
        </a>
        <div class="body d-none" id="{{GF::convertDayJadwal($i)}}">
            <table class="w-100">
                <tr>
                    <th class="text-uppercase" rowspan="3" width="5%">Jam Ke</th>
                    <th class="text-center text-uppercase bg-danger" colspan="{{$longKelas}}">Kelas</th>
                </tr>
                <tr>
                    <?= $htmlTdNamaKelas ?>
                </tr>
                <tr>
                    <?= $htmlPelajaranhead ?>
                </tr>
                @php
                $getJadwal = DB::table("jadwal")->where("hari",$i)->orderBy("jam_ke","asc")->get();
                @endphp
                <!-- looping jadwal berdasarkan jamke  -->
                @for($l=1; $l <= 8;$l++)
                <tr>
                    <td class="text-center">{{$l}}</td>
                    @php  
                    $g = DB::table("jadwal")
                            ->select("m_guru.*","m_mapel.*","jadwal.*","m_mapel.nama as nama_mapel","m_guru.kode as kode_guru")
                            ->join("m_guru","m_guru.id_guru","=","jadwal.id_guru","left")
                            ->join("m_mapel","m_mapel.id_mapel","=","jadwal.id_mapel","left")
                            ->where("hari",$i)
                            ->where("jam_ke",$l)
                            ->get(); 
                    
                    @endphp
                    @foreach($g as $r)
                        @foreach($idKelas as $k)
                            @if($k == $r->id_kelas)
                            <td class="text-center">{{$r->kode_guru}}</td>
                            <td class="text-center">{{$r->nama_mapel}}</td>
                            @endif
                        @endforeach
                    @endforeach
                   </tr>
                @endfor
            </table>

        </div> 
        @endif
        @endfor
    </div>
</div>


@endsection

@push('javascript')

<!-- accordion-day -->
<script>
$(".accordion-day").click(function(e){
    e.preventDefault();
    var val = $(this).attr("href");
    $("#"+val).toggleClass("d-none");
});
$(".btn-edit").click(function(e){
    e.preventDefault();
    var href = $(this).data('href');
    window.location = href;
})
</script>

@endpush
