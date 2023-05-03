<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ArtVerse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
</head>
a
<body>
    <header class="bg-header">
        <nav class="d-flex justify-content-around py-4">
            <div class="align-items-center justify-content-center">
                <a href="/"><img src="\asset\logoArtverse.png" alt=""></a>
            </div>
            <div class="d-flex align-items-center ">
                    <div class="search">
                        <i class="ms-4 bi-search"></i>
                        <input class="ps-3 border-0 form-control" type="search" id="search" placeholder="Mencari...">
                    </div>
            </div>
            <div class="d-flex align-items-center">
                <a href=""><img class="mx-4"src="\asset\cartwhite.png" alt=""></a>
                <a href="/loginPage"><img class="mx-3"src="\asset\profilewhite.png" alt=""></a>
            </div>
        </nav>
    </header>
    @yield('Page-Contents')
    <footer>
        <div class="section-footer bg-footer text-center">
            <div class="text-white"><b>ArtVerse</b></div>
            <div class="fw-bold">
                <a class="text-decoration-none text-white me-3" href="">Tentang</a>
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
