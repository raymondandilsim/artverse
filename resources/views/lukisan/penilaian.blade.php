@extends('Master')

@section('Page-Title')
    Penilaian
@endsection

@section('Page-Contents')
    <div class="mb-5 pb-5">
        <div class="mt-5 mb-5 d-flex justify-content-center">
            <h3 class=""><b>Beri Penilaian untuk Pesanan Anda</b></h3>
        </div>

        <div class="d-flex bg-detail justify-content-center align-items-start">
            <div class="card-unggah-lukisan bg-white px-5 py-5 mb-5 rounded-3 shadow-lg">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">No. Pesanan</th>
                            <th scope="col">Nama Lukisan</th>
                            <th scope="col">Tanggal Pembelian</th>
                            <th scope="col">Status</th>
                            <th scope="col">Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksi as $item)
                                <tr>
                                    <td class="pt-3 pb-3" scope="row">{{ $item->transaksi_id }}</td>
                                    <td class="pt-3 pb-3">
                                        <a class="text-decoration-none text-dark" href="/detailLukisanMemberPage/{{ $item->lukisan_id }}">
                                        <img src="{{ $item->gambar_pertama }}" alt="{{ $item->nama_lukisan }}" width="50" height="50"
                                            class="me-3 rounded">{{ $item->nama_lukisan }}</a>    
                                    </td>
                                    <td class="pt-4 pb-3">{{ $item->tanggal_pembelian }}</td>
                                    <td class="pt-4 pb-3">{{ $item->status }}</td>
                                    <td class="pt-4 pb-3">
                                        <a href="/ulasanPage/{{ $item->lukisan_id }}/{{ $item->transaksi_id }}">
                                            <button type="button" class="btn btn-warning btn-sm"><i class="bi bi-star-fill"></i></button>
                                        </a>
                                    </td>
                                </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="d-flex justify-content-center mb-5">
            {{ $transaksi->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
