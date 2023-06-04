@extends('Master')

@section('Page-Title')
    Konfirmasi Pembayaran
@endsection

@section('Page-Contents')
    <div class="container mt-5 mb-5 pb-5" style="height: fluid; overflow-y: auto;">
        <div class="align-items-start">
            <div class="card pt-5 pb-5 ps-4 pe-4">
                <h2 class="fw-bold text-center">Konfirmasi Pesanan</h2>
                <div class="mt-3 pb-3">
                    <h6 class="mt-4 fw-bold">Alamat Pengiriman</h6>
                    <hr>
                    <h6 class="fw-bold">{{ auth()->user()->nama }}</h6>
                    <label>{{ auth()->user()->nomor_telepon }}</label> <br>
                    <label class="">{{ auth()->user()->nama_jalan }}, {{ auth()->user()->nama_kota }},
                        {{ auth()->user()->nama_provinsi }}, {{ auth()->user()->kode_pos }}
                    </label>
                    <hr>
                </div>
                <form action="/pembayaranKeranjangPage" method="GET" enctype="multipart/form-data">
                    @csrf
                    <div class="pb-3">
                        <h6 class="fw-bold">{{ $lukisan->user->username }} (Penjual)</h6>
                        <label class="fw-light">{{ $lukisan->user->nama_kota }}</label> <br>
                        @foreach ($itemKeranjang as $item)
                            <div class="row mt-4">
                                <div class="col-1">
                                    <img src="{{ $item->lukisan->gambar_pertama }}" class="rounded"
                                        alt="{{ $item->lukisan->nama_lukisan }}" width="80" height="80">
                                </div>
                                <div class="col col-8 ms-4">
                                    <h6 class="fw-bold">{{ $item->lukisan->nama_lukisan }}</h6>
                                    @php
                                        $formatHarga = number_format($item->lukisan->harga, 0, '.', '.');
                                    @endphp
                                    <h6 class="">Rp{{ $formatHarga }} x {{ $item->kuantitas }}</h6>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mt-3">
                                <div class="col-auto">
                                    <label for="catatan" class="col-form-label">Catatan:</label>
                                </div>
                                <div class="col-5 ms-2">
                                    <input type="text" id="catatan[{{ $item->id }}]" name="catatan[{{ $item->id }}]" class="form-control"
                                        placeholder="Silahkan tinggalkan catatan...">
                                </div>
                            </div>
                            <hr>
                        @endforeach
                        <label for="pengiriman" class="fw-bold mb-2">Pilih Jenis Pengiriman</label><br>
                        <button type="button" class="btn btn-secondary mt-2" disabled>JNE</button>
                        <select name="jenisPengiriman" id="jenisPengiriman" class="btn btn-secondary mt-2">
                            @foreach ($cekOngkir as $item)
                                @php
                                    $formatHarga = number_format($item['cost'][0]['value'], 0, '.', '.');
                                @endphp
                                <option value="{{ $item['cost'][0]['value'] }}" class="text-start">{{ $item['service'] }}
                                    (Rp{{ $formatHarga }})
                                    ( {{ $item['cost'][0]['etd'] }} Hari )</option>
                            @endforeach
                        </select>
                        <div class="form-check mt-3">
                            <input class="form-check-input btn-secondary" type="checkbox" value=""
                                id="flexCheckDefault" checked disabled>
                            <label class="form-check-label" for="flexCheckDefault">
                                Wajib Asuransi
                            </label>
                        </div>
                        <input class="btn btn-dark form-control mt-4" type="submit" value="Buat Pesanan">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
