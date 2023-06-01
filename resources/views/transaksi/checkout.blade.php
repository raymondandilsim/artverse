@extends('Master')

@section('Page-Title')
    Konfirmasi Pembayaran
@endsection

@section('Page-Contents')
    <form action="/pembayaranPage/{{ $lukisan->id }}/{{ $quantity }}" method="GET" enctype="multipart/form-data">
        @csrf
        <div class="container mt-5 mb-5" style="height: 1000px; overflow-y: auto;">
            <div class="align-items-start">
                <div class="card pt-5 pb-5 ps-4 pe-4">
                    <h2 class="fw-bold">Konfirmasi Pesanan</h2>
                    <div class="mt-3 pb-3 border-bottom border-dark">
                        <h6 class="mt-4 pb-3 border-bottom border-dark fw-bold">Alamat Pengiriman</h6>
                        <h6 class="fw-bold">{{ auth()->user()->nama }}</h6>
                        <label>{{ auth()->user()->nomor_telepon }}</label> <br>
                        <label class="">{{ auth()->user()->nama_jalan }}, {{ auth()->user()->nama_kota }},
                            {{ auth()->user()->nama_provinsi }}, {{ auth()->user()->kode_pos }}
                        </label>
                    </div>
                    <div class="mt-4 pb-3 border-dark">
                        <h6>{{ $lukisan->user->username }} (Penjual)</h6>
                        <label class="fw-light">{{ $lukisan->user->nama_kota }}</label> <br>
                        <div class="row mt-3">
                            <div class="col-1">
                                <img src="{{ $lukisan->gambar_pertama }}" class="rounded"
                                    alt="{{ $lukisan->nama_lukisan }}" width="80" height="80">
                            </div>
                            <div class="col col-8 ms-4">
                                <h6 class="fw-bold">{{ $lukisan->nama_lukisan }}</h6>
                                <h6 class="">Rp{{ $lukisan->harga }} x {{ $quantity }}</h6>
                            </div>
                        </div>
                        <div class="row g-3 align-items-center mt-3 mb-5">
                            <div class="col-auto">
                                <label for="catatan" class="col-form-label">Catatan:</label>
                            </div>
                            <div class="col-5 ms-2">
                                <input type="catatan" id="catatan" name="catatan" class="form-control"
                                    placeholder="Silahkan tinggalkan catatan...">
                            </div>
                        </div>
                        <label for="pengiriman" class="fw-bold mb-2">Pilih Jenis Pengiriman</label><br>
                        <button type="button" class="btn btn-secondary mt-2" disabled>JNE</button>
                        {{-- <select name="courier" class="btn btn-secondary mt-2 disabled">
                        <option value="jne" class="text-start">JNE</option>
                    </select> --}}
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

                </div>
            </div>
        </div>
    </form>
@endsection
