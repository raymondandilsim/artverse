@extends('Master')

@section('Page-Title')
    Detail Lukisan - {{ $lukisan->nama_lukisan }}
@endsection

@section('Page-Contents')
    <div class="p-5 d-flex justify-content-center mb-5">
        <div id="carouselExampleAutoplaying" class="myCarousel carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ $lukisan->gambar_pertama }}" class="d-block w-100 h-100 rounded"
                        alt="{{ $lukisan->nama_lukisan }}">
                </div>
                @if ($lukisan->gambar_kedua != null)
                    <div class="carousel-item">
                        <img src="{{ $lukisan->gambar_kedua }}" class="d-block w-100 h-100 rounded"
                            alt="{{ $lukisan->nama_lukisan }}">
                    </div>
                @endif
                @if ($lukisan->gambar_ketiga != null)
                    <div class="carousel-item">
                        <img src="{{ $lukisan->gambar_ketiga }}" class="d-block w-100 h-100 rounded"
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
            <div class="col box-stock d-flex justify-content-between shadow px-5">
                @if (Auth::check())
                    <div class="row">
                        <form action="/tambahkanKeKeranjang/{{ $lukisan->id }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @if ($lukisan->stok == 0)
                                <button type="button" class="btn-tambah-keranjang text-white fw-bold mt-4" disabled>
                                    +Keranjang
                                </button>
                            @else
                                <!-- Button trigger modal Keranjang--->
                                <button type="button" class="btn-tambah-keranjang text-white fw-bold mt-4"
                                    data-bs-toggle="modal" data-bs-target="#keranjangModal">
                                    +Keranjang
                                </button>

                                <!-- Modal Keranjang-->
                                <div class="modal fade" id="keranjangModal" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Masukkan Jumlah yang
                                                    Diinginkan</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <span class="">Stok</span>
                                                <span class="">: {{ $lukisan->stok }}</span>
                                                <br><br>
                                                <span class="me-3">Jumlah</span>
                                                <input class="quantity text-center" type="number" id="quantity"
                                                    name="quantity" value="1" min="1"
                                                    max="{{ $lukisan->stok }}">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <button type="Submit" class="btn btn-primary">Tambahkan ke
                                                    Keranjang</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </form>
                    </div>

                    <div class="row">
                        <form action="/checkoutPage/{{ $lukisan->id }}" method="GET" enctype="multipart/form-data">
                            @csrf
                            @if ($lukisan->stok == 0)
                                <button type="button" class="btn-beli-langsung fw-bold mt-4" disabled>
                                    Beli Langsung
                                </button>
                            @else
                                <!-- Button trigger modal Beli Langsung--->
                                <button type="button" class="btn-beli-langsung fw-bold mt-4" data-bs-toggle="modal"
                                    data-bs-target="#beliLangsungModal">
                                    Beli Langsung
                                </button>

                                <!-- Modal Beli Langsung-->
                                <div class="modal fade" id="beliLangsungModal" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Masukkan Jumlah yang
                                                    Diinginkan</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <span class="">Stok</span>
                                                <span class="">: {{ $lukisan->stok }}</span>
                                                <br><br>
                                                <span class="me-3">Jumlah</span>
                                                <input class="quantity text-center" type="number" id="quantity"
                                                    name="quantity" value="1" min="1"
                                                    max="{{ $lukisan->stok }}">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <button type="Submit" class="btn btn-primary">Beli Langsung</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </form>
                    </div>
                @else
                    @guest
                        <div class="row">
                            <a class="text-decoration-none" href="/loginPage"><button
                                    class="btn-tambah-keranjang text-white fw-bold mt-4">
                                    +Keranjang</button></a>
                        </div>
                        <div class="row">
                            <a class="text-decoration-none" href="/loginPage"><button
                                    class="btn-beli-langsung fw-bold mt-2">Beli
                                    Langsung</button></a>
                        </div>
                    @endguest
                @endif
            </div>
            <div class="box-deskripsi shadow mt-4 p-5">
                @if ($lukisan->stok == 0)
                    <h4><b>{{ $lukisan->nama_lukisan }}</b></h4>
                    <label class="text-danger">*Stok Sedang Habis</label>
                @else
                    <h4><b>{{ $lukisan->nama_lukisan }}</b></h4>
                @endif
                @php
                    $formatHarga = number_format($lukisan->harga, 0, '.', '.');
                @endphp
                <p class="mt-3"><b>Rp{{ $formatHarga }}</b></p>
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

                    <h6 class="mt-4">Deskripsi</h6>
                    <p class="mb-5">{{ $lukisan->deskripsi }}</p>
                </ul>

                <div class="mt-5 pb-2 border-bottom border-top border-dark">
                    <div class="d-flex justify-content-between align-items-center mt-2 mb-1">
                        <div>
                            <img src="{{ $lukisan->user->foto_profil }}" alt="{{ $lukisan->user->username }}"
                                width="50" height="50" class="rounded">
                            <span class="mx-2">{{ $lukisan->user->username }}</span>
                        </div>
                        <a class="text-decoration-none text-dark me-2" href=""><i
                                class="bi-chat-left-text me-2"></i>Chat</a>
                    </div>
                </div>
                <div class="p-2">
                    <i class="bi-geo-alt-fill"></i>
                    <span>Dikirim dari kota <b>{{ $lukisan->user->nama_kota }}</b></span>
                    <div class="d-flex justify-content-center justify-content-around mt-3">
                        <a href="/diskusiPage/{{$lukisan->id}}"><button class="btn-diskusi text-white"><b>Diskusi</b></button></a>
                        <button class="btn-ulasan text-white"><b>Ulasan</b></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
