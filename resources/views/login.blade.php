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
    <div class="d-flex bg-login bg-secondary justify-content-center align-items-center">
        <div class="card-login bg-white px-5 py-5 rounded-3 shadow">
            <h2 class="text-center"><b>MASUK</b></h2>
            <form action="/login" method="POST">
                @csrf
                <div>
                    <div>
                        <label for="Nama" class="form-label">Nama</label>
                    </div>
                    <div>
                        <input class="form-control" type="text" id="nama" name="nama">
                    </div>
                    <div>
                        <label for="Kata Sandi" class="form-label">Kata Sandi</label>
                    </div>
                    <div>
                        <input class="form-control" type="password" id="password" name="password">
                    </div>
                    @if ($errors->any())
                        <tr>
                            <td colspan="2" class="px-5 py-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                </ul>
                            </td>
                        </tr>
                    @endif
                    <input class="btn-masuk text-white form-control mt-5" type="submit" value="Masuk">
                    <h6>Belum mempunyai akun? <a class="text-decoration-none" href="/daftarPage">Daftar</a></h6>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
