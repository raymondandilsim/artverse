@extends('Master')

@section('Page-Contents')
    <div class="p-5 d-flex justify-content-center">
        <div>
            <div class="art border">
                <img src="\asset\profile.png">
            </div>
            <div class="d-flex mt-3">
                <div class="tampilan-lukisan border">
                    <img src="\asset\profile.png">
                </div>
                <div class="tampilan-lukisan border mx-4">
                    <img src="\asset\profile.png">
                </div>
            </div>
        </div>
        <div class="ms-5">
            <div class="box-stock d-flex justify-content-between shadow px-5 pt-4">
                <div class="box-quantity">
                    <span><b> Atur jumlah dan catatan </b></span>
                    <div class="d-flex align-items-center mt-1">
                        <div class="d-flex me-2">
                            <input class="quantity text-center" type="number" id="quantity" value="1" min="1"
                                max="10">
                        </div>
                        <div>Stock Total:</div>
                    </div>
                    <div class="d-flex flex-row align-items-start mt-2"><img class="rounded-circle">
                        <textarea class="form-control shadow-none"></textarea>
                    </div>
                    <div class="mt-2 text-right">
                        <button class="btn-primary btn-sm shadow-none">Post comment</button>
                    </div>
                    <div class="d-flex justify-content-between my-3">
                        <span>Subtotal</span>
                        <span><b>Rp 224.242</b></span>
                    </div>
                </div>
                <div>
                    @if (Auth::check())
                        <a href=""><button class="btn-tambah-keranjang text-white fw-bold mt-4">
                                +Keranjang</button></a>
                        <a class="text-decoration-none" href=""><button class="btn-beli-langsung fw-bold mt-2">Beli
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
                <h4><b>Lukisan</b></h4>
                <p><b>Rp 131.323</b></p>
                <ul class="list-unstyled">
                    <li><span>Kondisi:</span></li>
                    <li><span>Berat Satuan:</span></li>
                    <li><span>Kategori:</span></li>
                    <li><span>Etalase:</span></li>
                    <p>Deskripsi</p>
                </ul>
                <div class="border-bottom border-dark">
                    <ul class="list-unstyled">
                        <li><span>Medium:</span></li>
                        <li><span>Frame:</span></li>
                        <li><span>Quality:</span></li>
                        <li><span>Packaging:</span></li>
                        <li><span>Size:</span></li>
                    </ul>
                </div>
                <div class="mt-2 pb-2 border-bottom border-dark">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <img src="\asset\profile.png" alt="">
                            <span class="mx-2">Yanto</span>
                        </div>
                        <a class="text-decoration-none text-dark me-2" href=""><i
                                class="bi-chat-left-text me-2"></i>Chat</a>
                    </div>
                </div>
                <div class="p-2">
                    <i class="bi-geo-alt-fill"></i>
                    <span>Dikirim dari kota <b>Kota</b></span>
                    <div class="d-flex justify-content-center justify-content-around mt-3">
                        <button class="btn-diskusi text-white"><b>Diskusi</b></button>
                        <button class="btn-ulasan text-white"><b>Ulasan</b></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
