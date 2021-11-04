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
        <form action="{{ route('shift.end', $data->id) }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="form-group row top-min">
                        <label class="col-12 font-weight-bold col-form-label">Modal Awal</label>
                        <div class="col-12">
                          <input type="text" id="modal" class="form-control input-notzero" value="{{number_format($data->modal,0,',','.')}}" name="modal" placeholder="Masukkan Modal Awal" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                  <div class="form-group row top-min">
                      <label class="col-12 font-weight-bold col-form-label">Barang Terjual</label>
                      <div class="col-12">
                          <input type="text" class="form-control input-notzero" value="{{$items}}" name="sold" readonly>
                      </div>
                  </div>
              </div>
              <div class="col-6">
                <div class="form-group row top-min">
                    <label class="col-12 font-weight-bold col-form-label">Total Expected</label>
                    @php
                        $expected = $data->modal + $cash;
                    @endphp
                    <div class="col-12">
                        <input type="text" class="form-control input-notzero" value="{{number_format($expected,0,',','.')}}" name="total" readonly>
                    </div>
                </div>
            </div>
            </div>
            <div class="row">
              <div class="col-6">
                  <div class="form-group row top-min">
                      <label class="col-12 font-weight-bold col-form-label"><b>Tanggal dan Waktu Mulai</b></label>
                      <div class="col-12">
                          <div class="input-group">
                              <input type="text" class="form-control" name="start" value="{{ $data->mulai }}" readonly>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-6">
                  <div class="form-group row top-min">
                      <label class="col-12 font-weight-bold col-form-label"><b>Tanggal dan Waktu Selesai</b></label>
                      <div class="col-12">
                          <div class="input-group">
                              <input type="text" class="form-control" name="selesai" value="{{ date('Y-m-d H:i:s') }}" readonly>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
            <h4>Detail Pembayaran:</h4>
            <div class="row">
              <div class="col-4">
                <div class="form-group row top-min">
                  <label class="col-12 font-weight-bold col-form-label">Cash</label>
                  <div class="col-12">
                      <input type="text" class="form-control input-notzero" name="cash" value="{{number_format($cash,0,',','.')}}"  readonly>
                  </div>
                </div>
              </div>
              <div class="col-4">
                <div class="form-group row top-min">
                  <label class="col-12 font-weight-bold col-form-label">Transfer</label>
                  <div class="col-12">
                      <input type="text" class="form-control input-notzero" name="tf" value="{{number_format($tf,0,',','.')}}"  readonly>
                  </div>
                </div>
              </div>
              <div class="col-4">
                <div class="form-group row top-min">
                  <label class="col-12 font-weight-bold col-form-label">Qris</label>
                  <div class="col-12">
                      <input type="text" class="form-control input-notzero" name="qris" value="{{number_format($qris,0,',','.')}}"  readonly>
                  </div>
                </div>
              </div>
              <div class="col-4">
                <div class="form-group row top-min">
                  <label class="col-12 font-weight-bold col-form-label">Ovo</label>
                  <div class="col-12">
                      <input type="text" class="form-control input-notzero" name="ovo" value="{{number_format($ovo,0,',','.')}}"  readonly>
                  </div>
                </div>
              </div>
              <div class="col-4">
                <div class="form-group row top-min">
                  <label class="col-12 font-weight-bold col-form-label">Gopay</label>
                  <div class="col-12">
                      <input type="text" class="form-control input-notzero" name="gopay" value="{{number_format($gopay,0,',','.')}}"  readonly>
                  </div>
                </div>
              </div>
              <div class="col-4">
                <div class="form-group row top-min">
                  <label class="col-12 font-weight-bold col-form-label">Invoice</label>
                  <div class="col-12">
                      <input type="text" class="form-control input-notzero" name="hutang" value="{{number_format($hutang,0,',','.')}}"  readonly>
                  </div>
                </div>
              </div>
              <input type="text" hidden name="total" value="{{$total}}">
            </div>
            <div class="row">
                <div class="col-12 d-flex justify-content-end mg-top">
                  <input type="submit" name="simpan" class="btn btn-simpan btn-sm" value="Akhiri">
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
<script type="text/javascript">
  var rupiah = document.getElementById('pemasukan');
	rupiah.addEventListener('keyup', function(e){
		rupiah.value = formatRupiah(this.value, '');
	});

  function formatRupiah(angka, prefix){
		var number_string = angka.replace(/[^,\d]/g, '').toString(),
		split   		= number_string.split(','),
		sisa     		= split[0].length % 3,
		rupiah     		= split[0].substr(0, sisa),
		ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

		if(ribuan){
			separator = sisa ? '.' : '';
			rupiah += separator + ribuan.join('.');
		}

		rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
		return prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '');
	}



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