@extends('Master')

@section('Page-Title')
    Perbarui Lukisan - {{ $lukisan->nama_lukisan }}
@endsection

@section('Page-Contents')
    <div class="d-flex flex-column mb-3">
        <div class="mt-5 d-flex justify-content-center">
            <h3 class=""><b>Perbarui Lukisan</b></h3>
        </div>

        <div class="d-flex bg-detail justify-content-center align-items-center p-2 mb-5 pb-5">
            <div class="card-unggah-lukisan bg-white px-5 py-5 rounded-3 shadow">
                <h5 class="text-start mb-4"><b>Informasi Produk</b></h5>
                
                <form action="/perbaruiLukisan/{{ $lukisan->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <div class="mb-3 row">
                            <label for="namaLukisan" class="col-sm-2 col-form-label">Nama Lukisan <label
                                    class="text-danger">*</label></label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" id="namaLukisan" name="namaLukisan" 
                                    value="{{ $lukisan->nama_lukisan }}" placeholder="Contoh: Lukisan Edvard Munch The Scream Painting">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="hargaLukisan" class="col-sm-2 col-form-label">Harga <label
                                    class="text-danger">*</label></label>
                            <div class="col-sm-10">
                                <input class="form-control" type="number" id="hargaLukisan" name="hargaLukisan"
                                    value="{{ $lukisan->harga }}"placeholder="Masukkan Harga">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="deskripsiLukisan" class="col-sm-2 col-form-label">Deskripsi <label
                                    class="text-danger">*</label></label>
                            <div class="col-sm-10">
                                <textarea name="deskripsiLukisan" id="deskripsiLukisan" cols="133" rows="5"
                                    placeholder="  Contoh: The Scream adalah nama populer yang diberikan untuk komposisi yang dibuat oleh seniman Norwegia Edvard Munch pada tahun 
  1893. Wajah menderita dalam lukisan itu menjadi salah satu gambar seni yang paling ikonik, dipandang sebagai simbol kegelisahan akan 
  kondisi manusia. ">{{ $lukisan->deskripsi }}</textarea>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="stokLukisan" class="col-sm-2 col-form-label">Stok <label
                                    class="text-danger">*</label></label>
                            <div class="col-sm-10">
                                <input class="form-control" type="number" id="stokLukisan" name="stokLukisan"
                                    value="{{ $lukisan->stok }}"placeholder="Masukkan Stok Produk">
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
                            <p>Sebelumnya: "{{ $lukisan->kondisi }}"</p>
                        </div>
                        <div class="mb-3 row">
                            <label for="beratLukisan" class="col-sm-2 col-form-label">Berat <label
                                    class="text-danger">*</label></label>
                            <div class="row col-sm-3 ps-4">
                                <input class="col form-control" type="number" id="beratLukisan" name="beratLukisan"
                                    value="{{ $lukisan->berat }}"placeholder="Berat Produk">
                                <span class="col col-sm-2 badge bg-secondary pt-2">gram</span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="beratLukisan" class="col-sm-2 col-form-label">Ukuran <label
                                    class="text-danger">*</label></label><br>
                            <div class="row col-sm-3 ps-4">
                                <input class="col form-control" type="number" id="panjangLukisan" name="panjangLukisan"
                                    value="{{ old('lebarLukisan') }}"placeholder="Panjang">
                                <span class="col col-sm-2 badge bg-secondary pt-2">cm</span>
                            </div>
                            <div class="row col-sm-3 ps-4">
                                <input class="col form-control" type="number" id="lebarLukisan" name="lebarLukisan"
                                    value="{{ old('lebarLukisan') }}"placeholder="Lebar">
                                <span class="col col-sm-2 badge bg-secondary pt-2">cm</span>
                            </div>
                            <div class="row col-sm-3 ps-4">
                                <input class="col form-control" type="number" id="tinggiLukisan" name="tinggiLukisan"
                                    value="{{ old('tinggiLukisan') }}" placeholder="Tinggi">
                                <span class="col col-sm-2 badge bg-secondary pt-2">cm</span>
                            </div>
                            <p class="mt-2">Sebelumnya: "{{ $lukisan->ukuran }} cm"</p>
                        </div>
                        <div class="mb-3">
                            <label for="gambarLukisan" class="form-label">Gambar Lukisan (Gambar Pertama Wajib)<label
                                    class="text-danger">*</label></label>
                            <br><img class="mt-1 mb-3 rounded" src="{{ $lukisan->gambar_pertama }}" alt="Lukisan belum terdaftar" width="200">
                            <input class="form-control mb-1" type="file" id="gambarLukisan1" name="gambarLukisan1">
                            <br><img class="mt-1 mb-3 rounded" src="{{ $lukisan->gambar_kedua }}" alt="Lukisan belum terdaftar" width="200">
                            <input class="form-control mb-1" type="file" id="gambarLukisan2" name="gambarLukisan2">
                            <br><img class="mt-1 mb-3 rounded" src="{{ $lukisan->gambar_ketiga }}" alt="Lukisan belum terdaftar" width="200">
                            <input class="form-control mb-1" type="file" id="gambarLukisan3" name="gambarLukisan3">
                        </div>
                        <input class="btn btn-secondary form-control mt-5" type="submit" value="Unggah">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
