@extends("client.app")
@section("content")
<style>
    .icon{
        border-right: 1px solid #C4C4C4;
        padding-right: 0.5rem;
        margin-right: 0.5rem;
    }
</style>

<div class="row mb-4 d-none">
    <div class="col-lg">
        <div class="owl-carousel owl-theme">
            <div class="item">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="d-flex">
                            <div class="icon">
                                <i class="mdi mdi-arrange-send-backward"></i>
                            </div>
                            <label class="mb-0">Bahasa Indonesia</label>
                            <div class="donwload ms-auto">
                                <a href="#" class="text-success">Donwload</a>
                            </div>
                        </div>
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="..." class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body p-3">
                                    <h6 class="card-title">Soal Bab 3 Etika membaca tulisan dengan benar.</h6>
                                    <p class="card-text "><small class="text-muted">Terakhir Pengumpulan</small></p>
                                    <hr>
                                    <div class="text-end">
                                        <p class="card-text"><small class="text-danger">Jumat, 11 Mei 2021</small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="d-flex">
                            <div class="icon">
                                <i class="mdi mdi-arrange-send-backward"></i>
                            </div>
                            <label class="mb-0">Bahasa Indonesia</label>
                            <div class="donwload ms-auto">
                                <a href="#" class="text-success">Donwload</a>
                            </div>
                        </div>
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="..." class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body p-3">
                                    <h6 class="card-title">Soal Bab 3 Etika membaca tulisan dengan benar.</h6>
                                    <p class="card-text "><small class="text-muted">Terakhir Pengumpulan</small></p>
                                    <hr>
                                    <div class="text-end">
                                        <p class="card-text"><small class="text-danger">Jumat, 11 Mei 2021</small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
           
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h2>Tugas</h2>
                        <p>Tugas yang berstatus <span class="text-danger">Akan Ditutup</span>, harus segera di selesaikan </p>
                    </div>
                </div>
                <div class="table-responsive d-none d-md-block">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Nama Pelajaran</th>
                                <th scope="col">Terkahir Pengumpulan</th>
                                <th scope="col">Status</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tugas as $key)
                            <tr>
                                <td>
                                    <div class="d-flex align-item-center">
                                        <div class="img me-2">
                                            <?= $key->mapel->gambar(60,60) ?>
                                        </div>
                                        <div class="content">
                                            <h6 class="card-title">{{$key->mapel->nama}}</h6>
                                            <p class="card-text">{{$key->judul}}</p>
                                        </div>
                                    </div>
                                    
                                </td>
                                <td>
                                    <h6 class="card-title text-capitalize">{{GF::convertDay(date('D',strtotime($key->expired)))}}</h6>
                                    <p class="card-text">{{GF::format_date($key->expired,false,false,false)}}</p>
                                </td>
                                <td>
                                    <?= $key->status() ?>
                                </td>
                                <td>
                                   <?= $key->withTugasSelesaiLink(); ?>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="mobile d-block d-md-none">
            <hr>
            @foreach($tugas as $key)
            <div class="row">
                <div class="col">
                    <div class="card item-tugas <?= $key->withTugasSelesaiBg(); ?>" data-link="{{$key->link()}}">
                        <div class="card-body p-3">
                            <div class="d-flex">
                                <div class="icon">
                                    <i class="mdi mdi-arrange-send-backward"></i>
                                </div>
                                <label class="mb-0">{{$key->mapel->nama}} </label>
                                <div class="donwload ms-auto">
                                    <!-- <a href="#" class="text-success">Donwload</a> -->
                                    <span class="badge bg-success">Aktif</span>
                                </div>
                            </div>
                            <div class="row g-0">
                                <div class="col-md">
                                    <div class="card-body p-3">
                                        <h6 class="card-title">{{$key->judul}}</h6>
                                        <p class="card-text "><small class="text-muted">Terakhir Pengumpulan</small></p>
                                        <hr>
                                        <div class="text-end">
                                            <p class="card-text"><small class="text-danger">{{GF::format_date($key->expired)}}</small>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            @endforeach
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
    $('.owl-carousel').owlCarousel({
    loop:false,
    margin:30,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
            items:2
        }
    }
});
$('.item-tugas').click(function(){
    window.location.href = $(this).data("link");
})
</script>
@endpush