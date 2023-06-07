@extends('Master')

@section('Page-Title')
    Ulasan - {{ $lukisan->nama_lukisan }}
@endsection

@section('Page-Contents')
    <div class="container shadow-lg p-3 mb-5 mt-5 bg-body-tertiary rounded" style="height: fluid; overflow-y: auto;">
        <div class="row ps-4 pe-4">
            <div class="col-1">
                <img src="{{ $lukisan->gambar_pertama }}" class="rounded" alt="{{ $lukisan->nama_lukisan }}" width="100"
                    height="100">
            </div>
            <div class="ps-5 col-9 mb-4">
                <h3 class="me-3">{{ $lukisan->nama_lukisan }}</h3>
                <label class="">(oleh {{ $lukisan->user->username }} )</label> <br>
                <label class="mt-2"><i class="fas fa-star text-warning "></i></label>
                <label for="">{{ $totalBintang }}/5.0</label>
            </div>

            @foreach ($ulasans as $ulasan)
                <div class="shadow-lg p-3 mt-3 bg-body-tertiary rounded">
                    <div class="">
                        <img src="{{ $ulasan->user->foto_profil }}" class="rounded" alt="" width="30"
                            height="30">
                        <label class="fw-bold ms-3">{{ $ulasan->user->username }}</label>
                    </div>
                    <div class="mt-2">
                        <div class="rating">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $ulasan->bintang)
                                    <label for="star5"><i class="fas fa-star text-warning "></i></label>
                                @else
                                    <label for="star5"><i class="fas fa-star-fill"></i></label>
                                @endif
                            @endfor
                        </div>
                        <div class="mt-2">
                            {{ $ulasan->isi_ulasan }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center mb-5 mt-5">
            {{ $ulasans->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
