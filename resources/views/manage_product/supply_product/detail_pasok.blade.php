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
    .total{
        color: #19d895;
        background-color: rgba(25, 216, 149, 0.2);
        border-radius: 5px;
        font-size: 16px;
        font-weight: bold;
        padding: 10px 20px;
    }
</style>
@endsection
@section('content')
<div class="row page-title-header">
  <div class="col-12">
    <div class="page-header d-flex justify-content-between align-items-center">
      <h4 class="page-title">Review Pasok</h4>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="card card-noborder b-radius">
      <div class="card-body">
        <form action="{{ route('edited_supply', $data->id) }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="form-group row top-min">
                        <label class="col-12 font-weight-bold col-form-label">Nota Pembelian</label>
                        <div class="col-12">
                            <input type="text" class="form-control input-notzero" value="{{$data->nota}}" @if ($data->status == 1) readonly @endif name="nota" placeholder="Masukkan Nota Pembelian">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
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
                </div>
            </div>
            <div class="row">
                <table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col">Barang</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Tempat Beli</th>
                        <th scope="col">Harga Beli</th>
                        <th scope="col">Subtotal</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>
                                    <select style="width: 250px" name="barang[]" id="product{{$loop->iteration}}" required @if ($data->status == 1) disabled @endif>
                                        <option value="">Pilih Barang</option>
                                        @foreach ($products as $value)
                                            <option value="{{$value->kode_barang}}" {{$value->kode_barang == $item->kode_barang ? 'selected' : ''}}>{{$value->nama_barang}} - {{$value->merek}} {{$value->berat_barang}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="text" value="{{$item->jumlah}}" name="jumlah[]" class="form-control"  id="jumlah" required @if ($data->status == 1) readonly @endif>
                                </td>
                                <td>
                                    <input type="text" value="{{$item->tempat_beli}}" name="tempat_beli[]" class="form-control" required @if ($data->status == 1) readonly @endif>
                                </td>
                                <td>
                                    <input type="text" value="Rp {{number_format($item->harga_beli, 0, ",", ".")}}" name="beli[]" class="form-control" id="harga"  required @if ($data->status == 1) readonly @endif>
                                </td>
                                <td>
                                    <input type="text" value="Rp {{number_format($item->subtotal, 0, ",", ".")}}" name="subtotal[]" class="form-control" id="subtotal" readonly>
                                </td>
                            </tr> 
                        @endforeach 
                    </tbody>
                  </table>
                  <div class="d-flex w-100 justify-content-end px-3 pt-3">
                    <div class="total text-center">
                        Total : Rp {{$total_subtotal}}
                    </div>  
                  </div>
            </div>
            <div class="row">
                <div class="col-12 d-flex justify-content-end mg-top">
                    @if ($data->status == 0)
                        <button class="btn btn-simpan btn-sm margin" type="submit" name="create" value="create"><i class="mdi mdi-content-save"></i> Create</button>
                        <button class="btn btn-simpan btn-sm" type="submit" name="fullfill" value="fullfill"><i class="mdi mdi-content-save"></i> Fullfill</button>
                    @else
                        <a href="/supply" type="button" class="btn btn-simpan btn-sm"><i class="bi bi-arrow-bar-left"></i> Back</a>
                    @endif
                </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
</script>
@endsection