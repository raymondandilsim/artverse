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

<body>
    <header class="bg-header">
        <nav class="d-flex justify-content-between py-4">
            <div class="align-items-center justify-content-center">
                <a href="/"><img src="\asset\logoArtverse.png" alt=""></a>
            </div>
            <div class="d-flex align-items-center">
                <form action="" method="GET">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-search" viewBox="0 0 16 16">
                            <path
                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                        </svg>
                        <input class="search  bi-search ps-5" type="search" id="search"
                            placeholder="Mencari...">
                    </div>
                </form>
            </div>
            <div class="d-flex align-items-center">
                <a href=""><img class="mx-4"src="\asset\cartwhite.png" alt=""></a>
                <a href="/login"><img class="mx-3"src="\asset\profilewhite.png" alt=""></a>
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
