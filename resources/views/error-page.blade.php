@extends('master')

@section('Page-Title')
    Error
@endsection

@section('Page-Contents')
    <div class="p-5 d-flex align-items-center justify-content-center" style="height: 515px;">
        <div class="p-5 text-center">
            <img src="{{ url('asset/error.png') }}" class="logo-error mb-3">
            <h4 class="mt-4">Mohon maaf halaman tidak dapat diakses dengan peran anda</h4>
            <h4>Silahkan kembali ke halaman sebelumnya</h4>
        </div>
    </div>
@endsection
