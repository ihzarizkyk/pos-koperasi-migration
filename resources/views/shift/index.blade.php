@extends('templates/main')
@section('css')
<link rel="stylesheet" href="{{ asset('css/manage_product/supply_product/supply/style.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
<style>
  .btn-update{
    background-color: #2449f0;
    color: #ffff;
  }
  #kode{
    width: 285px;
  }
  .btn-aksi{
    margin-bottom: 10px;
  }
</style>
@endsection
@section('content')
<div class="row page-title-header">
  <div class="col-12">
    <div class="page-header d-flex justify-content-between align-items-center">
      <h4 class="page-title">Riwayat Shift</h4>
      <div class="d-flex justify-content-start">
        {{-- <a href="{{ url('/supply/statistics') }}" class="btn btn-icons btn-inverse-primary btn-filter shadow-sm ml-2">
          <i class="mdi mdi-poll"></i>
        </a> --}}
        <div class="dropdown dropdown-search">
          <button class="btn btn-icons btn-inverse-primary btn-filter shadow-sm ml-2" type="button" id="dropdownMenuIconButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="mdi mdi-magnify"></i>
          </button>
          <div class="dropdown-menu search-dropdown" aria-labelledby="dropdownMenuIconButton1">
            <div class="row">
              <div class="col-11">
                <input type="text" class="form-control" name="search" placeholder="Cari Shift">
              </div>
            </div>
          </div>
        </div>
	      @if ($lastShift)
          @if ($lastShift->selesai != null)
            <a href="{{ route('shift.new') }}" class="btn btn-icons btn-inverse-primary btn-new ml-2" title="Mulai Shift">
              <i class="bi bi-eye"></i>
            </a>
          @else
            <a href="{{ route('shift.endShift', $lastShift->id) }}" class="btn btn-icons  btn-danger ml-2" title="Akhiri Shift">
              <i class="bi bi-eye-slash"></i>
            </a>
          @endif
        @else
          <a href="{{ route('shift.new') }}" class="btn btn-icons btn-inverse-primary btn-new ml-2" title="Mulai Shift">
            <i class="bi bi-eye"></i>
          </a>
        @endif
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="card card-noborder b-radius">
      <div class="card-body">
        <div class="row">
        	<div class="col-12">
            <ul class="list-date">
              @if ($lastShift)
                @if ($lastShift->selesai == null)
                  <div class="alert alert-success" role="alert">
                    <h5>Shift Sedang Berlangsung</h5>
                    <p>Dimulai pada: {{$lastShift->mulai}}</p>
                  </div>
                @else
                  <div class="alert alert-info" role="alert">
                    <h5>Shift Telah Diakhiri</h5>
                    <p>Selesai pada: {{$lastShift->selesai}}</p>
                  </div>
                @endif
                @else
                <div class="alert alert-info" role="alert">
                  <h5> Data Shift Masih Kosong</h5>
                </div>
              @endif
             
              
              <div class="table-responsive">
                <table class="table table-custom">
                  <tr>
                    <th>Nama</th>
                    <th>Start Cash</th>
                    <th>Expected</th>
                    <th>Actual</th>
                    <th>Difference</th>
                    <th>Starting Shift</th>
                    <th></th>
                  </tr>
                  @if ($data->count() == 0)
                  <tr>
                    <td colspan="6" style="text-align: center">
                      <div class="alert alert-secondary" role="alert">
                        History Shift Masih Kosong
                      </div>
                    </td>
                  </tr>
                  @endif
                  @foreach ($data as $item)
                    <tr>
                      <td class="td-1 font-weight-bold">
                        {{$item->user->nama}}
                        <span class="d-block mt-2 txt-light"></span>
                      </td>
                      <td class="td-2 font-weight-bold">Rp. {{number_format($item->start_cash,2,',','.')}}</td>
                      <td class="td-3 font-weight-bold">Rp. {{number_format($item->expected,2,',','.')}}</td>
                      <td class="td-4 font-weight-bold">Rp. {{number_format($item->actual,2,',','.')}}</td>
                      <td class="td-5 font-weight-bold">Rp. {{number_format($item->difference,2,',','.')}}</td>
                      <td class="font-weight-bold td-4">{{$item->mulai}}</td>
                      <td>
                        <a href="{{ route('shift.detail', $item->id) }}" class="btn btn-edit btn-icons btn-rounded btn-secondary" title="DETAIL"><i class="bi bi-info-lg"></i></a>
                        <a href="{{ route('shift.delete', $item->id) }}" class="btn btn-edit btn-icons btn-rounded btn-secondary" title="HAPUS"><i class="bi bi-trash"></i></a>
                      </td>
                    </tr>
                  @endforeach
                </table>
              </div>
            </ul>
        	</div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
<script src="{{ asset('js/manage_product/supply_product/supply/script.js') }}"></script>
<script>
  var rupiah = document.getElementById('harga');
    rupiah.addEventListener('keyup', function(e){
        rupiah.value = formatRupiah(this.value, '');
    });

    
    function formatRupiah(angka, prefix){
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split   		= number_string.split(','),
        sisa     		= split[0].length % 3,
        rupiah     	= split[0].substr(0, sisa),
        ribuan     	= split[0].substr(sisa).match(/\d{3}/gi);

        if(ribuan){
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '');
    }
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