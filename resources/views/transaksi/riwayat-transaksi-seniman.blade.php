@extends('Master')

@section('Page-Title')
    Riwayat Pesanan
@endsection

@section('Page-Contents')
    <div class="mb-5">
        <div class="mt-5 mb-3 d-flex justify-content-center">
            <h3 class=""><b>Riwayat Pesanan</b></h3>
        </div>

        <div class="d-flex bg-daftar justify-content-center align-items-start">
            <div class="card-unggah-lukisan bg-white px-5 py-5 mb-5 rounded-3 shadow-lg">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Tanggal Pembelian</th>
                            <th scope="col">Total Pembelian</th>
                            <th scope="col">Status</th>
                            <th scope="col">Detail</th>
                            <th scope="col">Batal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksis as $transaksi)
                            <tr>
                                <td class="pt-3 pb-3" scope="row">{{ $transaksi->id }}</td>
                                <td class="pt-3 pb-3">{{ $transaksi->tanggal_pembelian }}</td>
                                @php
                                    $formatHarga = number_format($transaksi->total_pembelian, 0, '.', '.');
                                @endphp
                                <td class="pt-3 pb-3">Rp{{ $formatHarga }}</td>
                                <td class="pt-3 pb-3">{{ $transaksi->status }}</td>
                                <td class="pt-3 pb-3">
                                    <a href="/detailTransaksiPage/{{ $transaksi->id }}">
                                        <button type="button" class="btn btn-primary btn-sm"><i class="bi bi-eye"></i></button>
                                    </a>
                                </td>
                                <td class="pt-3 pb-3">
                                    @if ($transaksi->status == 'Belum Bayar')
                                        <form action="/batalkanPesanan/{{ $transaksi->id  }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-danger btn-sm"><i
                                                    class="bi bi-x-octagon"></i></button>
                                        </form>
                                    @else
                                        <button disabled class="btn btn-danger btn-sm"><i
                                                class="bi bi-x-circle"></i></button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
