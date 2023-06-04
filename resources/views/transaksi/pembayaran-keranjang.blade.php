@extends('Master')

@section('Page-Title')
    Pembayaran
@endsection

@section('Page-Contents')
    <div class="container mt-5 mb-5 pb-5" style="height: fluid; overflow-y: auto;">
        <div class="row mb-5 pb-5">
            <div class="col-7 align-items-start">
                <div class="card pt-2 pb-5 ps-4 pe-4">
                    <h3 class="mt-2 mb-3 pb-2 border-dark border-bottom border-3">Rincian Pembayaran</h3>
                    @foreach ($itemKeranjang as $item)
                        <div class="mt-1">
                            <div class="d-flex justify-content-between">
                                <label for="subtotal">{{ $item->lukisan->nama_lukisan }} (x{{ $item->kuantitas }})</label>
                                @php
                                    $formatHarga = number_format($item->subtotal_produk, 0, '.', '.');
                                @endphp
                                <label for="hargaSubtotal">Rp{{ $formatHarga }}</label>
                            </div>
                            <div class="d-flex justify-content-between mt-2">
                                <label for="asuransi">Biaya Asuransi</label>
                                @php
                                    $formatHarga = number_format($hargaAsuransi[$item->id], 0, '.', '.');
                                @endphp
                                <label for="hargaAsuransi">Rp{{ $formatHarga }}</label>
                            </div>
                            <hr>
                        </div>
                        @endforeach
                        <div class="d-flex justify-content-between mt-2">
                            <label for="subtotalProduk">Subtotal Produk</label>
                            @php
                                $formatHarga = number_format($subtotalProduk, 0, '.', '.');
                            @endphp
                            <label for="subtotalProduk" id="subtotalProduk">Rp{{ $formatHarga }} </label>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <label for="ongkosKirim">Subtotal Pengiriman  ({{ $berat }}g)</label>
                            @php
                                $formatHarga = number_format($subtotalPengiriman, 0, '.', '.');
                            @endphp
                            <label for="hargaOngkosKirim" id="hargaOngkosKirim">Rp{{ $formatHarga }} </label>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <label for="ongkosKirim">Biaya Penanganan Asuransi</label>
                            @php
                                $formatHarga = number_format(5000, 0, '.', '.');
                            @endphp
                            <label for="biayaPenangananAsuransi" id="biayaPenangananAsuransi">Rp{{ $formatHarga }} </label>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <label for="ongkosKirim">Subtotal Asuransi</label>
                            @php
                                $formatHarga = number_format($subtotalAsuransi, 0, '.', '.');
                            @endphp
                            <label for="totalAsuransi" id="totalAsuransi">Rp{{ $formatHarga }} </label>
                        </div>
                        <div class="d-flex justify-content-between mt-2 fw-bold">
                            <label for="ongkosKirim">Total Pembayaran</label>
                            @php
                                $formatHarga = number_format($totalPembayaran, 0, '.', '.');
                            @endphp
                            <label for="totalPembayaran" class="text-danger">Rp{{ $formatHarga }} </label>
                        </div>
                </div>
            </div>
            <div class="col-5 card">
                <div class="card-body">
                    <div class="mb-5">
                        <div class="row fw-bold mb-3">
                            <label for="pembayaran" class="col-sm-10 col-form-label">Metode Pembayaran</label>
                        </div>
                        <div class="row fw-bold mt-2">
                            <label for="OVO" class="col-sm-3">OVO</label>
                            <label for="nomorOvo" class="col-sm-4 ">0822325456</label>
                        </div>
                        <div class="row fw-bold mt-2">
                            <label for="GOPAY" class="col-sm-3">GOPAY</label>
                            <label for="nomorGopay" class="col-sm-4 ">0822325456</label>
                        </div>
                        <div class="row fw-bold mt-2">
                            <label for="BCA" class="col-sm-3">BCA</label>
                            <label for="nomorBca" class="col-sm-4 ">805162303</label>
                        </div>
                    </div>
                    <div class="mt-4 fw-bold">
                        <label for="" class="form-label text-danger peringatan"><label class="text-danger">*</label>
                            Pastikan nama pengirim dana sesuai dengan nama akun anda, agar transaksi lebih cepat
                            diproses.</label>
                        <label for="" class="form-label text-danger peringatan"><label class="text-danger">*</label>
                            Jangan lupa unggah bukti pembayaran di halaman detail transaksi ini agar transaksi bisa diproses
                            lebih lanjut.</label>
                        <label for="" class="form-label text-danger peringatan"><label class="text-danger">*</label>
                            Sistem berhak membatalkan pesanan jika bukti pembayaran tidak diunggah dalam jangka waktu 24
                            jam.</label>
                        <label for="" class="form-label text-danger peringatan"><label class="text-danger">*</label>
                            Untuk mengakses halaman detail transaksi, anda dapat pergi ke halaman riwayat transaksi terlebih
                            dahulu.</label>

                        <a href="/riwayatTransaksiMemberPage">
                            <input class="btn btn-dark form-control mt-4" type="submit" value="Ke Riwayat Transaksi">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
