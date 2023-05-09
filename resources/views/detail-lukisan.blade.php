@extends('Master')

@section('Page-Contents')
    <div class="p-5 d-flex justify-content-center">
        <div>
            <div class="art border">
                <img src="\asset\profile.png" alt="">
            </div>
            <div class="d-flex mt-3">
                <div class="tampilan-lukisan border">
                    <img src="\asset\profile.png" alt="">
                </div>
                <div class="tampilan-lukisan border mx-4">
                    <img src="\asset\profile.png" alt="">
                </div>
            </div>
        </div>
        <div class="ms-5">
            <div class="box-stock d-flex justify-content-between shadow px-5 pt-4">
                <div>
                    <span><b> Atur jumlah dan catatan </b></span>
                    <div class="d-flex align-items-center mt-1">
                        <div class="box-add d-flex me-1">
                            <button class="plus-btn border-0 pt-0">-</button>
                            <input class="quantity text-center border-0" type="text" id="quantity" value="1">
                            <button class="min-btn border-0 pt-0">+</button>
                        </div>
                        <div>Stock Total:</div>
                    </div>
                    <div class="d-flex flex-row align-items-start"><img class="rounded-circle">
                        <textarea class="form-control ml-1 shadow-none "></textarea>
                    </div>
                    <div class="mt-2 text-right"><button class="btn btn-primary btn-sm shadow-none" type="button">Post
                            comment</button><button class="btn btn-outline-primary btn-sm ml-1 shadow-none"
                            type="button">Cancel</button></div>
                    <div class="d-flex justify-content-between mt-4">
                        <span>Subtotal</span>
                        <span><b>Rp 224.242</b></span>
                    </div>
                </div>
                <div>
                    <button class="btn-tambah-keranjang text-white fw-bold mt-2"> +Keranjang</button>
                    <button class="btn-beli-langsung fw-bold mt-2">Beli Langsung</button>
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
