@extends('Master')

@section('Page-Title')
    Detail Transaksi - {{ $transaksi->id }}
@endsection

{{-- @foreach ($detailTransaksis as $item)
    Lukisan ID: {{ $item->lukisan_id }} <br>
    Harga Transaksi: {{ $item->harga_total }} <br>
    Transaksi Detail ID: {{ $item->id }}<br>
    Transaksi ID: {{ $item->transaksi_id }}<br>
@endforeach --}}
@section('Page-Contents')
    <div class="container mt-5 mb-5" style="height: fluid; overflow-y: auto;">
        <div class="row">
            <div class="col-8 align-items-start">
                <div class="card bg-warning text-center pt-2">
                    <h3>{{ $transaksi->status }}</h3>
                </div>
                <div class="card pb-5 ps-4 pe-4">
                    <h2 class="mt-5 fw-bold">Detail Transaksi</h2>

                    <div class="mt-3 pb-3 border-bottom border-dark">
                        <h6 class="mt-4 pb-3 border-bottom border-dark fw-bold">Alamat Pengiriman</h6>
                        <h6 class="fw-bold">{{ auth()->user()->nama }}</h6>
                        <label>{{ auth()->user()->nomor_telepon }}</label> <br>
                        <label class="">{{ auth()->user()->nama_jalan }}, {{ auth()->user()->nama_kota }},
                            {{ auth()->user()->nama_provinsi }}, {{ auth()->user()->kode_pos }}
                        </label><br><br>
                        <label for="">Jasa Pengiriman: JNE</label>
                    </div>
                    <div class="mt-4 pb-3 border-bottom">
                        @php
                            $usernamePenjualPertama = null;
                            $kotaPenjualPertama = null;
                            $totalSemua = null;
                        @endphp
                        @foreach ($detailTransaksis as $item)
                            @if ($item->username === $usernamePenjualPertama || $item->nama_kota === $kotaPenjualPertama)
                            @else
                                @php
                                    $usernamePenjualPertama = $item->username;
                                @endphp
                                <h6 class="penjual">{{ $item->username }} (Penjual)</h6>
                                <label class="fw-light">{{ $item->nama_kota }}</label> <br>
                            @endif
                            <div class="row mt-3">
                                <div class="col-1">
                                    <img src="{{ $item->gambar_pertama }}" class="rounded" alt="{{ $item->nama_lukisan }}"
                                        width="80" height="80">
                                </div>
                                <div class="col col-8 ms-4">
                                    <h6 class="fw-bold">{{ $item->nama_lukisan }}</h6>
                                    <h6 class="">Rp{{ $item->harga }} x {{ $item->kuantitas }}</h6>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center ">
                                <div class="col-auto text-danger">
                                    <label for="catatan" class="col-form-label">Catatan:</label>
                                    <label for="catatan" class="col-form-label">{{ $item->catatan }}</label>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <label for="subtotal">Subtotal untuk Produk</label>
                                @php
                                    $formatHarga = number_format($item->subtotal_produk, 0, '.', '.');
                                @endphp
                                <label for="hargaSubtotal">Rp{{ $formatHarga }}</label>
                            </div>
                            <div class="d-flex justify-content-between mt-2">
                                <label for="ongkosKirim">Subtotal Pengiriman</label>
                                @php
                                    $formatHarga = number_format($item->subtotal_pengiriman, 0, '.', '.');
                                @endphp
                                <label for="hargaOngkosKirim" id="hargaOngkosKirim">Rp{{ $formatHarga }}</label>
                            </div>
                            <div class="d-flex justify-content-between mt-2">
                                <label for="asuransi">Asuransi</label>
                                @php
                                    $formatHarga = number_format($item->subtotal_asuransi, 0, '.', '.');
                                @endphp
                                <label for="hargaAsuransi">Rp{{ $formatHarga }}</label>
                            </div>
                            <div class="d-flex justify-content-between mt-2 mb-5 pb-3 border-bottom border-dark fw-bold">
                                <label for="totalPembayaran">Total Pesanan</label>
                                @php
                                    $totalSemua = $totalSemua + $item->harga_total;
                                    $formatHarga = number_format($item->harga_total, 0, '.', '.');
                                @endphp
                                <label for="hargaTotalPesanan" class="text-danger">Rp{{ $formatHarga }}</label>
                            </div>
                        @endforeach
                        <div class="d-flex justify-content-between mt-2 mb-5 pb-3 border-bottom border-dark fw-bold">
                            <label for="totalPembayaran">Jumlah Harus Dibayar</label>
                            @php
                                $formatHarga = number_format($totalSemua, 0, '.', '.');
                            @endphp
                            <label for="hargaTotalPembayaran" class="text-danger">Rp{{ $formatHarga }}</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4 card">
                <div class="card-body">
                    <div class="mb-2">
                        <div class="row fw-bold">
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
                    <div class="mt-3 fw-bold">
                        <label for="buktiPembayaran" class="form-label text-danger peringatan"><label
                                class="text-danger">*</label>Pastikan nama pengirim dana sesuai dengan nama akun anda, agar
                            transaksi lebih cepat diproses.</label>
                        <label for="buktiPembayaran" class="form-label text-danger peringatan"><label
                                class="text-danger">*</label>Jangan lupa unggah bukti pembayaran di halaman detail
                            transaksi ini agar transaksi bisa diproses lebih lanjut.</label>
                    </div>

                    {{-- Bukti Pembayaran --}}
                    <div class="mt-4 align-items-end">
                        @if ($user->role_id == 1)
                            <form action="" method="POST">
                                <div class="d-flex flex-row justify-content-between mb-2">
                                    <label for="buktiPembayaran" class="col-5 form-label fw-bold">Bukti Pembayaran</label>
                                    <button type="submit" class="col-3 btn btn-success btn-sm">Approve</button>
                                </div>
                            </form>
                        @else
                            <label for="buktiPembayaran" class="form-label fw-bold">Bukti Pembayaran</label> <br>
                        @endif

                        @if ($transaksi->bukti_pembayaran == null)
                        @else
                            <img src="{{ $transaksi->bukti_pembayaran }}" alt="" height="100" width="100">
                        @endif
                        @if ($user->role_id == 2)
                            <input type="file" class="form-control form-control-sm mt-3" name="buktiPembayaran"
                                id="buktiPembayaran">
                            <form action="" method="POST">
                                <button type="submit" class="col-12 btn btn-dark btn-sm mt-3 mb-5">Unggah</button>
                            </form>
                        @else
                            <label for="">Pembeli belum mengunggah bukti pembayaran.</label>
                        @endif
                        
                    </div>

                    {{-- Bukti Pengiriman --}}
                    <div class="mt-4 align-items-end">
                        <label for="buktiPembayaran" class="form-label fw-bold">Bukti Pengiriman</label> <br>
                        @if ($transaksi->bukti_pembayaran == null)
                        @else
                            <img src="{{ $transaksi->bukti_pembayaran }}" alt="" height="100" width="100">
                        @endif
                        @if ($user->role_id == 3)
                            <input type="file" class="form-control form-control-sm mt-3" name="buktiPengiriman"
                                id="buktiPengiriman">
                            <form action="" method="POST">
                                <button type="submit" class="col-12 btn btn-dark btn-sm mt-3 mb-5">Unggah</button>
                            </form>
                        @else
                            <label for="">Penjual belum mengunggah bukti pengiriman/resi.</label>
                        @endif
                    </div>

                    {{-- Tampilan jika role user adalah Admin / Seniman --}}
                    @if ($user->role_id != 2)
                        <div class="mt-4 align-items-end">
                            <label for="buktiPembayaran" class="form-label fw-bold">Bukti Pelepasan Dana</label> <br>
                            @if ($transaksi->bukti_pembayaran == null)
                            @else
                                <img src="{{ $transaksi->bukti_pembayaran }}" alt="" height="100"
                                    width="100">
                            @endif
                            @if ($user->role_id == 1)
                                <input type="file" class="form-control form-control-sm mt-3" name="buktiPelepasanDana"
                                    id="buktiPelepasanDana">
                                <form action="" method="POST">
                                    <button type="submit" class="col-12 btn btn-dark btn-sm mt-3 mb-5">Unggah</button>
                                </form>
                            @else
                                <label for="">Admin belum mengunggah bukti pelepasan dana.</label>
                            @endif
                        </div>
                    @else
                    @endif
                    
                    {{-- Selesaikan Pesanan --}}
                    @if ($user->role_id != 3)
                        @if ($transaksi->status == 'Dikirim')
                            <form action="" method="POST">
                                <button type="submit" class="col-12 btn btn-success btn-sm">Selesaikan Pesanan</button>
                            </form>
                        @endif
                    @endif

                    {{-- Ulasan --}}
                    @if ($user->role_id == 2)
                        @if ($transaksi->status == 'Selesai')
                            <form action="" method="POST">
                                <label for="ulasan" class="col-form-label mt-4 fw-bold">Berikan Ulasan</label>
                                <div class="mb-3">
                                    <input type="catatan" id="ulasan" name="ulasan" class="form-control"
                                        placeholder="Silahkan berikan ulasan...">
                                </div>
                                <button type="submit" class="col-12 btn btn-success btn-sm">Kirim Ulasan</button>
                            </form>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
