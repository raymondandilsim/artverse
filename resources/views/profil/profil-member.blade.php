@extends('Master')

@section('Page-Title')
    Profil - {{ $user->username }}
@endsection

@section('Page-Contents')
    {{-- <img class="mx-3"src="{{ $user->foto_profil }}" data-bs-toggle="dropdown">    --}}
    <div class="container-fluid mt-5 mb-5 ms-5">
        <div class="row justify-content-start">
            <div class="col-md-3 mb-5">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{ $user->foto_profil }}" alt="Profile Picture" class="img-fluid" width="500" height="500">
                            </div>

                            <div class="col-md-8 mt-4">
                                <h4>{{ $user->nama }}</h4>
                                <p><a href=""></a></p>
                            </div>
                        </div>
                        <form action="/ubahPeran" method="">
                            <input class="btn-masuk text-white form-control mt-4" type="submit" value="Jadi Penjual">
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8 mb-5">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{ $user->foto_profil }}" alt="Profile Picture" class="img-fluid" width="500" height="500">
                            </div>

                            <div class="col-md-8">

                                <div class="mb-1 row">
                                    <h3 class="col-sm-4">Biodata Diri</h3>
                                    <form class="col-sm-2" action="" method="">
                                        <button class="btn btn-dark btn-sm" type="submit">Ubah Profil</button>
                                    </form>
                                </div>
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
                                    <label class="col-sm-8 col-form-label fs-5">{{ $user->nama_kota }}, {{ $user->nama_provinsi }}</label> <br>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
