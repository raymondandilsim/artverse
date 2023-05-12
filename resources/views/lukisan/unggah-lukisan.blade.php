@extends('Master')

@section('Page-Title')
    Tambah Lukisan -
@endsection

@section('Page-Contents')
<div class="d-flex flex-column mb-3">
    <div class="mt-5 d-flex justify-content-center">
        <h3 class=""><b>Tambah Lukisan</b></h3>
    </div>
    
    <div class="d-flex bg-daftar justify-content-center align-items-center p-2">
        <div class="card-unggah-lukisan bg-white px-5 py-5 rounded-3 shadow">
            <h5 class="text-start mb-4"><b>Informasi Produk</b></h5>
            @if (Auth::check())
                Welcome, user {{ Auth::id() }}
            @endif
            <form action="/unggahLukisan" method="POST" enctype="multipart/form-data">
                @csrf
                <div>
                    <div class="mb-3 row">
                        <label for="namaLukisan" class="col-sm-2 col-form-label">Nama Lukisan <label class="text-danger">*</label></label> 
                        <div class="col-sm-10">
                            <input class="form-control" type="text" id="namaLukisan" name="namaLukisan">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="hargaLukisan" class="col-sm-2 col-form-label">Harga <label class="text-danger">*</label></label>
                        <div class="col-sm-10">
                            <input class="form-control" type="number" id="hargaLukisan" name="hargaLukisan">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="deskripsiLukisan" class="col-sm-2 col-form-label">Deskripsi <label class="text-danger">*</label></label>
                        <div class="col-sm-10">
                            {{-- <input class="form-control" type="text" id="deskripsiLukisan" name="deskripsiLukisan">
                                --}}
                            <textarea name="deskripsiLukisan" id="deskripsiLukisan" cols="133" rows="5" placeholder="Masukkan juga berat dan ukuran"></textarea>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="stokLukisan" class="col-sm-2 col-form-label">Stok <label class="text-danger">*</label></label>
                        <div class="col-sm-10">
                            <input class="form-control" type="number" id="stokLukisan" name="stokLukisan">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="gambarLukisan" class="form-label">Gambar Lukisan <label class="text-danger">*</label></label>
                        <input class="form-control" type="file" id="gambarLukisan" name="gambarLukisan">
                    </div>
                    <input class="btn-daftar text-white form-control mt-5" type="submit" value="Unggah">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection