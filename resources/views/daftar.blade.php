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
    <div class="d-flex bg-daftar bg-secondary justify-content-center align-items-center p-5">
        <div class="card-daftar bg-white px-5 py-5 rounded-3 shadow">
            <h2 class="text-center"><b>DAFTAR</b></h2>
            <form action="/daftar" method="POST">
                @csrf
                <div>
                    <div>
                        <label for="Nama" class="form-label">Nama</label>
                    </div>
                    <div>
                        <input class="form-control" type="text" id="nama" name="nama">
                    </div>
                    <div>
                        <label for="Username" class="form-label">Username</label>
                    </div>
                    <div>
                        <input class="form-control" type="text" id="username" name="username">
                    </div>
                    <div>
                        <label for="Email" class="form-label">Email</label>
                    </div>
                    <div>
                        <input class="form-control" type="Email" id="email" name="email">
                    </div>
                    <div>
                        <label for="Nomor Telepon" class="form-label">Nomor Telepon</label>
                    </div>
                    <div>
                        <input class="form-control" type="text" id="nomor_telepon" name="nomor_telepon">
                    </div>
                    <div>
                        <label for="Nama Provinsi" class="form-label">Nama Provinsi</label>
                    </div>
                    <div>
                        <input class="form-control" type="text" id="nama_provinsi" name="nama_provinsi">
                    </div>
                    <div>
                        <label for="Nama Kota" class="form-label">Nama Kota</label>
                    </div>
                    <div>
                        <input class="form-control" type="text" id="nama_kota" name="nama_kota">
                    </div>
                    <div>
                        <label for="Kata Sandi" class="form-label">Kata Sandi</label>
                    </div>
                    <div>
                        <input class="form-control" type="password" id="password" name="password">
                    </div>
                    <div>
                        <label for="Masukkan Sandi Ulang" class="form-label">Masukkan Sandi Ulang</label>
                    </div>
                    <div>
                        <input class="form-control" type="password" id="confirm_password" name="confirm_password">
                    </div>
                    @if ($errors->any())
                        {{-- <tr>
                            <td colspan="2" class="px-5 py-2"> --}}
                        <div class="alert alert-danger alert-dismissible fade show fixed-top m-5" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                            {{-- </td>
                        </tr> --}}
                    @endif
                    <input class="btn-daftar text-white form-control mt-5" type="submit" value="Daftar">
                    <h6>Sudah punya akun? <a class="text-decoration-none" href="/loginPage">Masuk</a></h6>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
