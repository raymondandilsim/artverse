@extends('Master')

@section('Page-Title')
    Lihat Semua Lukisan
@endsection

@section('Page-Contents')
    <div class="container p-5">
        <h3><b>Lihat Semua Lukisan</b></h3>
        <div class="row p-4">
            @forelse ($lukisans as $lukisan)
                @if ($lukisan->user->flag == 1)
                    <div class="col-4 my-4">
                        <div class="card shadow light-dark-bg border text-center">
                            <a href="/detailLukisanMemberPage/{{ $lukisan->id }}" class="text-decoration-none">
                                <img src="{{ $lukisan->gambar_pertama }}" class="card-img-top" height="310px">
                            </a>
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
