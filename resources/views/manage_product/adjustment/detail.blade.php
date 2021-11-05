@extends('templates/main')
@section('css')
<link rel="stylesheet" href="{{ asset('css/manage_product/supply_product/new_supply/style.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
  .btn-simpan{
    background-color: #2449f0;
    color: #ffff;
  }
  #kode{
    width: 285px;
  }
  .margin{
		margin-right: 5px;
	}
    .mg-top{
        margin-top: 10px;
    }
</style>
@endsection
@section('content')
<div class="row page-title-header">
  <div class="col-12">
    <div class="page-header d-flex justify-content-between align-items-center">
      <h4 class="page-title">Review Adjustment</h4>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="card card-noborder b-radius">
      <div class="card-body">
        {{-- <form action="{{ route('edited_supply', $data->id) }}" method="POST"> --}}
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="form-group row top-min">
                        <label class="col-12 font-weight-bold col-form-label">ID Adjustment</label>
                        <div class="col-12">
                            <input type="text" class="form-control input-notzero" value="{{$adjustment->id_adjustment}}" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group row top-min">
                        <label class="col-12 font-weight-bold col-form-label">Tanggal Adjustment</label>
                        <div class="col-12">
                            <input type="text" class="form-control input-notzero" value="{{$adjustment->created_at}}" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                {{-- <div class="col-6">
                    <div class="form-group row top-min">
                        <label class="col-12 font-weight-bold col-form-label">Supplier</label>
                        <div class="col-12">
                            <select name="supplier" class="form-control" id="supplier" @if ($data->status == 1) disabled @endif>
                                <option value="">Pilih Supplier</option>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{$supplier->id}}" {{$supplier->id == $data->suppliers_id ? 'selected' : ''}}>{{$supplier->perusahaan}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group row top-min">
                        <label class="col-12 font-weight-bold col-form-label"><b>Tanggal</b></label>
                        <div class="col-12">
                            <div class="input-group">
                                <input type="date" class="form-control" name="date" value="{{$data->date}}" @if ($data->status == 1) readonly @endif required>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
            <div class="row">
                <table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col">Kode Barang</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">In-Stock</th>
                        <th scope="col">Actual Stock</th>
                        <th scope="col">Stock Difference</th>
                        <th scope="col">Nominal</th>
                        <th scope="col">Note</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($adjustment->adjustment_details as $item)
                            <tr>
                                <td>
                                  <input type="text" value="{{$item->kode_barang}}" class="form-control" readonly>
                                </td>
                                <td>
                                  <input type="text" value="{{$item->product->nama_barang.' '.$item->product->berat_barang}}" class="form-control" readonly>
                                </td>
                                <td>
                                  <input type="text" value="{{$item->in_stock}}" class="form-control" readonly>
                                </td>
                                <td>
                                  <input type="text" value="{{$item->actual_stock}}" class="form-control" readonly>
                                </td>
                                <td>
                                  <input type="text" value="{{$item->stock_difference}}" class="form-control" readonly>
                                </td>
                                <td>
                                  <input type="text" value="{{$item->nominal}}" class="form-control" readonly>
                                </td>
                                <td>
                                  <input type="text" value="{{$item->note}}" class="form-control" readonly>
                                </td>
                            </tr> 
                        @endforeach
                    </tbody>
                  </table>
            </div>
            <div class="row">
                <div class="col-12 d-flex justify-content-end mg-top">
                  <a href="/adjustment" type="button" class="btn btn-simpan btn-sm"><i class="bi bi-arrow-bar-left"></i> Back</a>
                </div>
            </div>
        {{-- </form> --}}
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
{{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('js/manage_product/supply_product/supply/script.js') }}"></script>
<script>
    $(document).ready(function() {
        var total = {{$total}};
        for (let products = 1; products <= total; products++) {
            $('#product'+ [products]).select2();
        }
    });
</script>
<script type="text/javascript">
  @if ($message = Session::get('create_success'))
    swal(
        "Berhasil!",
        "{{ $message }}",
        "success"
    );
  @endif

  @if ($message = Session::get('import_success'))
    swal(
        "Berhasil!",
        "{{ $message }}",
        "success"
    );
  @endif
</script> --}}
@endsection