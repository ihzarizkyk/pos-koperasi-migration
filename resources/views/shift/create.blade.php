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
        <form action="{{ route('shift.start') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="form-group row top-min">
                        <label class="col-12 font-weight-bold col-form-label">Starting Cash</label>
                        <div class="col-12">
                            <input type="text" id="modal" class="form-control input-notzero" name="modal" placeholder="Masukkan Modal Awal" required>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                  <div class="form-group row top-min">
                      <label class="col-12 font-weight-bold col-form-label">Pilih Market</label>
                      <div class="col-12">
                        <select class="js-example-basic-single" id="" name="market" style="width: 850px" required>
                          <option selected disabled>Pilih Market</option>
                          @foreach ($market as $data)
                              <option value="{{$data->id}}">{{$data->nama_toko}}</option>
                          @endforeach
                        </select>
                      </div>
                  </div>
              </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group row top-min">
                        <label class="col-12 font-weight-bold col-form-label"><b>Tanggal dan Waktu Mulai</b></label>
                        <div class="col-12">
                            <div class="input-group">
                                <input type="text" class="form-control" name="start" value="{{ date('Y-m-d H:i:s') }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 d-flex justify-content-end mg-top">
                  <input type="submit" name="simpan" class="btn btn-simpan btn-sm" value="Mulai">
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

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
      $('.js-example-basic-single').select2();
    });

  var rupiah = document.getElementById('modal');
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