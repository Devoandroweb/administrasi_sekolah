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
    <form action="{{url('admin/jadwal-show-save/'.$day)}}" method="post">
        @csrf
        <div class="card-body mt-3">
            @if(session("msg"))
            <div class="alert alert-success">
                {{session("msg")}}
            </div>
            @endif
            <!-- looping by kelas -->
            @foreach($kelas as $k)
            <a class="accordion-day card p-2 pl-3 pr-3 position-relative" href="#" data-href="{{$k->id_kelas}}">
                <div class="head">
                    <h6 class="mb-0">KELAS {{$k->nama_kelas." ".$k->nama_jurusan}}</h6>
                </div>
            </a>
            <div class="body d-none" id="{{$k->id_kelas}}"> 
                <div class="row font-weight-bold my-2 mx-auto">
                    <div class="col-1">Jam Ke</div>
                    <div class="col">Mata Pelajaran</div>
                    <div class="col">Pengajar</div>
                
                </div>
                <input type="hidden" name="id_kelas[]" value="{{$k->id_kelas}}">
                @for($i = 0; $i < 8; $i++)
                    <input type="hidden" name="data[]" value="{{$k->id_kelas}}-{{$i+1}}">
                    <div class="row mx-auto jadwal-{{$jadwal[$i]->id_kelas}}">
                        <div class="col-1 text-center d-flex align-items-center jam">
                            <span class="m-auto">{{$i+1}}</span>
                        </div>
                        <div class="col">
                            <select name="mapel[]" id="" class="form-control select-mapel">
                                @foreach($mapel as $m)
                                @if($jadwal[$i]->id_mapel == $m->id_mapel)
                                <option value="{{$m->id_mapel}}" data-guru="{{$k->id_guru}}" selected>{{$m->nama}}</option>
                                @else
                                <option value="{{$m->id_mapel}}" data-guru="{{$k->id_guru}}">{{$m->nama}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <select name="pengajar[]" id="" class="form-control">
                                
                            </select>
                        </div>
                        
                       
                    </div>
                    
                @endfor
                
            </div>
            @endforeach

            <!-- end lopping kelas -->
            

            <input type="submit" class="btn btn-danger mt-4" value="Simpan">
            <a href="{{url('admin/jadwal')}}" class="btn btn-default mt-4">Kembali</a>
        </div>
    </form>
</div>


@endsection

@push('javascript')

<!-- accordion-kelas -->
<script>
    
    $(".accordion-day").click(function(e){
        e.preventDefault();
        var val = $(this).data("href");
        $("#"+val).toggleClass("d-none");
    });
    $(".btn-edit").click(function(e){
        e.preventDefault();
        var href = $(this).data('href');
        window.location = href;
    });
    var guru = <?= $guru ?>;

    $(".select-mapel").change(function(e){
        $(this).val();
    })
    
</script>

@endpush
