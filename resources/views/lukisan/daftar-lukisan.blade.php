@extends('Master')

@section('Page-Title')
    Daftar Lukisan - {{ Auth::user()->username }}
@endsection

@section('Page-Contents')
    <div class="mb-5">
        <div class="mt-5 mb-3 d-flex justify-content-center">
            <h3 class=""><b>Daftar Lukisan</b></h3>
        </div>

        <div class="d-flex bg-daftar justify-content-center align-items-start">
            <div class="card-unggah-lukisan bg-white px-5 py-5 mb-5 rounded-3 shadow-lg">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">INFO PRODUK</th>
                            <th scope="col">HARGA</th>
                            <th scope="col">STOK</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lukisans as $lukisan)
                            <tr>
                                <th scope="row">{{ $lukisan->id}}</th>
                                <td><a class="text-decoration-none text-dark" href="/detailLukisanSenimanPage/{{ $lukisan->id }}"><img src="{{ $lukisan->gambar_pertama }}" alt="{{ $lukisan->nama_lukisan }}" width="50" height="50" class="me-3">{{ $lukisan->nama_lukisan }}</a></td>
                                <td class="pt-3">Rp{{ $lukisan->harga }}</td>
                                <td class="pt-3">{{ $lukisan->stok }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
