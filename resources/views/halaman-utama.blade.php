@extends('Master')

@section('Page-Title')
    Halaman Utama
@endsection

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
                @if ($lukisans->count() > 0)
                    <div class="box-card d-flex">
                        @foreach ($lukisans as $lukisan)
                            <div class="card text-center mt-2 me-4" style="width: 18rem;">
                                <a href="/detailLukisanMemberPage/{{ $lukisan->id }}"
                                    class="text-decoration-none text-dark">
                                    <img src="{{ $lukisan->gambar_pertama }}" class="card-img-top"
                                        alt="{{ $lukisan->nama_lukisan }}" height="250">
                                    <div class="card-body">
                                        <h6 class="card-text">Rp{{ $lukisan->harga }}</h6>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @else
                        <h1 class="display-6 mt-5 ms-5 pt-5">Belum ada lukisan yang terdaftar</h1>
                @endif
            </div>
        </div>
    </div>
    </div>
    <div class="border-bottom border-dark mb-5 px-5 py-3 pb-5">
        <div class="d-flex align-items-center">
            <h2 class="fw-bolder me-3">Seniman</h2>
            <a class="fw-bolder text-danger text-decoration-none" href="">Lihat Semua</a>
        </div>
        @if ($users->count() > 0)
            <div class="d-flex my-3 mb-5">
                @foreach ($users as $user)
                    <div class="card text-center mt-2 me-4" style="width: 18rem;">
                        <a href="/detailLukisanMemberPage/{{ $user->id }}" class="text-decoration-none text-dark">
                            <img src="{{ $user->foto_profil }}" class="card-img-top" alt="{{ $user->foto_profil }}"
                                height="200">
                            <div class="card-body">
                                <h6 class="card-text">{{ $user->username }}</h6>
                            </div>
                        </a>
                    </div>
                @endforeach
            @else
                <h1 class="display-6 mt-5 mb-5 pt-3 pb-5">Belum ada seniman yang terdaftar</h1>
        @endif
    </div>
    </div>
@endsection
