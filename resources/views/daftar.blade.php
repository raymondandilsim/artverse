@extends('Master')

@section('Page-Contents')
    <div class="d-flex bg-daftar bg-secondary justify-content-center align-items-center">
        <div class="card-daftar bg-white px-5 py-5 rounded-3 shadow">
            <h2 class="text-center"><b>DAFTAR</b></h2>
            <form action="/Daftar" method="POST">
                @csrf
                <div>
                    <div>
                        <label for="Nama" class="form-label">Nama</label>
                    </div>
                    <div>
                        <input class="form-control" type="text" id="nama" name="nama">
                    </div>
                    <div>
                        <label for="Email" class="form-label">Email</label>
                    </div>
                    <div>
                        <input class="form-control" type="Email" id="email" name="email">
                    </div>
                    <div>
                        <label for="Kata Sandi" class="form-label">Kata Sandi</label>
                    </div>
                    <div>
                        <input class="form-control" type="password" id="katasandi" name="katasandi">
                    </div>
                    <div>
                        <label for="Masukkan Sandi Ulang" class="form-label">Masukkan Sandi Ulang</label>
                    </div>
                    <div>
                        <input class="form-control" type="password" id="masukkansandiulang" name="masukkansandiulang">
                    </div>
                    <input class="btn-daftar text-white form-control mt-5" type="submit" value="Daftar">
                    <h6>Sudah punya akun? <a class="text-decoration-none" href="/login">Masuk</a></h6>
                </div>
            </form>
        </div>
    </div>
@endsection
