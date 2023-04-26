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
                        <div class="box-add d-flex justify-content-between me-1">
                            <input class="plus-btn border-0 pt-0" type="button" value="-">
                            <input type="text" id="quantity" value="1">
                            <input class="min-btn border-0 pt-0" type="button" value="+">
                        </div>
                        <span>Stock Total:</span>
                    </div>
                    <div class="d-flex justify-content-between mt-4">
                        <span>Subtotal</span>
                        <span><b>Rp 224.242</b></span>
                    </div>
                </div>
                <div>
                    <input class="btn-tambah-keranjang text-white fw-bold form-control" type="submit" value="+Keranjang">
                    <input class="btn-beli-langsung fw-bold mt-1 form-control" type="submit" value="Beli Langsung">
                    <div class="font-under d-flex justify-content-center mt-2">
                        <a class="text-decoration-none text-dark me-2" href=""><i class="bi-chat-left-text me-1"></i><b>Diskusi</b></a>
                        <span>|</span>
                        <a class="text-decoration-none text-dark mx-2" href=""><i class="bi-heart me-1"></i><b>Wishlist</b></a>
                        <span>|</span>
                        <a class="text-decoration-none text-dark ms-2" href=""><i class="bi-share-fill me-1"></i><b>Share</b></a>
                    </div>
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
                    <img src="\asset\profile.png" alt="">
                    <span class="mx-2">Yanto</span>
                </div>
            </div>
        </div>
    </div>
@endsection
