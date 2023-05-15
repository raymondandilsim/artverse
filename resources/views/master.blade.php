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
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
</head>

<body>

    {{-- success --}}
    @if(Session::has('status'))
        <div class="alert alert-success alert-dismissible fade show fixed-top m-5" role="alert">
            {{Session::get('status')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- error handling --}}
    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show fixed-top m-5" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li class="p-2">{{$error}}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <header class="bg-header">
        <nav class="d-flex justify-content-around py-4">
            <div class="align-items-center justify-content-center">
                <a href="/"><img src="\asset\logoArtverse.png"></a>
            </div>
            <div class="d-flex align-items-center ">
                <div class="search">
                    <i class="ms-4 bi-search"></i>
                    <input class="ps-3 border-0 form-control" type="search" id="search" placeholder="Mencari...">
                </div>
            </div>
            @auth
                <div class="d-flex align-items-center">
                    @if (Auth::check() && Auth::user()->role_id === 2)
                        <a href=""><img class="mx-4"src="\asset\cartwhite.png"></a>
                        <img class="mx-3"src="\asset\profilewhite.png" data-bs-toggle="dropdown">
                        <ul class="dropdown-menu bg-dropdown">
                            <li><a class="dropdown-item text-white hover" href="/profilPage/{{ Auth::user()->id }}">Profil</a></li>
                            <li><a class="dropdown-item text-white hover" href="">Riwayat Transaksi</a></li>
                            <li><a class="dropdown-item text-white hover" href="/logout">Logout</a></li>
                        </ul>
                    @elseif (Auth::check() && Auth::user()->role_id === 1)
                        <a href=""><img class="mx-4"src="\asset\cartwhite.png"></a>
                        <img class="mx-3"src="\asset\profilewhite.png" data-bs-toggle="dropdown">
                        <ul class="dropdown-menu bg-dropdown">
                            <li><a class="dropdown-item text-white hover" href="">Lihat Semua Akun</a></li>
                            <li><a class="dropdown-item text-white hover" href="">Riwayat Transaksi</a></li>
                            <li><a class="dropdown-item text-white hover" href="/logout">Logout</a></li>
                        </ul>
                    @elseif (Auth::check() && Auth::user()->role_id === 3)
                        <a href=""><img class="mx-4"src="\asset\cartwhite.png"></a>
                        <img class="mx-3"src="\asset\profilewhite.png" data-bs-toggle="dropdown">
                        <ul class="dropdown-menu bg-dropdown">
                            <li><a class="dropdown-item text-white hover" href="/profilPage/{{ Auth::user()->id }}">Profil</a></li>
                            <li><a class="dropdown-item text-white hover" href="">Riwayat Transaksi</a></li>
                            <li><a class="dropdown-item text-white hover" href="/logout">Logout</a></li>
                        </ul>
                    @endif
                </div>
            @endauth
            @guest
                <div class="d-flex align-items-center">
                    <a href="/loginPage"><img class="mx-4"src="\asset\cartwhite.png"></a>
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
                <a class="text-decoration-none text-white mx-3" href="">Kontak</a>
                <span class="text-white">|</span>
                <a class="text-decoration-none text-white ms-3" href="">Syarat dan Ketentuan</a>
            </div>
            <div class="text-white">&copy;2023, ArtVerse </div>
        </div>
    </footer>
</body>

</html>
