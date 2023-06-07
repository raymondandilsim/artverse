@extends('Master')

@section('Page-Title')
    Detail Lukisan - {{ $lukisan->nama_lukisan }}
@endsection

@section('Page-Contents')
    <div class="p-5 d-flex justify-content-center mb-5">
        <div id="carouselExampleAutoplaying" class="myCarousel carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ $lukisan->gambar_pertama }}" class="d-block w-100 rounded" alt="{{ $lukisan->nama_lukisan }}">
                </div>
                @if ($lukisan->gambar_kedua != null)
                    <div class="carousel-item">
                        <img src="{{ $lukisan->gambar_kedua }}" class="d-block w-100 rounded"
                            alt="{{ $lukisan->nama_lukisan }}">
                    </div>
                @endif
                @if ($lukisan->gambar_ketiga != null)
                    <div class="carousel-item">
                        <img src="{{ $lukisan->gambar_ketiga }}" class="d-block w-100 rounded"
                            alt="{{ $lukisan->nama_lukisan }}">
                    </div>
                @endif
            </div>
            @if ($lukisan->gambar_kedua != null || $lukisan->gambar_ketiga != null)
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            @endif
        </div>
        <div class="ms-5">
            <div class="box-deskripsi shadow p-5">
                <h4 class="mb-3"><b>{{ $lukisan->nama_lukisan }}</b></h4>
                @php
                    $formatHarga = number_format($lukisan->harga, 0, '.', '.');
                @endphp
                <p><b>Rp{{ $formatHarga }}</b></p>
                <ul class="list-unstyled">
                    <div class="row">
                        <li class="col-sm-4"><span>Stok</span></li>
                        <span class="col-sm-8">: {{ $lukisan->stok }}</span>
                    </div>
                    <div class="row">
                        <li class="col-sm-4"><span>Kondisi</span></li>
                        <span class="col-sm-8">: {{ $lukisan->kondisi }}</span>
                    </div>
                    <div class="row">
                        <li class="col-sm-4"><span>Berat Satuan</span></li>
                        <span class="col-sm-8">: {{ $lukisan->berat }} gram</span>
                    </div>
                    <div class="row">
                        <li class="col-sm-4"><span>Ukuran</span></li>
                        <span class="col-sm-8">: {{ $lukisan->ukuran }} cm</span>
                    </div>

                    <h5 class="mt-4">Deskripsi</h5>
                    <p class="">{{ $lukisan->deskripsi }}</p>
                </ul>
                <div class="row">
                    <a class="col-sm-3 text-decoration-none" href="/perbaruiLukisanPage/{{ $lukisan->id }}">
                        <button class="btn btn-lg btn-secondary text-white fw-bold mt-5">Perbarui</button></a>
                    <form action="/hapusLukisan/{{ $lukisan->id }}" method="POST" enctype="multipart/form-data"
                        class="col-sm-3">
                        @csrf
                        <!-- Button trigger modal Delete Confirmation-->
                        <button type="button" class="btn btn-lg btn-danger fw-bold mt-5" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            Hapus
                        </button>

                        <!-- Modal Delete Confirmation-->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Lukisan</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Apakah anda yakin ingin menghapus lukisan {{ $lukisan->nama_lukisan }}?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Batal</button>
                                        <button type="Submit" class="btn btn-danger">Hapus</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <a class="col-sm-3 text-decoration-none" href="/diskusiPage/{{$lukisan->id}}">
                        <button class="btn btn-lg btn-secondary fw-bold mt-5">Diskusi</button></a>
                    <a class="col-sm-3 text-decoration-none" href="/lihatSemuaUlasan/{{ $lukisan->id }}">
                        <button class="btn btn-lg btn-secondary fw-bold mt-5">Ulasan</button></a>
                </div>
            </div>
        </div>
    </div>
@endsection
