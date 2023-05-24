@extends('Master')

@section('Page-Title')
    Check Out
@endsection

@section('Page-Contents')
    <div class="container mt-5 mb-5" style="height: 1000px; overflow-y: auto;">
        <div class="row align-items-start">
            <div class="col-8">
                <h4 class="fw-bold">Checkout</h4>
                <div class="mt-4 pb-3 border-bottom border-dark">
                    <h6 class="mt-4 pb-3 border-bottom border-dark fw-bold">Alamat Pengirim</h6>
                    <h6 class="fw-bold">{{ auth()->user()->nama }}</h6>
                    <label>{{ auth()->user()->nomor_telepon }}</label> <br>
                    <label class="">{{ auth()->user()->nama_jalan }}, {{ auth()->user()->nama_kota }},
                        {{ auth()->user()->nama_provinsi }}, {{ auth()->user()->kode_pos }}
                    </label>
                </div>
                <div class="mt-3 pb-3 border-bottom border-dark">
                    <h6>{{ $lukisan->user->username }}</h6>
                    <label class="fw-light">{{ $lukisan->user->nama_kota }}</label> <br>
                    <div class="row mt-3">
                        <div class="col-1">
                            <img src="{{ $lukisan->gambar_pertama }}" class="rounded" alt="{{ $lukisan->nama_lukisan }}"
                                width="80" height="80">
                        </div>
                        <div class="col col-8 ms-4">
                            <h6 class="fw-bold">{{ $lukisan->nama_lukisan }}</h6>
                            <h6 class="">Rp{{ $lukisan->harga }}</h6>
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mt-1 mb-4">
                        <div class="col-auto">
                            <label for="catatan" class="col-form-label">Catatan:</label>
                        </div>
                        <div class="col-5 ms-2">
                            <input type="catatan" id="catatan" name="catatan" class="form-control"
                                placeholder="Silahkan tinggalkan catatan...">
                        </div>
                    </div>
                    <label for="pengiriman" class="fw-bold">Pilih Pengiriman</label> <br>
                    <select name="shipping_option" class="btn btn-secondary mt-2">
                        <option value="jne" class="text-start">JNE</option>
                    </select>
                </div>
            </div>
            <div class="col-4 bg-primary">
                One of three columns
                
            </div>
        </div>
    </div>
@endsection
