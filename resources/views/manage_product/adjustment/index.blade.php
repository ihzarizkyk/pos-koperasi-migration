@extends('templates/main')
@section('css')
<link rel="stylesheet" href="{{ asset('css/manage_product/adjustment/style.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
<style>
  .btn-update{
    background-color: #2449f0;
    color: #ffff;
  }
  #kode{
    width: 285px;
  }
</style>
@endsection
@section('content')
<div class="row page-title-header">
  <div class="col-12">
    <div class="page-header d-flex justify-content-between align-items-center">
      <h4 class="page-title">Riwayat Adjustment</h4>
      <div class="d-flex justify-content-start">
        <a href="#" class="btn btn-icons btn-inverse-primary btn-filter shadow-sm ml-2">
          <i class="mdi mdi-poll"></i>
        </a>
        <div class="dropdown dropdown-search">
          <button class="btn btn-icons btn-inverse-primary btn-filter shadow-sm ml-2" type="button" id="dropdownMenuIconButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="mdi mdi-magnify"></i>
          </button>
          <div class="dropdown-menu search-dropdown" aria-labelledby="dropdownMenuIconButton1">
            <div class="row">
              <div class="col-11">
                <input type="text" class="form-control" name="search" placeholder="Cari barang">
              </div>
            </div>
          </div>
        </div>
	      <a href="{{route('adjustment.create')}}" class="btn btn-icons btn-inverse-primary btn-new ml-2">
	      	<i class="mdi mdi-plus"></i>
	      </a>
        <a href="#" class="btn btn-inverse-primary btn-new ml-2">
          Adjustment
        </a>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12 grid-margin">
      <input type="text" name="range" style="width:25%;" />
  </div>
  <div class="col-md-12 grid-margin">
    <div class="card card-noborder b-tl-radius b-tr-radius">
      <div class="card-body">
        <div class="row">
          <div class="col-12 d-flex justify-content-around">
            <div class="d-flex flex-column align-items-center">
              <h5 class="font-weight-bold">{{$jumlah_adjustment}}</h5>
              <h6 class="font-weight-light">Adjustments</h6>
            </div>
            <div class="d-flex flex-column align-items-center">
              <h5 class="font-weight-bold">{{$total_nominal_adjustment->total}}</h5>
              <h6 class="font-weight-light">Total Adjustment</h6>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card card-noborder b-bl-radius b-br-radius">
      <div class="card-body">
        <div class="row">
        	<div class="col-12">
            <ul class="list-date">
              @foreach($dates as $date)
              <li class="txt-light">{{ date('d M, Y', strtotime($date)) }}</li>
              @endforeach
              <div class="table-responsive">
                <table class="table table-custom">
                    <thead>
                      <tr>
                        <th>ID Stock Adjustment</th>
                        <th>Date</th>
                        <th>Item</th>
                        <th>Nominal</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php //$no=1; ?>
                      @foreach($adjustment as $data)
                      <tr>
                        <td>{{$data->id_adjustment}}</td>
                        <td>{{$data->created_at}}</td>
                        <td><span class="ammount-box bg-secondary"><i class="mdi mdi-cube-outline"></i></span>{{$data->item}}</td>
                        <td><span class="ammount-box {{$data->nominalInteger<0 ? 'bg-red' : 'bg-green'}}"><i class="mdi mdi-coin"></i></span>{{$data->nominal}}</td>
                        <td>
                          <a href="{{ route('adjustment_detail', $data->id) }}" type="button" title="DETAIL" class="btn btn-detail btn-icons btn-rounded btn-secondary"><i class="bi bi-info-lg"></i></a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">{!! $adjustment->links() !!}</div>
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
  // var rupiah = document.getElementById('harga');
  //   rupiah.addEventListener('keyup', function(e){
  //       rupiah.value = formatRupiah(this.value, '');
  //   });

    
  //   function formatRupiah(angka, prefix){
  //       var number_string = angka.replace(/[^,\d]/g, '').toString(),
  //       split   		= number_string.split(','),
  //       sisa     		= split[0].length % 3,
  //       rupiah     		= split[0].substr(0, sisa),
  //       ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

  //       if(ribuan){
  //           separator = sisa ? '.' : '';
  //           rupiah += separator + ribuan.join('.');
  //       }

  //       rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
  //       return prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '');
  //   }
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
<script type="text/javascript">
  $(function() {
    $('input[name="range"]').daterangepicker({
      maxSpan:{
        "years": 1
      },
      startDate: moment('{{$start}}'),
      endDate: moment('{{$end}}'),
      ranges: {
           'Hari ini': [moment(), moment()],
           '7 hari terakhir': [moment().subtract(6, 'days'), moment()],
           'Bulan ini': [moment().startOf('month'), moment().endOf('month')],
           'Bulan lalu': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
           'Tahun ini': [moment().startOf('year'), moment().endOf('year')],
           'Tahun lalu': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
      }
    }, function(start, end, label) {
      window.location.href =  window.location.origin+window.location.pathname+'?start='+start.format('YYYY-MM-DD')+'&end='+end.format('YYYY-MM-DD')
    });
  });
</script>
@endsection