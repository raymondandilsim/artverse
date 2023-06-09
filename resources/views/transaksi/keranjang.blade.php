@extends('Master')

@section('Page-Title')
    Keranjang
@endsection

@section('Page-Contents')
    @if (count($keranjang) == null)
        <div class="container px-3 my-5 clearfix p-5" style="height: fluid; overflow-y: auto;">
            <div class="card">
                <div class="card-header text-center">
                    <h2>Keranjang</h2>
                </div>
                <div class="card-body text-center">
                    <h4 class="m-5 text-danger">Maaf, belum ada lukisan yang ditambahkan.</h4>
                </div>
            </div>
        </div>
    @else
        <div class="container px-3 clearfix pb-5 mt-5 mb-5" style="height: fluid; overflow-y: auto;">
            <div class="card">
                <div class="card-header text-center">
                    <h2>Keranjang</h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered m-0">
                            <thead>
                                <tr class="text-start">
                                    <th class="text-start py-3 px-4" style="min-width: 100px;">Penjual/Seniman</th>
                                    <th class="text-start py-3 px-4" style="min-width: 400px;">Nama Produk</th>
                                    <th class="text-start py-3 px-4" style="width: 100px;">Harga</th>
                                    <th class="text-start py-3 px-4" style="width: 120px;">Jumlah</th>
                                    <th class="text-right py-3 px-4" style="width: 100px;">Total</th>
                                    <th class="text-center align-middle py-3 px-0" style="width: 40px;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($keranjang as $item)
                                    <tr>
                                        <td class="text-right font-weight-semibold align-middle p-4">
                                            {{ $item->lukisan->user->username }}
                                        </td>
                                        <td class="p-3">
                                            <a class="text-decoration-none text-dark"
                                                href="/detailLukisanMemberPage/{{ $item->lukisan->id }}">
                                                <img src="{{ $item->lukisan->gambar_pertama }}"
                                                    alt="{{ $item->lukisan->nama_lukisan }}" width="50" height="50"
                                                    class="me-3 rounded">{{ $item->lukisan->nama_lukisan }}
                                            </a>
                                        </td>
                                        @php
                                            $formatHarga = number_format($item->lukisan->harga, 0, '.', '.');
                                        @endphp
                                        <td class="text-right font-weight-semibold align-middle p-4">Rp{{ $formatHarga }}
                                        </td>
                                        <td class="align-middle p-4 text-center">{{ $item->kuantitas }}</td>
                                        @php
                                            $formatHarga = number_format($item->subtotal_produk, 0, '.', '.');
                                        @endphp
                                        <td class="text-right font-weight-semibold align-middle p-4">Rp{{ $formatHarga }}
                                        </td>
                                        <td class="text-center align-middle px-0">
                                            <button type="button" class="btn btn-danger btn-sm m-3" data-bs-toggle="modal"
                                                data-bs-target="#hapusModal{{ $item->id }}"><i
                                                    class="bi bi-x-octagon"></i></button>

                                            <!-- Modal Delete Confirmation-->
                                            <div class="modal fade" id="hapusModal{{ $item->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5">Hapus Lukisan di Keranjang
                                                            </h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body text-start">
                                                            <p>Apakah anda yakin ingin menghapus lukisan {{ $item->lukisan_id }} dari keranjang anda?
                                                            </p>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Batal</button>
                                                            <form action="/hapusItemKeranjang/{{ $item->id }}" method="POST"
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
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex row">
                        <div class="col-2 p-3 flex-grow-1">
                            <a href="/showLukisanSemua"><button type="button"
                                    class="btn btn-outline-dark md-btn-flat mt-2 mr-3">Kembali
                                    Belanja</button>
                            </a>
                        </div>
                        <div class="col-4 p-4 d-flex justify-content-center me-3">
                            {{ $keranjang->links('pagination::bootstrap-4') }}
                        </div>
                        @php
                            $totalHarga = 0;
                        @endphp
                        @foreach ($keranjang as $item)
                            @php
                                $totalHarga += $item->subtotal_produk;
                            @endphp
                        @endforeach
                        @php
                            $formatHarga = number_format($totalHarga, 0, '.', '.');
                        @endphp
                        <div class="col-5 justify-content-end pt-3 ps-5">
                            <form action="/checkoutKeranjangPage" method="GET">
                                <label class="font-weight-normal text-danger mt-3 ms-5 me-4 ps-2">Subtotal:
                                    Rp{{ $formatHarga }}</label>
                                <button type="submit" class="btn btn-dark ms-3">Checkout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    @endif
    <script>
        function hitungTotal(harga, qty, totalPrice) {
            var quantity = document.getElementById(qty).value;
            document.getElementById(totalPrice).value = harga * quantity;
            // document.getElementById('editQty').submit();
            console.log(harga);
        }
    </script>

@endsection
