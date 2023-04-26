@extends('Master')

@section('Page-Contents')
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
                        <input class="form-control" type="password" id="katasandi" name="katasandi">
                    </div>
                    <input class="btn-masuk text-white form-control mt-5" type="submit" value="Masuk">
                    <h6>Belum mempunyai akun? <a class="text-decoration-none" href="/daftar">Daftar</a></h6>
                </div>
            </form>
        </div>
    </div>
@endsection
