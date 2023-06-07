<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - ArtVerse</title>
    <link rel="shortcut icon" href="\asset\icon artverse.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
<section class="d-flex bg-daftar bg-secondary justify-content-center align-items-center p-5">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card shadow" style="border-radius: 1rem;">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              <img src="../asset/logo-register.png"
                alt="register form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

                <form action="/daftar" method="POST">

                  <div class="d-flex align-items-center mb-3 pb-1">
                    <span class="h1 fw-bold mb-0">DAFTAR</span>
                  </div>

                  @csrf
                <div>
                    <div>
                        <label for="Nama" class="form-label">Nama <label class="text-danger">*</label></label>
                    </div>
                    <div>
                        <input class="form-control" type="text" id="nama" name="nama"
                            value="{{ old('nama') }}" placeholder="Masukkan nama anda">
                    </div>
                    <div>
                        <label for="Username" class="form-label">Nama Pengguna <label
                                class="text-danger">*</label></label>
                    </div>
                    <div>
                        <input class="form-control" type="text" id="username" name="username"
                            value="{{ old('username') }}" placeholder="Masukkan nama pengguna">
                    </div>
                    <div>
                        <label for="Email" class="form-label">Email <label class="text-danger">*</label></label>
                    </div>
                    <div>
                        <input class="form-control" type="Email" id="email" name="email"
                            value="{{ old('email') }}" placeholder="Masukkan email anda">
                    </div>
                    <div>
                        <label for="Nomor Telepon" class="form-label">Nomor Telepon <label
                                class="text-danger">*</label></label>
                    </div>
                    <div>
                        <input class="form-control" type="text" id="nomor_telepon" name="nomor_telepon"
                            value="{{ old('nomor_telepon') }}" placeholder="Masukkan nomor telepon">
                    </div>
                    <div>
                        <label for="Nama Provinsi" class="form-label">Nama Provinsi <label
                                class="text-danger">*</label></label>
                    </div>
                    <div>
                        {{-- <input class="form-control" type="text" id="nama_provinsi" name="nama_provinsi" value="{{ old('nama_provinsi') }}" placeholder="Masukkan nama provinsi"> --}}
                        <select name="provinsi" id="provinsi" class="form-select">
                            <option value="">Pilih Provinsi</option>
                            @foreach ($provinsis as $provinsi)
                                <option value="{{ $provinsi->id }}">{{ $provinsi->provinsi }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="Nama Kota" class="form-label">Nama Kota <label class="text-danger">*</label></label>
                    </div>
                    <div>
                        {{-- <input class="form-control" type="text" id="nama_kota" name="nama_kota"
                            value="{{ old('nama_kota') }}" placeholder="Masukkan nama kota"> --}}

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
                                                        // $('#provinsi').append('<input type="text" id="nama_provinsi" name="nama_provinsi" value="' + value
                                                        //  .province + '">');
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
                        <label for="Nama Jalan" class="form-label">Nama Jalan <label
                                class="text-danger">*</label></label>
                    </div>
                    <div>
                        <input class="form-control" type="text" id="nama_jalan" name="nama_jalan"
                            value="{{ old('nama_jalan') }}" placeholder="Masukkan Jalan, Kecamatan, dan Kelurahan">
                    </div>
                    <div>
                        <label for="Kode Pos" class="form-label">Kode Pos <label class="text-danger">*</label></label>
                    </div>
                    <div>
                        <input class="form-control" type="text" id="kode_pos" maxlength="5" name="kode_pos"
                            value="{{ old('kode_pos') }}" placeholder="Masukkan kode pos">
                    </div>
                    <div>
                        <label for="Kata Sandi" class="form-label">Kata Sandi <label
                                class="text-danger">*</label></label>
                    </div>
                    <div>
                        <input class="form-control" type="password" id="password" name="password"
                            placeholder="Masukkan kata sandi">
                    </div>
                    <div>
                        <label for="Masukkan Sandi Ulang" class="form-label">Masukkan Sandi Ulang <label
                                class="text-danger">*</label></label>
                    </div>
                    <div>
                        <input class="form-control" type="password" id="confirm_password" name="confirm_password"
                            placeholder="Masukkan ulang kata sandi">
                    </div>
                    @if ($errors->any())
                        {{-- <tr>
                            <td colspan="2" class="px-5 py-2"> --}}
                        <div class="alert alert-danger alert-dismissible fade show fixed-top m-5" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                        {{-- </td>
                        </tr> --}}
                    @endif
                    <br><label><label class="text-danger">*</label> Wajib diisi</label>
                    <input class="btn btn-dark form-control mt-4" type="submit" value="Daftar">
                    <h6 class="mt-2">Sudah punya akun? <a class="text-decoration-none" href="/loginPage">Masuk</a></h6>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>

</html>
