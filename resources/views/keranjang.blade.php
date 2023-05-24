@extends('Master')

@section('Page-Title')
    Keranjang
@endsection

@section('Page-Contents')
<div class="container px-3 my-5 clearfix p-5">
    <div class="card">
        <div class="card-header">
            <h2>Keranjang</h2>
        </div>
        <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered m-0">
                <thead>
                  <tr>
                    <th class="text-center py-3 px-4" style="min-width: 400px;">Nama Produk</th>
                    <th class="text-right py-3 px-4" style="width: 100px;">Harga</th>
                    <th class="text-center py-3 px-4" style="width: 120px;">Jumlah</th>
                    <th class="text-right py-3 px-4" style="width: 100px;">Total</th>
                    <th class="text-center align-middle py-3 px-0" style="width: 40px;"><a href="#" class="shop-tooltip float-none text-light" title="" data-original-title="Clear cart"><i class="ino ion-md-trash"></i></a></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="p-4">
                      <div class="media align-items-center">
                        <div class="row">
                            <div class="col-md-auto">
                                <img src="data:image/jpeg;base64,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" class="img-thumbnail" width="70px" alt="">
                            </div>
                            <div class="col-md-auto">
                                <a href="#" class="d-block text-dark">Lukisan 1</a>
                            </div>
                        </div>
                        
                        
                      </div>
                    </td>
                    <td class="text-right font-weight-semibold align-middle p-4">Rp200.000</td>
                    <td class="align-middle p-4"><input type="text" class="form-control text-center" value="2"></td>
                    <td class="text-right font-weight-semibold align-middle p-4">Rp400.000</td>
                    <td class="text-center align-middle px-0"><a href="#" class="shop-tooltip close float-none text-danger" title="" data-original-title="Remove">×</a></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="d-flex flex-wrap justify-content-between align-items-center pb-4">
              <div class="d-flex">
                <div class="text-right mt-4">
                  <label class="text-muted font-weight-normal m-0">Total price</label>
                  <div class="text-large"><strong>Rp400.000</strong></div>
                </div>
              </div>
            </div>
            <div class="float-right">
              <button type="button" class="btn btn-lg btn-outline-dark md-btn-flat mt-2 mr-3">Kembali Belanja</button>
              <button type="button" class="btn btn-lg btn-dark mt-2">Checkout</button>
            </div>
          </div>
      </div>
  </div>
@endsection
