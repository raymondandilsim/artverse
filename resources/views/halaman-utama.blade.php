@extends('Master')

@section('Page-Contents')
    <div class="bg-home d-flex align-items-center justify-content-center">
        <div class="greet">
            @if (Auth::check())
                <h2><b>Selamat datang, {{ Auth::user()->nama }}...</b></h2>
                    @else
                        @guest
                            <h2><b> Selamat datang, Pengunjung...</b></h2>
                        @endguest
            @endif
            <h2>
                <b>
                    <?php
                    use Carbon\Carbon;

                    config(['app.locale' => 'id']);
	                Carbon::setLocale('id');

                    echo Carbon::now()->translatedFormat('l, j F Y');
                    ?>
                </b>
            </h2>
        </div>
    </div>
    <div class="px-5 py-3">
        <div class="border-bottom border-dark">
            <div class="d-flex align-items-center">
                <h2 class="fw-bolder">Dapatkan Lukisan</h2>
                <a class="fw-bolder text-danger text-decoration-none ms-3" href="">Lihat Semua</a>
            </div>
            <div class="d-flex my-3">
                <div class="bgcard-art text-white d-flex align-items-center">
                    <p class="ms-5"><b>Bermacam <br> Lukisan</b></p>
                </div>
                <div class="box-card d-flex">
                    <div class="card-art border text-center shadow">
                        <a href="/detailLukisanPage"><img src="\asset\profile.png"></a>
                        <p>harga</p>
                    </div>
                    <div class="card-art border text-center shadow">
                        <a href="/detailLukisanPage"><img src="\asset\profile.png"></a>
                        <p>harga</p>
                    </div>
                    <div class="card-art border text-center shadow">
                        <a href="/detailLukisanPage"><img src="\asset\profile.png"></a>
                        <p>harga</p>
                    </div>
                    <div class="card-art border text-center shadow">
                        <a href="/detailLukisanPage"><img src="\asset\profile.png"></a>
                        <p>harga</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="border-bottom border-dark">
            <div class="d-flex align-items-center">
                <h2 class="fw-bolder me-3">Seniman Terpopuler</h2>
                <a class="fw-bolder text-danger text-decoration-none" href="">Lihat Semua</a>
            </div>
            <div class="d-flex my-3">
                <div class="card-art2 border text-center shadow">
                    <img src="\asset\profile.png">
                    <p>nama</p>
                </div>
                <div class="card-art2 border text-center shadow">
                    <img src="\asset\profile.png">
                    <p>nama</p>
                </div>
                <div class="card-art2 border text-center shadow">
                    <img src="\asset\profile.png">
                    <p>nama</p>
                </div>
                <div class="card-art2 border text-center shadow">
                    <img src="\asset\profile.png">
                    <p>nama</p>
                </div>
            </div>
        </div>
    </div>
@endsection
