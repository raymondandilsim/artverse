@extends('Master')

@section('Page-Title')
    Tambah Produk
@endsection

@section('Page-Contents')
    <div class="d-flex flex-column mb-3">
        <div class="mt-5 d-flex justify-content-center">
            <h3 class=""><b>Tambah Lukisan</b></h3>
        </div>

        <div class="d-flex bg-daftar justify-content-center align-items-center p-2 mb-5 pb-5">
            <div class="card-unggah-lukisan bg-white px-5 py-5 rounded-3 shadow">
                <h5 class="text-start mb-4"><b>Informasi Produk</b></h5>
                
                <form action="/unggahLukisan" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <div class="mb-3 row">
                            <label for="namaLukisan" class="col-sm-2 col-form-label">Nama Lukisan <label
                                    class="text-danger">*</label></label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" id="namaLukisan" name="namaLukisan" 
                                    value="{{ old('namaLukisan') }}" placeholder="Contoh: Lukisan Edvard Munch The Scream Painting">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="hargaLukisan" class="col-sm-2 col-form-label">Harga <label
                                    class="text-danger">*</label></label>
                            <div class="col-sm-10">
                                <input class="form-control" type="number" id="hargaLukisan" name="hargaLukisan"
                                    value="{{ old('hargaLukisan') }}" placeholder="Masukkan Harga dalam Bentuk Rupiah">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="deskripsiLukisan" class="col-sm-2 col-form-label">Deskripsi <label
                                    class="text-danger">*</label></label>
                            <div class="col-sm-10">
                                <textarea name="deskripsiLukisan" id="deskripsiLukisan" cols="133" rows="5"
                                    placeholder="  Contoh: The Scream adalah nama populer yang diberikan untuk komposisi yang dibuat oleh seniman Norwegia Edvard Munch pada tahun 
  1893. Wajah menderita dalam lukisan itu menjadi salah satu gambar seni yang paling ikonik, dipandang sebagai simbol kegelisahan akan 
  kondisi manusia. ">{{ old('deskripsiLukisan') }}</textarea>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="stokLukisan" class="col-sm-2 col-form-label">Stok <label
                                    class="text-danger">*</label></label>
                            <div class="col-sm-10">
                                <input class="form-control" type="number" id="stokLukisan" name="stokLukisan"
                                    value="{{ old('stokLukisan') }}" placeholder="Masukkan Stok Produk">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="kondisiLukisan" class="col-sm-2 col-form-label">Kondisi <label
                                    class="text-danger">*</label></label>
                            <div class="col-sm-10">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="kondisiLukisan"
                                        id="kondisiBaru" value="Baru">
                                    <label class="form-check-label" for="kondisiBaru">Baru</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="kondisiLukisan"
                                        id="kondisiBekas" value="Bekas">
                                    <label class="form-check-label" for="kondisiBekas">Bekas</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="beratLukisan" class="col-sm-2 col-form-label">Berat <label
                                    class="text-danger">*</label></label>
                            <div class="row col-sm-3 ps-4">
                                <input class="col form-control" type="number" id="beratLukisan" name="beratLukisan"
                                    value="{{ old('beratLukisan') }}"placeholder="Berat Produk">
                                <span class="col col-sm-2 badge bg-secondary pt-2">gram</span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="beratLukisan" class="col-sm-2 col-form-label">Ukuran <label
                                    class="text-danger">*</label></label><br>
                            <div class="row col-sm-3 ps-4">
                                <input class="col form-control" type="number" id="panjangLukisan" name="panjangLukisan"
                                    value="{{ old('panjangLukisan') }}"placeholder="Panjang">
                                <span class="col col-sm-2 badge bg-secondary pt-2">cm</span>
                            </div>
                            <div class="row col-sm-3 ps-4">
                                <input class="col form-control" type="number" id="lebarLukisan" name="lebarLukisan"
                                    value="{{ old('lebarLukisan') }}"placeholder="Lebar">
                                <span class="col col-sm-2 badge bg-secondary pt-2">cm</span>
                            </div>
                            <div class="row col-sm-3 ps-4">
                                <input class="col form-control" type="number" id="tinggiLukisan" name="tinggiLukisan"
                                    value="{{ old('tinggiLukisan') }}"placeholder="Tinggi">
                                <span class="col col-sm-2 badge bg-secondary pt-2">cm</span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="gambarLukisan" class="form-label">Gambar Lukisan (Gambar Pertama Wajib)<label
                                    class="text-danger">*</label></label>
                            <input class="form-control mb-3" type="file" id="gambarLukisan1" name="gambarLukisan1" value="{{ old('gambarLukisan1') }}">
                            <input class="form-control mb-3" type="file" id="gambarLukisan2" name="gambarLukisan2" value="{{ old('gambarLukisan2') }}">
                            <input class="form-control mb-3" type="file" id="gambarLukisan3" name="gambarLukisan3" value="{{ old('gambarLukisan3') }}">
                        </div>
                        <input class="btn-daftar text-white form-control mt-5" type="submit" value="Unggah">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

