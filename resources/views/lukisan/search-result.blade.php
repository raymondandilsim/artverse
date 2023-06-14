@extends('Master')

@section('Page-Title')
    Lihat Semua
@endsection

@section('Page-Contents')
    <div class="container p-5">
        <h3><b>Hasil Pencarian</b></h3>
        <div class="row p-4">
            @forelse ($lukisans as $lukisan)
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
            @empty
                <h5 class="text-center my-5 p-5">Hasil tidak ditemukan</h5>
            @endforelse
        </div>
        <div class="d-flex justify-content-center flex=column mb-5">
            {{ $lukisans->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
