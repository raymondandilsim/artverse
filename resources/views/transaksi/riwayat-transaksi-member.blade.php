@extends('Master')

@section('Page-Title')
    Riwayat Transaksi
@endsection

@section('Page-Contents')
    <div class="mb-5">
        <div class="mt-5 mb-3 d-flex justify-content-center">
            <h3 class=""><b>Riwayat Transaksi</b></h3>
        </div>
        
        <div class="d-flex bg-detail justify-content-center align-items-start">
            <div class="card-unggah-lukisan bg-white px-5 py-5 mb-5 rounded-3 shadow-lg">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Tanggal Pembelian</th>
                            <th scope="col">Nama Lukisan</th>
                            <th scope="col">Total Pembelian</th>
                            <th scope="col">Status</th>
                            <th scope="col">Detail</th>
                            <th scope="col">Batal</th>
                            <th scope="col">Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $idTransaksiSebelumnya = null;
                        @endphp
                        @foreach ($transaksis as $transaksi)
                            @foreach ($transaksi->detailTransaksis as $detailTransaksi)
                                @if ($detailTransaksi->transaksi_id != $idTransaksiSebelumnya)
                                    <tr>
                                        <td class="pt-3 pb-3" scope="row">{{ $transaksi->id }}</td>
                                        <td class="pt-3 pb-3">{{ $transaksi->tanggal_pembelian }}</td>
                                        @php
                                            $formatHarga = number_format($transaksi->total_pembelian, 0, '.', '.');
                                        @endphp
                                        <td class="pt-3 pb-3">{{ $detailTransaksi->lukisan->nama_lukisan }}</td>
                                        <td class="pt-3 pb-3">Rp{{ $formatHarga }}</td>
                                        <td class="pt-3 pb-3">{{ $transaksi->status }}</td>
                                        <td class="pt-3 pb-3">
                                            <a href="/detailTransaksiPage/{{ $transaksi->id }}">
                                                <button type="button" class="btn btn-primary btn-sm"><i
                                                        class="bi bi-eye"></i></button>
                                            </a>
                                        </td>
                                        <td class="pt-3 pb-3">
                                            @if ($transaksi->status == 'Belum Bayar')
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#batalkanModal{{ $transaksi->id }}"><i
                                                        class="bi bi-x-octagon"></i></button>
                                            @else
                                                <button disabled class="btn btn-danger btn-sm"><i
                                                        class="bi bi-x-circle"></i></button>
                                            @endif

                                            <!-- Modal Delete Confirmation-->
                                            <div class="modal fade" id="batalkanModal{{ $transaksi->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5">Batalkan Pesanan
                                                            </h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body text-start">
                                                            <p>Apakah anda yakin ingin membatalkan pesanan
                                                                {{ $transaksi->id }}
                                                                dari daftar pesanan anda?
                                                            </p>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Tidak Jadi</button>
                                                            <form action="/batalkanPesanan/{{ $transaksi->id }}"
                                                                method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="Submit"
                                                                    class="btn btn-danger">Batalkan</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="pt-3 pb-3">
                                            @if ($transaksi->status == 'Selesai')
                                                <a href="/penilaianPage">
                                                    <button type="button" class="btn btn-warning btn-sm"><i
                                                            class="bi bi-star-fill"></i></button>
                                                </a>
                                            @else
                                                <button disabled class="btn btn-warning btn-sm"><i
                                                        class="bi bi-star-fill"></i></button>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                                @php
                                    $idTransaksiSebelumnya = $detailTransaksi->transaksi_id;
                                @endphp
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
