@extends('master')

@section('Page-Title')
    Error
@endsection

@section('Page-Contents')
    <div class="my-5 text-center">
        <img src="{{ url('asset/error.png') }}" class="p-2 logo-error ">
        <h4 class="mt-4">Mohon maaf halaman tidak dapat diakses </h4>
        <h4>Silahkan kembali ke halaman utama</h4>
    </div>
@endsection
