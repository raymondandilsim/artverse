@extends('Master')

@section('Page-Title')
    Daftar Semua Akun
@endsection

@section('Page-Contents')
    <div class="mb-5 pb-5">
        <div class="mt-5 mb-5 d-flex justify-content-center">
            <h3 class=""><b>Daftar Semua Akun</b></h3>
        </div>

        <div class="d-flex bg-daftar justify-content-center align-items-start">
            <div class="card-unggah-lukisan bg-white px-5 py-5 mb-5 rounded-3 shadow-lg">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Username</th>
                            <th scope="col">Email</th>
                            <th scope="col">Nomor Telepon</th>
                            <th class="text-center align-middle py-3 px-0" style="width: 40px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <th scope="row" class="pt-3">{{ $user->id }}</th>
                                <td><a class="text-decoration-none text-dark" href="">
                                        <img src="{{ $user->foto_profil }}" alt="" width="50" height="50"
                                            class="me-3 rounded">{{ $user->username }}</a></td>

                                <td class="pt-3">{{ $user->email }}</td>
                                <td class="pt-3">{{ $user->nomor_telepon }}</td>

                                <td class="text-center align-middle px-0">
                                    <button type="button" class="btn btn-danger btn-sm m-3" data-bs-toggle="modal"
                                        data-bs-target="#hapusModal{{ $user->id }}"><i
                                            class="bi bi-x-octagon"></i></button>

                                    <!-- Modal Delete Confirmation-->
                                    <div class="modal fade" id="hapusModal{{ $user->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5">Hapus Akun
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-start">
                                                    <p>Apakah anda yakin ingin menghapus akun {{ $user->id }}?</p>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <form action="/hapusAkun/{{ $user->id }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="Submit" class="btn btn-danger">Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                
            </div>
        </div>
        <div class="d-flex justify-content-center flex=column mb-5">
            {{ $users->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
