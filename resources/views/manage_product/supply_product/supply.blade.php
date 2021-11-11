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
</style>
@endsection
@section('content')
<div class="row page-title-header">
  <div class="col-12">
    <div class="page-header d-flex justify-content-between align-items-center">
      <h4 class="page-title">Riwayat Pasok</h4>
      <div class="d-flex justify-content-start">
        <a href="{{ url('/supply/statistics') }}" class="btn btn-icons btn-inverse-primary btn-filter shadow-sm ml-2">
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
	      <a href="{{ url('/supply/new') }}" class="btn btn-icons btn-inverse-primary btn-new ml-2">
	      	<i class="mdi mdi-plus"></i>
	      </a>
        <a href="{{route('supplier')}}" class="btn btn-inverse-primary btn-new ml-2">
          Supplier
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
    <div class="card card-noborder b-radius">
      <div class="card-body">
        <div class="row">
        	<div class="col-12">
            @if(count($dates) > 0)
            <ul class="list-date">
              @foreach($dates as $date)
              <li class="txt-light">{{ date('d M, Y', strtotime($date)) }}</li>
              @php
              $supplies = \App\Supply::whereDate('supplies.created_at', $date)
              ->select('supplies.*')
              ->latest()
              ->get();
              @endphp
              <div class="table-responsive">
                <table class="table table-custom">
                  <tr>
                    <th>Nomor Nota</th>
                    <th>Suppliers</th>
                    <th>Barang</th>
                    <th>Tanggal Pasok</th>
                    <th>Status</th>
                    <th></th>
                  </tr>
                  @foreach($supplies as $supply)
                  <tr>
                    <td class="td-1 font-weight-bold">
                      {{$supply->nota}}
                      <span class="d-block mt-2 txt-light"></span>
                    </td>
                    <td class="td-2 font-weight-bold">{{ $supply->supplier->perusahaan }}</td>
                    @php
                      $barang = \App\detail_supplies::where('supplies_id', $supply->id)->count();
                    @endphp
                    <td class="td-3 font-weight-bold">{{$barang}} items</td>
                    <td class="font-weight-bold td-4">{{ date('d M, Y', strtotime($supply->date)) }}</td>
                    <td class="font-weight-bold">
                      @if ($supply->status == 1)
                          Complete
                      @else
                          Pending
                      @endif
                    </td>
                    <td>
                      <!-- Button trigger modal -->
                      @if ($supply->status == 0)
                        <a href="{{ route('detail_pasok', $supply->id) }}" type="button" title="EDIT" class="btn btn-edit btn-icons btn-rounded btn-secondary"><i class="mdi mdi-pencil"></i></a>
                        <button onclick="openConfirmModal()" type="button" title="DELETE" class="btn btn-delete btn-icons btn-rounded btn-danger"><i class="mdi mdi-delete"></i></button>
                        <form id="formDelete" action="{{ route('deleted_supply', $supply->id) }}" method="POST" hidden>
                        @csrf
                        </form>
                      @else 
                        <a href="{{ route('pasok_complate', $supply->id) }}" type="button" title="DETAIL" class="btn btn-detail btn-icons btn-rounded btn-secondary"><i class="bi bi-info-lg"></i></a>
                      @endif

                    </td>
                  </tr>
                  @endforeach
                </table>
              </div>
              @endforeach
            </ul>
            @else
            <h5 class="text-center">Data tidak ada</h5>
            @endif
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
        rupiah     		= split[0].substr(0, sisa),
        ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

        if(ribuan){
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '');
    }

    function openConfirmModal(){
      swal({
        title: "Apa kamu yakin?",
        text: "Kamu akan menghapus riwayat pasok ini secara permanen!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          $('#formDelete').submit();
        }
      });
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

  @if ($message = Session::get('delete_success'))
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