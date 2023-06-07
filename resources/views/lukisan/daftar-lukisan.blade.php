@extends('Master')

@section('Page-Title')
    Daftar Lukisan - {{ Auth::user()->username }}
@endsection

@section('Page-Contents')
    <div class="mb-5 pb-5">
        <div class="mt-5 mb-3 d-flex justify-content-center">
            <h3 class=""><b>Daftar Lukisan</b></h3>
        </div>

        <div class="d-flex bg-daftar justify-content-center align-items-start">
            <div class="card-unggah-lukisan bg-white px-5 py-5 mb-5 rounded-3 shadow-lg">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nama Lukisan</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lukisans as $lukisan)
                            <tr>
                                <th scope="row" class="pt-3">{{ $lukisan->id }}</th>
                                <td><a class="text-decoration-none text-dark"
                                        href="/detailLukisanSenimanPage/{{ $lukisan->id }}">
                                        <img src="{{ $lukisan->gambar_pertama }}" alt="{{ $lukisan->nama_lukisan }}"
                                            width="50" height="50"
                                            class="me-3 rounded">{{ $lukisan->nama_lukisan }}</a></td>
                                @php
                                    $formatHarga = number_format($lukisan->harga, 0, '.', '.');
                                @endphp
                                <td class="pt-3">Rp{{ $formatHarga }}</td>
                                <td class="pt-3">{{ $lukisan->stok }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="d-flex justify-content-center mb-5">
            {{ $lukisans->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
