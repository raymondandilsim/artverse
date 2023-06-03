<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('Page-Title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
</head>

<body>

    {{-- success --}}
    @if (Session::has('status'))
        <div class="alert alert-success alert-dismissible fade show fixed-top m-5" role="alert">
            {{ Session::get('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- error handling --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show fixed-top m-5" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="p-2">{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <header class="bg-header">
        <nav class="d-flex justify-content-around py-4">
            {{-- Menu Offcanvas --}}
            @if (Auth::check() && Auth::user()->role_id === 3)
                <div class="d-flex align-items-center">
                    <button class="btn btn-light border-0" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasExample" aria-controls="offcanvasExample"><i
                            class="bi bi-caret-right-fill"></i>
                    </button>
                    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample"
                        aria-labelledby="offcanvasExampleLabel">
                        <div class="offcanvas-header">
                            <img src="{{ auth()->user()->foto_profil }}" alt="Profile Picture" class="img-fluid"
                                width="80" height="80">
                            <h5>{{ auth()->user()->nama }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                        </div>
                        <div class="p-3 ms-4 mt-3">
                            <div>
                                <a class="text-decoration-none text-dark" href=""><i
                                        class="bi-chat-left-text me-4"></i><b>Obrolan</b></a>
                            </div>
                            <div class="my-4">
                                <a class="text-decoration-none text-dark" href=""><i
                                        class="bi bi-chat-left-quote me-4"></i><b>Diskusi</b></a>
                            </div>
                            <div class="my-4">
                                <a class="dropdown-toggle link-dark text-decoration-none" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-archive me-4"></i><b>Produk</b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="/unggahLukisanPage">Tambah Produk</a></li>
                                    <li><a class="dropdown-item" href="/daftarLukisanPage">Daftar Produk</a></li>
                                </ul>
                            </div>
                            <div class="my-4">
                                <a class="text-decoration-none text-dark" href=""><i
                                        class="bi bi-bag-check me-4"></i><b>Pesanan</b></a>
                            </div>
                        </div>
                        <form action="/ubahPeran/{{ auth()->user()->id }}" method="POST">
                            @csrf
                            <div class="d-flex justify-content-center">
                                <input class="btn-jadi-member text-white mt-3" type="submit" value="Jadi Member">
                            </div>
                        </form>
                    </div>
                </div>
            @endif
            <div class="align-items-center justify-content-center">
                @if (Auth::check() && Auth::user()->role_id === 3)
                    <img src="\asset\logoArtverse.png">
                @else
                <a href="/"><img src="\asset\logoArtverse.png"></a>
                @endif
            </div>
            <div class="d-flex align-items-center">
                <form action="/search" method="GET">
                <div class="search">
                    <i class="ms-4 bi-search"></i>
                    <input class="ps-3 border-0 form-control" type="search" name="search" placeholder="Cari Lukisan...">
                </div>
            </form>
            </div>
            @auth
                <div class="d-flex align-items-center">
                    @if (Auth::check() && Auth::user()->role_id === 2)
                        <a href="/keranjang"><img class="mx-4"src="\asset\cartwhite.png"></a>
                        <img class="mx-3"src="\asset\profilewhite.png" data-bs-toggle="dropdown">
                        <ul class="dropdown-menu mt-2">
                            <li><a class="dropdown-item text-dark hover" href="/profilPage/{{ Auth::user()->id }}">Profil
                                    (Member)</a></li>
                            <li><a class="dropdown-item text-dark hover" href="/riwayatTransaksiMemberPage">Riwayat Transaksi</a></li>
                            <li><a class="dropdown-item text-dark hover" href="/logout">Logout</a></li>
                        </ul>
                    @elseif (Auth::check() && Auth::user()->role_id === 1)
                        <img class="mx-3"src="\asset\profilewhite.png" data-bs-toggle="dropdown">
                        <ul class="dropdown-menu mt-2">
                            <li><a class="dropdown-item text-dark hover" href="">Lihat Semua Akun</a></li>
                            <li><a class="dropdown-item text-dark hover" href="/riwayatTransaksiAdminPage">Riwayat Transaksi</a></li>
                            <li><a class="dropdown-item text-dark hover" href="/logout">Logout</a></li>
                        </ul>
                    @elseif (Auth::check() && Auth::user()->role_id === 3)
                        <img class="mx-3"src="\asset\profilewhite.png" data-bs-toggle="dropdown">
                        <ul class="dropdown-menu mt-2">
                            <li><a class="dropdown-item text-dark hover" href="">Riwayat Transaksi</a></li>
                            <li><a class="dropdown-item text-dark hover" href="/logout">Logout</a></li>
                        </ul>
                    @endif
                </div>
            @endauth
            @guest
                <div class="d-flex align-items-center">
                    <a href="/keranjang"><img class="mx-4"src="\asset\cartwhite.png"></a>
                    <a href="/loginPage"><img class="mx-3"src="\asset\profilewhite.png"></a>
                </div>
            @endguest
        </nav>
    </header>
    @yield('Page-Contents')
    <footer>
        <div class="section-footer bg-footer text-center">
            <div class="text-white"><b>ArtVerse</b></div>
            <div class="fw-bold">
                <a class="text-decoration-none text-white me-3" href="/tentang">Tentang</a>
                <span class="text-white">|</span>
                <a class="text-decoration-none text-white mx-3" href="/kontak">Kontak</a>
                <span class="text-white">|</span>
                <a class="text-decoration-none text-white ms-3" href="/syaratketentuan">Syarat dan Ketentuan</a>
            </div>
            <div class="text-white">&copy; 2023, ArtVerse </div>
        </div>
    </footer>
</body>

</html>
