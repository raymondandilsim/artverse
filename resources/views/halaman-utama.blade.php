@extends('Master')

@section('Page-Contents')
    <div class="bg-home d-flex align-items-center justify-content-center">
        <div>
            <h3 class="text-white"><b>Anda dapat melihat semua kategori lukisan di sini</b></h3>
            <div class="d-flex justify-content-center">
                <input class="btn-lihat fw-bold text-white mt-4" type="submit" value="Lihat Semua" style="background: #363636">
            </div>
        </div>
    </div>
    <div class="px-5 py-3">
        <div class="border-bottom border-dark">
            <div class="d-flex align-items-center">
                <h2 class="fw-bolder">Dapatkan Diskon</h2>
                <h6 class="txt-tgldiskon mx-3 mb-0"> Berakhir pada 25 Juli 2023</h6>
                <a class="fw-bolder text-danger text-decoration-none" href="">Lihat Semua</a>
            </div>
            <div class="d-flex my-3">
                <div class="bgcard-art text-white d-flex align-items-center">
                    <p class="ms-5"><b>Flash Sale <br> 45%</b></p>
                </div>
                <div class="box-card d-flex">
                    <div class="card-art border text-center shadow">
                        <img src="\asset\profile.png" alt="">
                        <p>harga</p>
                    </div>
                    <div class="card-art border text-center shadow">
                        <img src="\asset\profile.png" alt="">
                        <p>harga</p>
                    </div>
                    <div class="card-art border text-center shadow">
                        <img src="\asset\profile.png" alt="">
                        <p>harga</p>
                    </div>
                    <div class="card-art border text-center shadow">
                        <img src="\asset\profile.png" alt="">
                        <p>harga</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="border-bottom border-dark">
            <div class="d-flex align-items-center">
                <h2 class="fw-bolder me-3 ">Seniman Terpopuler</h2>
                <a class="fw-bolder text-danger text-decoration-none" href="">Lihat Semua</a>
            </div>
            <div class="d-flex my-3">
                <div class="card-art2 border text-center shadow">
                    <img src="\asset\profile.png" alt="">
                    <p>nama</p>
                </div>
                <div class="card-art2 border text-center shadow">
                    <img src="\asset\profile.png" alt="">
                    <p>nama</p>
                </div>
                <div class="card-art2 border text-center shadow">
                    <img src="\asset\profile.png" alt="">
                    <p>nama</p>
                </div>
                <div class="card-art2 border text-center shadow">
                    <img src="\asset\profile.png" alt="">
                    <p>nama</p>
                </div>
            </div>
        </div>
    </div>
@endsection
