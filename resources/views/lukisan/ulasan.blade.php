@extends('Master')

@section('Page-Title')
    Beri Ulasan
@endsection

@section('Page-Contents')  
    @if ($cekUlasan == null)
        <form action="/buatUlasan/{{ $lukisan->id }}/{{ $transaksi->id }}" method="POST">
            @csrf
            <div class="container shadow-lg p-3 mb-5 mt-5 bg-body-tertiary rounded">
                <div class="row">
                    <div class="col-3">
                        <img src="{{ $lukisan->gambar_pertama }}" class="rounded" alt="{{ $lukisan->nama_lukisan }}"
                            width="300" height="300">

                    </div>
                    <div class="ps-5 col-9">
                        <h1 class="me-3">{{ $lukisan->nama_lukisan }}</h1>
                        <label class="">(oleh {{ $lukisan->user->username }} )</label>
                        <br>
                        <label class="col-form-label fw-bold">Berikan Ulasan</label>
                        <div class="star-rating">
                            <input type="radio" id="star5" name="rating" value="5">
                            <label for="star5"><i class="fas fa-star"></i></label>
                            <input type="radio" id="star4" name="rating" value="4">
                            <label for="star4"><i class="fas fa-star"></i></label>
                            <input type="radio" id="star3" name="rating" value="3">
                            <label for="star3"><i class="fas fa-star"></i></label>
                            <input type="radio" id="star2" name="rating" value="2">
                            <label for="star2"><i class="fas fa-star"></i></label>
                            <input type="radio" id="star1" name="rating" value="1">
                            <label for="star1"><i class="fas fa-star"></i></label>
                        </div>
                        <div class="form-floating mb-3 mt-5">
                            <textarea class="form-control" placeholder="Leave a comment here" id="ulasan" name="ulasan" style="height: 100px"></textarea>
                            <label for="floatingTextarea2">Berikan penilaianmu terhadap lukisan ini...</label>
                        </div>

                        <button type="submit" class="col-12 btn btn-success btn-sm">Kirim Ulasan</button>
                    </div>
                </div>
            </div>
        </form>
    @else
        <div class="container shadow-lg p-3 mb-5 mt-5 bg-body-tertiary rounded">
            <div class="row">
                <div class="col-3">
                    <img src="{{ $lukisan->gambar_pertama }}" class="rounded" alt="{{ $lukisan->nama_lukisan }}"
                        width="300" height="300">
                </div>
                <div class="ps-5 col-9">
                    <h1 class="me-3">{{ $lukisan->nama_lukisan }}</h1>
                    <label class="">(oleh {{ $lukisan->user->username }} )</label>
                    <br>
                    <div class="mt-5">
                        <label class="fs-4">Terimakasih karena sudah mengisi ulasan untuk lukisan di transaksi ini.</label>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
