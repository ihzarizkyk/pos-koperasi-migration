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
      <h4 class="page-title">Review Shift</h4>
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
                            <input type="text" class="form-control input-notzero" value="#"  name="nota" placeholder="Masukkan Nota Pembelian">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group row top-min">
                        <label class="col-12 font-weight-bold col-form-label">Supplier</label>
                        <div class="col-12">
                            <select name="supplier" class="form-control" id="supplier" >
                                <option value="">Pilih Supplier</option>
                                
                                    <option value="" ></option>
                                
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
                        <th scope="col">Nama</th>
                        <th scope="col">Outlet</th>
                        <th scope="col">Starting Shift</th>
                        <th scope="col">Expense/Income</th>
                        <th scope="col">Sold Items</th>
                        <th scope="col">Refunced Items</th>
                        <th scope="col">End Shift</th>
                      </tr>
                    </thead>
                    <tbody>
                        
                            <tr>
                                <td>
                                    <select style="width: 250px" name="barang[]" id="" required >
                                                                               
                                            <option value="#"> </option>
                                        
                                    </select>
                                </td>
                                <td>
                                    <input type="text" value="#" name="jumlah[]" class="form-control"  id="jumlah" required>
                                </td>
                                <td>
                                    <input type="text" value="#" name="tempat_beli[]" class="form-control" required >
                                </td>
                                <td>
                                    <input type="text" value="#" name="beli[]" class="form-control" id="harga"  required >
                                </td>
                                <td>
                                    <input type="text" value="#" name="subtotal[]" class="form-control" id="subtotal" readonly>
                                </td>
                            </tr> 
                    
                    </tbody>
                  </table>
            </div>
            <div class="row">
                <div class="col-12 d-flex justify-content-end mg-top">
                    
                        <input type="submit" name="simpan" class="btn btn-simpan btn-sm" value="simpan">
                    
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