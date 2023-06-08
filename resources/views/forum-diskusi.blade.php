@extends('Master')

@section('Page-Title')
    Diskusi
@endsection

@section('Page-Contents')
    <div class="p-5">
        <h1 class="mb-4"><b>Diskusi Lukisan {{ $lukisan->nama_lukisan }}</b></h1>
        <div class="card-footer py-3 border-0">
            <div class="d-flex">
                <div class="profil me-3">
                    <img src="{{ auth()->user()->foto_profil }}" alt="Profile Picture" class="img-fluid">
                </div>
                <form action="/diskusi" method="POST">
                    @csrf
                    <div>
                        <h5>{{ auth()->user()->username }}</h5>
                        <input type="text" hidden name="lukisan_id" id="lukisan_id" value="{{ $lukisan->id }}">
                        <textarea class="diskusi-form" id="text" name="text" placeholder="Masukkan diskusi anda..."></textarea>
                    </div>
            </div>
            <div class="d-flex justify-content-end mt-3">
                <input type="submit" class="btn btn-primary btn-sm" value="Kirim">
            </div>
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show fixed-top m-5" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            </form>
        </div>
        @forelse ($diskusis as $diskusi)
            @if ($diskusi->diskusi_id == null)
                <div class="shadow-lg p-3 mb-5 mt-5 bg-body-tertiary rounded">
                    <div class="bubble-chat p-3 mt-4">
                        <div class="d-flex mb-4">
                            <div class="profil me-3">
                                <img src="{{ $diskusi->user->foto_profil }}" alt="Profile Picture" class="img-fluid">
                            </div>
                            <div>
                                <div>
                                    <h5>{{ $diskusi->user->username }}</h5>
                                </div>
                                <div>
                                    <label>{{ $diskusi->text }}</label>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="reply-diskusi rounded">
                            <h6 class="p-3">Balasan</h6>
                            @foreach ($diskusi->replies as $reply)
                                <div class="">
                                    <div class="d-flex ms-5 mb-4">
                                        <div class="profil me-3">
                                            <img src="{{ $reply->user->foto_profil }}" alt="Profile Picture"
                                                class="img-fluid">
                                        </div>
                                        <div>
                                            <div>
                                                <h5>{{ $reply->user->username }}</h5>
                                            </div>
                                            <div>
                                                <label>{{ $reply->text }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="card-footer py-3 mt-3">
                                <div class="d-flex ">
                                    <div class="profil me-3">
                                        <img src="{{ auth()->user()->foto_profil }}" alt="Profile Picture"
                                            class="img-fluid">
                                    </div>
                                    <form action="/diskusi/{{ $diskusi->id }}" method="POST">
                                        @csrf
                                        <div>
                                            <h5>{{ auth()->user()->username }}</h5>
                                            <input type="text" hidden name="lukisan_id" id="lukisan_id"
                                                value="{{ $lukisan->id }}">
                                            <textarea class="diskusi-form form-control" id="reply" name="reply" placeholder="Masukkan jawaban anda..."></textarea>
                                        </div>
                                </div>
                                <div class="d-flex justify-content-end mt-3">
                                    <input type="submit" class="btn btn-primary btn-sm" value="Unggah Balasan">
                                </div>
                                </form>
                                @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show fixed-top m-5"
                                        role="alert">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @empty
            <h5 class="text-center my-5 p-5">Belum terdapat diskusi pada lukisan ini</h5>
        @endforelse
        <div class="d-flex justify-content-end flex=column mb-5">
            {{ $diskusis->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
