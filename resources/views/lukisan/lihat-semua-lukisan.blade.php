@extends('Master')

@section('Page-Title')
    Lihat Semua Lukisan
@endsection

@section('Page-Contents')
    <div class="container p-5">
        <div class="d-flex justify-content-between">
            <div class="ms-4">
                <h3><b>Lihat Semua Lukisan</b></h3>
            </div>
            <div class="pe-4">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Kategori
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                ...
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row p-4">
            @forelse ($lukisans as $lukisan)
                @if ($lukisan->user->flag == 1 && $lukisan->flag == 0)
                    <div class="col-4 my-4">
                        <div class="card shadow light-dark-bg border text-center">
                            @if (Auth::check() && Auth::user()->role_id === 1)
                                <a href="/detailLukisanAdminPage/{{ $lukisan->id }}" class="text-decoration-none">
                                    <img src="{{ $lukisan->gambar_pertama }}" class="card-img-top" height="310px">
                                </a>
                            @elseif (Auth::check() && Auth::user()->role_id === 2)
                                <a href="/detailLukisanMemberPage/{{ $lukisan->id }}" class="text-decoration-none">
                                    <img src="{{ $lukisan->gambar_pertama }}" class="card-img-top" height="310px">
                                </a>
                            @else
                                @guest
                                    <a href="/detailLukisanMemberPage/{{ $lukisan->id }}" class="text-decoration-none">
                                        <img src="{{ $lukisan->gambar_pertama }}" class="card-img-top" height="310px">
                                    </a>
                                @endguest
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $lukisan->nama_lukisan }}</h5>
                                <h5 class="card-title mb-3">Rp @php echo number_format($lukisan->harga, 0, ',', '.')@endphp</h5>
                            </div>
                        </div>
                    </div>
                @endif
            @empty
                <h5 class="text-center my-5 p-5">Belum ada lukisan terdaftar</h5>
            @endforelse
        </div>
        <div class="d-flex justify-content-center flex=column mb-5">
            {{ $lukisans->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
