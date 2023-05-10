<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ArtVerse - Unggah Lukisan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
</head>
<body>

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

    @extends('Master')

    @section('Page-Contents')
    <div class="d-flex flex-column mb-3">
        <div class="mt-5 d-flex justify-content-center">
            <h3 class=""><b>Tambah Lukisan</b></h3>
        </div>
        
        <div class="d-flex bg-daftar justify-content-center align-items-center p-2">
            <div class="card-unggah-lukisan bg-white px-5 py-5 rounded-3 shadow">
                <h5 class="text-start mb-4"><b>Informasi Produk</b></h5>
                <form action="/daftar" method="POST">
                    @csrf
                    <div>
                        <div class="mb-3 row">
                            <label for="namaLukisan" class="col-sm-2 col-form-label">Nama Lukisan</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" id="namaLukisan" name="namaLukisan">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="hargaLukisan" class="col-sm-2 col-form-label">Harga</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" id="hargaLukisan" name="hargaLukisan">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="deskripsiLukisan" class="col-sm-2 col-form-label">Deskripsi</label>
                            <div class="col-sm-10">
                                {{-- <input class="form-control" type="text" id="deskripsiLukisan" name="deskripsiLukisan">
                                 --}}
                                <textarea name="deskripsiLukisan" id="deskripsiLukisan" cols="133" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="stokLukisan" class="col-sm-2 col-form-label">Stok</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="number" id="stokLukisan" name="stokLukisan">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="gambarLukisan" class="form-label">Gambar Lukisan</label>
                            <input class="form-control" type="file" id="gambarLukisan">
                        </div>
                        <input class="btn-daftar text-white form-control mt-5" type="submit" value="Unggah">
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection

</body>
</html>