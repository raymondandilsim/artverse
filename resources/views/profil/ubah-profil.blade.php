@extends('Master')

@section('Page-Title')
    Profil - {{ $user->username }}
@endsection

@section('Page-Contents')
    <div class="d-flex bg-daftar bg-secondary justify-content-center align-items-center p-5">
        <div class="card-daftar bg-white px-5 py-5 rounded-3 shadow">
            <h2 class="text-center"><b>Perbarui Profil</b></h2>
            <form action="/ubahProfil/{{ $user->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div>
                    <div>
                        <label for="Nama" class="form-label mt-3">Nama <label class="text-danger">*</label></label>
                    </div>
                    <div>
                        <input class="form-control" type="text" id="nama" name="nama"
                            value="{{ $user->nama }}" placeholder="Masukkan nama anda">
                    </div>
                    <div>
                        <label for="Username" class="form-label mt-3">Nama Pengguna <label
                                class="text-danger">*</label></label>
                    </div>
                    <div>
                        <input class="form-control" type="text" id="username" name="username"
                            value="{{ $user->username }}" placeholder="Masukkan nama pengguna">
                    </div>
                    <div>
                        <label for="Email" class="form-label mt-3">Email <label class="text-danger">*</label></label>
                    </div>
                    <div>
                        <input class="form-control" type="Email" id="email" name="email"
                            value="{{ $user->email }}" placeholder="Masukkan email anda">
                    </div>
                    <div>
                        <label for="Nomor Telepon" class="form-label mt-3">Nomor Telepon <label
                                class="text-danger">*</label></label>
                    </div>
                    <div>
                        <input class="form-control" type="text" id="nomor_telepon" name="nomor_telepon"
                            value="{{ $user->nomor_telepon }}" placeholder="Masukkan nomor telepon">
                    </div>
                    <div>
                        <label for="Nama Provinsi" class="form-label mt-3">Nama Provinsi <label
                                class="text-danger">*</label></label>
                    </div>
                    <div>
                        <select name="provinsi" id="provinsi" class="form-select">
                            <option value="">Pilih Provinsi</option>
                            @foreach ($provinsis as $provinsi)
                                <option value="{{ $provinsi->id }}">{{ $provinsi->provinsi }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="Nama Kota" class="form-label mt-3">Nama Kota <label class="text-danger">*</label></label>
                    </div>
                    <div>
                        
                        <select name="kota" id="kota" class="form-select">
                            <option value="">Pilih Kota</option>
                        </select>

                        <script>
                            $(document).ready(function() {
                                $('#provinsi').on('change', function() {
                                    var provinceId = $(this).val();
                                    if (provinceId) {
                                        $.ajax({
                                            url: '/get-cities/' + provinceId,
                                            type: 'GET',
                                            dataType: "json",
                                            success: function(response) {
                                                $('#kota').empty();
                                                $.each(response, function(key, value) {
                                                    $('#kota').append('<option value="' + key + '">' + value +
                                                        '</option>');
                                                });
                                            }
                                        });
                                    } else {
                                        $('#kota').empty();
                                    }
                                });
                            });
                        </script>
                    </div>
                    <div>
                        <label for="Nama Jalan" class="form-label mt-3">Nama Jalan <label
                                class="text-danger">*</label></label>
                    </div>
                    <div>
                        <input class="form-control" type="text" id="nama_jalan" name="nama_jalan"
                            value="{{ $user->nama_jalan }}" placeholder="Masukkan Jalan, Kecamatan, dan Kelurahan">
                    </div>
                    <div>
                        <label for="Kode Pos" class="form-label mt-3">Kode Pos <label class="text-danger">*</label></label>
                    </div>
                    <div>
                        <input class="form-control" type="text" id="kode_pos" maxlength="5" name="kode_pos"
                            value="{{ $user->kode_pos }}" placeholder="Masukkan kode pos">
                    </div>
                    <div>
                        <label for="nama_bank" class="form-label">Nama Bank <label class="text-danger">*</label><label class="text-danger peringatan"> Mohon diisi jika anda ingin menjadi Penjual</label></label>
                    </div>
                    <div>
                        <input class="form-control" type="text" id="nama_bank" maxlength="5" name="nama_bank"
                            value="{{ $user->nama_bank }}" placeholder="Masukkan nama bank yang benar">
                    </div>
                    <div>
                        <label for="nomor_rekening" class="form-label">Nomor Rekening <label class="text-danger">*</label><label class="text-danger peringatan"> Mohon diisi jika anda ingin menjadi Penjual</label></label>
                    </div>
                    <div>
                        <input class="form-control" type="text" id="nomor_rekening" name="nomor_rekening"
                            value="{{ $user->nomor_rekening }}" placeholder="Masukkan nomor rekening anda yang benar">
                    <div>
                        <label for="Kata Sandi" class="form-label mt-3">Kata Sandi <label
                                class="text-danger">*</label></label>
                    </div>
                    <div>
                        <input class="form-control" type="password" id="password" name="password"
                            placeholder="Masukkan kata sandi">
                    </div>
                    <div>
                        <label for="Masukkan Sandi Ulang" class="form-label mt-3">Masukkan Sandi Ulang <label
                                class="text-danger">*</label></label>
                    </div>
                    <div>
                        <input class="form-control" type="password" id="confirm_password" name="confirm_password"
                            placeholder="Masukkan ulang kata sandi">
                    </div>
                    <div class="mb-3">
                            <label for="fotoProfil" class="form-label mt-3">Foto Profil</label>
                            <br><img class="mt-1 mb-3 rounded" src="{{ $user->foto_profil }}" alt="Foto Profil belum terdaftar" width="100">
                            <input class="form-control mb-1" type="file" id="fotoProfil" name="fotoProfil">
                        </div>

        
                    <br><label><label class="text-danger">*</label> Wajib diisi</label>
                    <input class="btn btn-secondary form-control mt-4 mb-5" type="submit" value="Perbarui">
                </div>
            </form>
        </div>
    </div>
@endsection