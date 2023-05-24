@extends('master')

@section('Page-Title')
    Error
@endsection

@section('Page-Contents')
    <div class="p-5 d-flex align-items-center justify-content-center">
        <div class="p-5 text-center">
            <img src="{{ url('asset/error.png') }}" class="logo-error mb-3">
            <h4 class="mt-4">Mohon maaf halaman tidak dapat diakses </h4>
            <h4>Silahkan kembali ke halaman utama</h4>
        </div>
    </div>
@endsection
