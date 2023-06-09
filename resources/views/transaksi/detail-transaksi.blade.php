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
    <div class="container mt-5 mb-5" style="height: 2000px; overflow-y: auto;">
        <div class="row">
            <div class="col-8 align-items-start">
                <div class="card bg-warning text-center pt-2">
                    <h3>{{ $transaksi->status }}</h3>
                </div>
                <div class="card pb-5 ps-4 pe-4">
                    <h2 class="mt-5 fw-bold">Detail Transaksi</h2>

                    <div class="mt-3">
                        <h6 class="mt-4 fw-bold">Alamat Pengiriman</h6>
                        <hr>
                        <h6 class="fw-bold">{{ $transaksi->user->nama }}</h6>
                        <label>{{ $transaksi->user->nomor_telepon }}</label> <br>
                        <label class="">{{ $transaksi->user->nama_jalan }}, {{ $transaksi->user->kota->nama_kota }},
                            {{ $transaksi->user->provinsi->provinsi }}, {{ $transaksi->user->kode_pos }}
                        </label><br><br>
                        <label for="">Jasa Pengiriman: JNE</label>
                        <hr>
                    </div>
                    <div class="mt-4 pb-3">
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
                                <h6 class="penjual fw-bold">{{ $item->username }} (Penjual)</h6>
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
                            @if ($item->catatan != null)
                                <div class="row g-3 align-items-center ">
                                    <div class="col-auto text-danger">
                                        <label for="catatan" class="col-form-label">Catatan:</label>
                                        <label for="catatan" class="col-form-label">{{ $item->catatan }}</label>
                                    </div>
                                </div>
                            @else
                                <br>
                            @endif
                            <div class="d-flex justify-content-between">
                                <label for="subtotal">Subtotal untuk Produk</label>
                                @php
                                    $formatHarga = number_format($item->subtotal_produk, 0, '.', '.');
                                @endphp
                                <label for="hargaSubtotal">Rp{{ $formatHarga }}</label>
                            </div>
                            <div class="d-flex justify-content-between mt-2">
                                <label for="asuransi">Biaya Asuransi</label>
                                @php
                                    $formatHarga = number_format($asuransi, 0, '.', '.');
                                @endphp
                                <label for="hargaAsuransi">Rp{{ $formatHarga }}</label>
                            </div>
                            
                            <hr>
                        @endforeach
                        
                        <div class="d-flex justify-content-between mt-5">
                            <label for="subtotalProduk">Subtotal Produk</label>
                            @php
                                $formatHarga = number_format($subtotalProduk, 0, '.', '.');
                            @endphp
                            <label for="subtotalProduk" id="subtotalProduk">Rp{{ $formatHarga }} </label>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <label for="ongkosKirim">Subtotal Pengiriman</label>
                            @php
                                $formatHarga = number_format($transaksi->subtotal_pengiriman, 0, '.', '.');
                            @endphp
                            <label for="hargaOngkosKirim" id="hargaOngkosKirim">Rp{{ $formatHarga }}</label>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <label for="biayaPenanganan">Biaya Penanganan Asuransi</label>
                            @php
                                $formatHarga = number_format(5000, 0, '.', '.');
                            @endphp
                            <label for="biayaPenanganan" id="biayaPenangananAsuransi">Rp{{ $formatHarga }} </label>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <label for="totalAsuransi">Subtotal Asuransi</label>
                            @php
                                $formatHarga = number_format($subtotalAsuransi, 0, '.', '.');
                            @endphp
                            <label for="totalAsuransi" id="totalAsuransi">Rp{{ $formatHarga }} </label>
                        </div>
                        <div class="d-flex justify-content-between mt-2 mb-5 pb-3 fw-bold">
                            <label for="totalPembayaran">Jumlah Harus Dibayar</label>
                            @php
                                $totalSemua = $totalSemua + $transaksi->total_pembelian;
                                $formatHarga = number_format($totalSemua, 0, '.', '.');
                            @endphp
                            <label for="hargaTotalPembayaran" class="text-danger">Rp{{ $formatHarga }}</label>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
            @if ($transaksi->status != 'Dibatalkan')
                <div class="col-4 card">
                    <div class="card-body">
                        <div class="mb-2">
                            <div class="row fw-bold">
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
                        <div class="mt-3 fw-bold">
                            <label for="" class="form-label text-danger peringatan"><label
                                    class="text-danger">*</label>Pastikan nama pengirim dana sesuai dengan nama akun anda,
                                agar
                                transaksi lebih cepat diproses.</label>
                            <label for="" class="form-label text-danger peringatan"><label
                                    class="text-danger">*</label>Jangan lupa unggah bukti pembayaran di halaman detail
                                transaksi ini agar transaksi bisa diproses lebih lanjut.</label>
                            <label for="" class="form-label text-danger peringatan"><label
                                    class="text-danger">*</label>Sistem berhak membatalkan pesanan jika bukti pembayaran
                                tidak
                                diunggah dalam jangka waktu 1 hari.</label>
                        </div>

                        {{-- Bukti Pembayaran --}}
                        <div class="mt-4 align-items-end">
                            {{-- Admin --}}
                            @if ($user->role_id == 1 && $transaksi->status == 'Menunggu Konfirmasi Pembayaran')
                                <div class="row b-2 mb-3">
                                    <div class="col-6">
                                        <label for="buktiPembayaran" class="form-label fw-bold">Bukti Pembayaran</label>
                                    </div>
                                    <div class="col-2 ps-4">
                                        <form action="/adminAccBuktiPembayaran/{{ $transaksi->id }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-success btn-sm"><i
                                                    class="bi bi-check-lg"></i></button>

                                        </form>
                                    </div>
                                    <div class="col-2">
                                        <form action="/adminDisBuktiPembayaran/{{ $transaksi->id }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-danger btn-sm"><i
                                                    class="bi bi-x"></i></button>
                                        </form>

                                    </div>

                                </div>
                            @else
                                <label for="buktiPembayaran" class="form-label fw-bold">Bukti Pembayaran</label> <br>
                            @endif

                            @if ($transaksi->bukti_pembayaran == null)
                                @if ($user->role_id == 1 || $user->role_id == 3)
                                    <label for="">Pembeli belum mengunggah bukti pembayaran.</label>
                                @else
                                    <label class="text-danger">*Mohon melakukan pembayaran dan mengunggah bukti
                                        pembayaran.</label>
                                    <form action="/unggahBuktiPembayaran/{{ $transaksi->id }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <input type="file" class="form-control form-control-sm mt-3"
                                            name="buktiPembayaran" id="buktiPembayaran">
                                        <button type="submit"
                                            class="col-12 btn btn-dark btn-sm mt-3 mb-5">Unggah</button>
                                    </form>
                                @endif
                            @else
                                <img src="{{ $transaksi->bukti_pembayaran }}" class="rounded" alt=""
                                    height="300" width="300">
                            @endif

                            {{-- Member --}}
                            @if ($user->role_id == 2)
                                @if ($transaksi->status == 'Menunggu Konfirmasi Pembayaran')
                                    <form action="/unggahBuktiPembayaran/{{ $transaksi->id }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <input type="file" class="form-control form-control-sm mt-3"
                                            name="buktiPembayaran" id="buktiPembayaran">
                                        <button type="submit"
                                            class="col-12 btn btn-dark btn-sm mt-3 mb-5">Unggah</button>
                                    </form>
                                @elseif ($transaksi->status == 'Pembayaran Invalid')
                                    <label class="text-danger mb-2 peringatan fw-bold"><label
                                            class="">*</label>Pembeli dimohon melakukan dan unggah bukti pembayaran
                                        yang benar.</label>
                                    <img src="{{ $transaksi->bukti_pembayaran }}" alt="" height="300"
                                        width="300">
                                    <form action="/unggahBuktiPembayaran/{{ $transaksi->id }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <input type="file" class="form-control form-control-sm mt-3"
                                            name="buktiPembayaran" id="buktiPembayaran">
                                        <button type="submit"
                                            class="col-12 btn btn-dark btn-sm mt-3 mb-5">Unggah</button>
                                    </form>
                                @endif
                            @endif
                        </div>

                        {{-- Bukti Pengiriman --}}
                        <div class="mt-4 align-items-end">
                            <label for="" class="form-label fw-bold">Bukti Pengiriman/Resi</label> <br>

                            @if ($transaksi->bukti_pengiriman == null)
                                @if ($user->role_id != 3)
                                    <label for="">Penjual belum mengunggah bukti pengiriman/resi.</label>
                                @endif
                            @else
                                <img src="{{ $transaksi->bukti_pengiriman }}" class="rounded" alt=""
                                    height="300" width="300">
                            @endif

                            @if ($user->role_id == 3)
                                @if (
                                    $transaksi->bukti_pembayaran == null ||
                                        $transaksi->status == 'Belum Bayar' ||
                                        $transaksi->status == 'Menunggu Konfirmasi Pembayaran' ||
                                        $transaksi->status == 'Pembayaran Invalid')
                                    <label class="text-danger">*Lakukan pengiriman dan unggah bukti pengiriman setelah
                                        status transaksi menjadi "Dikemas".</label>
                                @else
                                    <form action="/unggahBuktiPengiriman/{{ $transaksi->id }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        @if ($transaksi->bukti_pengiriman == null)
                                            <label class="text-danger">*Mohon lakukan pengiriman dan unggah bukti
                                                pengiriman.</label>
                                        @endif
                                        <input type="file" class="form-control form-control-sm mt-3"
                                            name="buktiPengiriman" id="buktiPengiriman">
                                        <button type="submit"
                                            class="col-12 btn btn-dark btn-sm mt-3 mb-5">Unggah</button>
                                    </form>
                                @endif
                            @endif
                        </div>

                        {{-- Bukti Pelepasan Dana --}}
                        {{-- Tampilan jika role user adalah Admin / Seniman --}}
                        @if ($user->role_id != 2)
                            <div class="mt-3 align-items-end">
                                <label for="buktiPelepasanDana" class="form-label fw-bold">Bukti Pelepasan Dana</label>
                                <br>
                                @if ($transaksi->bukti_pelepasan_dana == null)
                                    <label for="">Admin belum mengunggah bukti pelepasan dana.</label>
                                @else
                                    <img src="{{ $transaksi->bukti_pelepasan_dana }}" alt="" height="300"
                                        width="300">
                                @endif
                                @if ($user->role_id == 1)
                                    <form action="/unggahBuktiPelepasanDana/{{ $transaksi->id }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <input type="file" class="form-control form-control-sm mt-3"
                                            name="buktiPelepasanDana" id="buktiPelepasanDana">
                                        <button type="submit" class="col-12 btn btn-dark btn-sm mt-3">Unggah</button>
                                    </form>
                                @endif
                            </div>
                        @endif

                        {{-- Selesaikan Pesanan --}}
                        @if ($user->role_id != 3)
                            @if ($transaksi->status == 'Dikirim')
                                <div class="mt-5">
                                    <form action="/selesaikanPesanan/{{ $transaksi->id }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="col-12 btn btn-success btn-sm">Selesaikan
                                            Pesanan</button>
                                    </form>
                                </div>
                            @endif
                        @endif

                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
