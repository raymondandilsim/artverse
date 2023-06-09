@extends('Master')

@section('Page-Title')
    Profil - {{ $user->username }}
@endsection

@section('Page-Contents')
    <div class="container-xl mt-5 mb-5 ms-5 pe-5">
        <div class="row justify-content-start ms-5 container-xl">
            <div class="col-md-3 mb-5">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 mt-4">
                                <img src="{{ $user->foto_profil }}" alt="Profile Picture" class="img-fluid rounded" width="500" height="500">
                            </div>

                            <div class="col-md-8 mt-4">
                                <h3>{{ $user->nama }}</h3>
                            </div>
                        </div>
                        <form action="/ubahPeran/{{ $user->id }}" method="POST">
                            @csrf
                            <input class="btn btn-dark form-control mt-4" type="submit" value="Jadi Penjual">
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8 mb-5 ms-5 pb-5">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{ $user->foto_profil }}" alt="Profile Picture" class="img-fluid rounded" width="500" height="500">
                            </div>

                            <div class="col-md-8">

                                <h3 class="col-sm-5">Biodata Diri</h3>

                                <div class="mb-1 row">
                                    <label class="col-sm-4 col-form-label fs-5">Nama</label>
                                    <label class="col-sm-8 col-form-label fs-5">{{ $user->nama }}</label> <br>
                                </div>
                                <div class="mb-1 row">
                                    <label class="col-sm-4 col-form-label fs-5">Nama Pengguna</label>
                                    <label class="col-sm-8 col-form-label fs-5">{{ $user->username }}</label> <br>
                                </div>
                                <div class="mb-1 row">
                                    <label class="col-sm-4 col-form-label fs-5">Alamat</label>
                                    <label class="col-sm-8 col-form-label fs-5">{{ $user->nama_jalan }}, {{ $user->kota->nama_kota }}, {{ $user->provinsi->provinsi }}, {{ $user->kode_pos }}</label> <br>
                                </div>
                                <br>
                                <h3>Kontak</h3>
                                <div class="mb-1 row">
                                    <label class="col-sm-4 col-form-label fs-5">Email</label>
                                    <label class="col-sm-8 col-form-label fs-5">{{ $user->email }}</label> <br>
                                </div>
                                <div class="mb-1 row">
                                    <label class="col-sm-4 col-form-label fs-5">Nomor HP</label>
                                    <label class="col-sm-8 col-form-label fs-5">{{ $user->nomor_telepon }}</label> <br>
                                </div>
                                <div class="mb-1 row">
                                    <label class="col-sm-4 col-form-label fs-5">Nomor Rekening</label>
                                    <label class="col-sm-8 col-form-label fs-5">{{ $user->nomor_rekening }} ({{ $user->nama_bank }})</label> <br>
                                </div>

                                <form class="col-sm-5 mt-5" action="/ubahProfilPage/{{ $user->id }}" method="GET">
                                    <button class="btn btn-dark" type="submit" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">Ubah Profil</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
