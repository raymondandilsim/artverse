@extends('Master')

@section('Page-Title')
    Detail Lukisan - {{ $lukisan->nama_lukisan }}
@endsection

@section('Page-Contents')
    <div class="p-5 d-flex justify-content-center mb-5">
        <div id="carouselExampleAutoplaying" class="myCarousel carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ $lukisan->gambar_pertama }}" class="d-block w-100 h-100" alt="{{ $lukisan->nama_lukisan }}">
                </div>
                @if ($lukisan->gambar_kedua != null)
                    <div class="carousel-item">
                        <img src="{{ $lukisan->gambar_kedua }}" class="d-block w-100" alt="{{ $lukisan->nama_lukisan }}">
                    </div>
                @endif
                @if ($lukisan->gambar_ketiga != null)
                    <div class="carousel-item">
                        <img src="{{ $lukisan->gambar_ketiga }}" class="d-block w-100" alt="{{ $lukisan->nama_lukisan }}">
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
            <div class="box-stock d-flex justify-content-between shadow px-5 pt-4">
                <div class="box-quantity">
                    <span><b> Atur jumlah dan catatan </b></span>
                    <div class="d-flex align-items-center mt-1">
                        <div class="d-flex me-2">
                            <input class="quantity text-center" type="number" id="quantity" name="quantity" value="1" min="1">
                        </div>
                        <div>Stock Total: {{ $lukisan->stok }}</div>
                    </div>
                    <div class="d-flex flex-row align-items-start mt-2"><img class="rounded-circle">
                        <textarea class="form-control shadow-none"></textarea>
                    </div>
                    <div class="mt-2 mb-3 text-right">
                        <button class="btn-primary btn-sm shadow-none">Post comment</button>
                    </div>
                    
                </div>
                <div>
                    @if (Auth::check())
                        <a href=""><button class="btn-tambah-keranjang text-white fw-bold mt-4">
                                +Keranjang</button></a>
                        <a class="text-decoration-none" href="/checkoutPage/{{ $lukisan->id }}"><button class="btn-beli-langsung fw-bold mt-2">Beli
                                Langsung</button></a>
                    @else
                        @guest
                            <a href="/loginPage"><button class="btn-tambah-keranjang text-white fw-bold mt-4">
                                    +Keranjang</button></a>
                            <a class="text-decoration-none" href="/loginPage"><button
                                    class="btn-beli-langsung fw-bold mt-2">Beli Langsung</button></a>
                        @endguest
                    @endif
                </div>
            </div>
            <div class="box-deskripsi shadow mt-4 p-5">
                <h4><b>{{ $lukisan->nama_lukisan }}</b></h4>
                <p class="mt-3"><b>Rp{{ $lukisan->harga }}</b></p>
                <ul class="list-unstyled">
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
                    <div class="d-flex justify-content-between align-items-center mt-1 mb-1">
                        <div>
                            <img src="{{ $lukisan->user->foto_profil}}" alt="{{ $lukisan->user->username }}" width="50" height="50">
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
                        <button class="btn-diskusi text-white"><b>Diskusi</b></button>
                        <button class="btn-ulasan text-white"><b>Ulasan</b></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
