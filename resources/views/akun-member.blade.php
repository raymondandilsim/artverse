@extends('Master')

@section('Page-Title')
    admin
@endsection

@section('Page-Contents')
<div class="container px-3 my-5 clearfix">
    <div class="card">
        <div class="card-header">
            <h2>Akun Member</h2>
        </div>
        <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered m-0">
                <thead>
                    <tr>
                        <th class="text-right py-3 px-4" style="width: 180px;">Nama</th>
                        <th class="text-right py-3 px-4" style="width: 180px;">Nama Pengguna</th>
                        <th class="text-right py-3 px-4" style="width: 180px;">Email</th>
                        <th class="text-right py-3 px-4" style="width: 180px;">Nomor HP</th>
                        <th class="text-right py-3 px-4" style="width: 180px;">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-right font-weight-semibold align-middle p-4">steven</td>
                        <td class="text-right font-weight-semibold align-middle p-4">ste123</td>
                        <td class="text-right font-weight-semibold align-middle p-4">stev.gmail.com</td>
                        <td class="text-right font-weight-semibold align-middle p-4">083349625397</td>
                        <td class="text-right font-weight-semibold align-middle p-4"><a href="">View</a></td>
                    </tr>
                </tbody>
              </table>
            </div>
      </div>
  </div>
@endsection
