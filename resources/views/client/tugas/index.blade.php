@extends("client.app")
@section("content")
<style>
    .icon{
        border-right: 1px solid #C4C4C4;
        padding-right: 0.5rem;
        margin-right: 0.5rem;
    }
</style>
<div class="title mb-4">
    <h1>Tugas</h1>
</div>
<div class="row">
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
        </div>
           
    </div>
</div>
@endsection
@push('js')
<script>
    $('.owl-carousel').owlCarousel({
    loop:false,
    margin:10,
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
})
</script>
@endpush