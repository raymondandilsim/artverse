@extends('Master')

@section('Page-Title')
    Pembayaran
@endsection

@section('Page-Contents')
    <div class="container mt-5 mb-5" style="height: 1000px; overflow-y: auto;">
        <div class="row">
            <div class="col-6 align-items-start">
                <div class="card pt-2 pb-5 ps-4 pe-4">
                    <div class="mt-3">
                        <div class="d-flex justify-content-between">
                            <label for="subtotal">Subtotal untuk Produk</label>
                            @php
                                $formatHarga = number_format($subtotalProduk, 0, '.', '.');
                            @endphp
                            <label for="hargaSubtotal">Rp{{ $formatHarga }}</label>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <label for="ongkosKirim">Subtotal Pengiriman</label>
                            @php
                                $formatHarga = number_format($subtotalPengiriman, 0, '.', '.');
                            @endphp
                            <label for="hargaOngkosKirim" id="hargaOngkosKirim">Rp{{ $formatHarga }}</label>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <label for="asuransi">Asuransi</label>
                            @php
                                $formatHarga = number_format($subtotalAsuransi, 0, '.', '.');
                            @endphp
                            <label for="hargaAsuransi">Rp{{ $formatHarga }}</label>
                        </div>
                        <div class="d-flex justify-content-between mt-2 fw-bold">
                            <label for="totalPembayaran">Total Pembayaran</label>
                            @php
                                $formatHarga = number_format($totalPembayaran, 0, '.', '.');
                            @endphp
                            <label for="hargaTotalPembayaran" class="text-danger">Rp{{ $formatHarga }}</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 card">
                <div class="card-body">
                    <div class="mb-5">
                        <div class="row fw-bold mb-3">
                            <label for="pembayaran" class="col-sm-10 col-form-label">Metode Pembayaran</label>
                        </div>
                        <div class="row fw-bold mt-2">
                            <label for="OVO" class="col-sm-3">OVO</label>
                            <label for="nomorOvo" class="col-sm-8 ">0822325456 (a.n. Artverse)</label>
                        </div>
                        <div class="row fw-bold mt-2">
                            <label for="GOPAY" class="col-sm-3">GOPAY</label>
                            <label for="nomorGopay" class="col-sm-8 ">0822325456 (a.n. Artverse)</label>
                        </div>
                        <div class="row fw-bold mt-2">
                            <label for="BCA" class="col-sm-3">BCA</label>
                            <label for="nomorBca" class="col-sm-8 ">805162303 (a.n. Artverse)</label>
                        </div>
                    </div>
                    <div class="mt-4 fw-bold">
                        <label for="" class="form-label text-danger"><label class="text-danger">*</label>
                            Pastikan nama pengirim dana sesuai dengan nama akun anda, agar transaksi lebih cepat diproses.</label>
                        <label for="" class="form-label text-danger"><label class="text-danger">*</label>
                            Jangan lupa unggah bukti pembayaran di halaman detail transaksi ini agar transaksi bisa diproses lebih lanjut.</label>
                        <label for="" class="form-label text-danger"><label class="text-danger">*</label>
                            Untuk mengakses halaman detail transaksi, anda dapat pergi ke halaman riwayat transaksi terlebih dahulu.</label>
                        <label for="" class="form-label text-danger"><label class="text-danger">*</label>
                            Sistem berhak membatalkan pesanan jika bukti pembayaran tidak diunggah dalam jangka waktu 24 jam.</label>
                        
                        <a href="/riwayatTransaksiMemberPage">
                            <input class="btn btn-dark form-control mt-4" type="submit" value="Ke Riwayat Transaksi">
                        </a>
                                

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
