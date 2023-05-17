@extends('Master')

@section('Page-Title')
    Profil - {{ $user->username }}
@endsection

@section('Page-Contents')
    <div class="bg-isi d-flex align-items-center p-5">
        <button class="btn-secondary border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
            aria-controls="offcanvasExample"><i class="bi bi-caret-right-fill"></i>
        </button>
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header">
                <img src="{{ $user->foto_profil }}" alt="Profile Picture" class="img-fluid" width="80" height="80">
                <h5>{{ $user->nama }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="p-3 ms-4 mt-3">
                <div>
                    <a class="text-decoration-none text-dark" href=""><i
                            class="bi-chat-left-text me-4"></i><b>Obrolan</b></a>
                </div>
                <div class="my-4">
                    <a class="text-decoration-none text-dark" href=""><i
                            class="bi bi-chat-left-quote me-4"></i><b>Diskusi</b></a>
                </div>
                <div class="my-4">
                    <a class="dropdown-toggle link-dark text-decoration-none" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-archive me-4"></i><b>Product</b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Tambah Produk</a></li>
                        <li><a class="dropdown-item" href="#">Daftar Produk</a></li>
                    </ul>
                </div>
                <div class="my-4">
                    <a class="text-decoration-none text-dark" href=""><i
                            class="bi bi-bag-check me-4"></i><b>Pesanan</b></a>
                </div>
            </div>
            <form action="/ubahPeran/{{ $user->id }}" method="POST">
                @csrf
                <div class="d-flex justify-content-center">
                    <input class="btn-jadi-member text-white mt-3" type="submit" value="Jadi Member">
                </div>
            </form>
        </div>
        <div class="bg-light ">
            <h5>Chat</h5>
        </div>
    </div>
    @endsection
