@extends('Master')

@section('Page-Title')
    Lihat Semua Seniman
@endsection

@section('Page-Contents')
    <div class="container p-5">
        <h3><b>Lihat Semua Seniman</b></h3>
        <div class="row p-4">
            @forelse ($users as $user)
                <div class="col-4 my-2">
                    <div class="card shadow light-dark-bg border text-center">
                        <a href="/detailSenimanPage/{{ $user->id }}" class="text-decoration-none">
                            <img src="{{ $user->foto_profil }}" class="card-img-top" height="310px">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title">{{ $user->username }}</h5>
                        </div>
                    </div>
                </div>
            @empty
                <h5 class="text-center my-5 p-5">Belum ada seniman terdaftar</h5>
            @endforelse
        </div>
        <div class="d-flex justify-content-center flex=column mb-5">
            {{ $users->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
