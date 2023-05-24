@extends('Master')

@section('Page-Title')
    Seniman - {{ $user->username }}
@endsection

@section('Page-Contents')
        <div class="row p-5">
            <div class="col-md-4">
                <img src="{{ $user->foto_profil }}" alt="Profile Picture" class="img-fluid" width="400" height="500">
            </div>
            <div class="col-md-8 p-5">
                <h3 class="col pt-5 pb-4">Biodata Diri</h3>
                <div class="mb-1 row">
                    <label class="col-sm-4 col-form-label fs-5">Nama Pengguna</label>
                    <label class="col-sm-8 col-form-label fs-5">{{ $user->username }}</label> <br>
                </div>
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
@endsection
