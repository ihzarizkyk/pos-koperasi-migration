@extends('templates/main')
@section('css')
<link rel="stylesheet" href="{{ asset('css/transaction/style.css') }}">
@endsection
@section('content')
<div class="row page-title-header">
  <div class="col-12">
    <div class="page-header d-flex justify-content-start align-items-center">
      <h4 class="page-title">Daftar Barang</h4>
    </div>
  </div>
</div>
<div class="row modal-group">
  <div class="modal fade" id="scanModal" tabindex="-1" role="dialog" aria-labelledby="scanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="scanModalLabel">Scan Barcode</h5>
          <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
              <div class="col-12">
                <div class="alert alert-danger kode_barang_error" role="alert" hidden="">
                  <i class="mdi mdi-information-outline"></i> Kode barang tidak tersedia
                </div>
              </div>
              <div class="col-12 text-center" id="area-scan">
              </div>
              <div class="col-12 barcode-result" hidden="">
                <h5 class="font-weight-bold">Hasil</h5>
                <div class="form-border">
                  <p class="barcode-result-text"></p>
                </div>
              </div>
            </div>
        </div>
        <div class="modal-footer" id="btn-scan-action" hidden="">
          <button type="button" class="btn btn-primary btn-sm font-weight-bold rounded-0 btn-continue">Lanjutkan</button>
          <button type="button" class="btn btn-outline-secondary btn-sm font-weight-bold rounded-0 btn-repeat">Ulangi</button>
        </div>
      </div>
    </div>
  </div>
  {{-- <div class="modal fade" id="tableModal" tabindex="-1" role="dialog" aria-labelledby="tableModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tableModalLabel">Daftar Barang</h5>
          <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <input type="text" class="form-control" name="search" placeholder="Cari barang">
              </div>  
            </div>
            <div class="col-12">
              <ul class="list-group product-list">
                @foreach($products as $product)
                @if($supply_system->status == true)
                @if(($product->stok > 0 && $product->limit!==null) || $product->limit===null)
                <li class="list-group-item d-flex justify-content-between align-items-center active-list">
                  <div class="text-group">
                    <p class="m-0">{{ $product->kode_barang }}</p>
                    <p class="m-0 txt-light">{{ $product->nama_barang }}</p>
                  </div>
                  <div class="d-flex align-items-center">
                    <span class="ammount-box bg-secondary mr-1"><i class="mdi mdi-cube-outline"></i></span>
                    <p class="m-0">{{ $product->stok }}</p>
                  </div>
                  <a href="#" class="btn btn-icons btn-rounded btn-inverse-outline-primary font-weight-bold btn-pilih" role="button"><i class="mdi mdi-chevron-right"></i></a>
                </li>
                @endif
                @else
                <li class="list-group-item d-flex justify-content-between align-items-center active-list">
                  <div class="text-group">
                    <p class="m-0">{{ $product->kode_barang }}</p>
                    <p class="m-0 txt-light">{{ $product->nama_barang }}</p>
                  </div>
                  <div class="d-flex align-items-center">
                    <span class="ammount-box bg-green mr-1"><i class="mdi mdi-coin"></i></span>
                    <p class="m-0">Rp. {{ number_format($product->harga,2,',','.') }}</p>
                  </div>
                  <a href="#" class="btn btn-icons btn-rounded btn-inverse-outline-primary font-weight-bold btn-pilih" role="button"><i class="mdi mdi-chevron-right"></i></a>
                </li>
                @endif
                @endforeach
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> --}}
  @if ($message = Session::get('transaction_success'))
  <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body bg-grey">
          <div class="row">
            <div class="col-12 text-center mb-4">
              <img src="{{ asset('gif/success4.gif') }}">
              <h4 class="transaction-success-text">Transaksi Berhasil</h4>
            </div>
            @php
            $transaksi = \App\Transaction::where('transactions.kode_transaksi', '=', $message)
            ->select('transactions.*')
            ->first();
            @endphp
            <div class="col-12">
              <table class="table-receipt">
                <tr>
                  <td>
                    <span class="d-block little-td">Kode Transaksi</span>
                    <span class="d-block font-weight-bold">{{ $message }}</span>
                  </td>
                  <td>
                    <span class="d-block little-td">Tanggal</span>
                    <span class="d-block font-weight-bold">{{ date('d M, Y', strtotime($transaksi->created_at)) }}</span>
                  </td>
                </tr>
                <tr>
                  <td>
                    <span class="d-block little-td">Kasir</span>
                    <span class="d-block font-weight-bold">{{ $transaksi->kasir }}</span>
                  </td>
                  <td>
                    <span class="d-block little-td">Total</span>
                    <span class="d-block font-weight-bold text-success">Rp. {{ number_format($transaksi->total,2,',','.') }}</span>
                  </td>
                </tr>
              </table>
              <table class="table-summary mt-3">
                <tr>
                  <td class="line-td" colspan="2"></td>
                </tr>
                <tr>
                  <td class="little-td big-td">Bayar</td>
                  <td>Rp. {{ number_format($transaksi->bayar,2,',','.') }}</td>
                </tr>
                <tr>
                  <td class="little-td big-td">Kembali</td>
                  <td>Rp. {{ number_format($transaksi->kembali,2,',','.') }}</td>
                </tr>
              </table>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-close-modal" data-dismiss="modal">Tutup</button>
          <a href="{{ url('/transaction/receipt/' . $message) }}" target="_blank" class="btn btn-sm btn-cetak-pdf">Cetak Struk</a>
        </div>
      </div>
    </div>
  </div>
  @endif
</div>
<form method="POST" name="transaction_form" id="transaction_form" action="{{ url('/transaction/process') }}">
  @csrf
  <div class="row">
    <div class="col-lg-8 col-md-8 col-sm-12 mb-4">
      <div class="row">
        <div class="col-12 mb-4 bg-dark-blue">
          <div class="card card-noborder b-radius">
            <div class="card-body">
              <div class="row">
                <div class="col-12 d-flex justify-content-between align-items-center transaction-header">
                  <div class="d-flex justify-content-start align-items-center">
                    <div class="icon-holder">
                      <i class="mdi mdi-swap-horizontal"></i>
                    </div>
                    <div class="transaction-code ml-3">
                      <p class="m-0 text-white">Kode Transaksi</p>
                      <p class="m-0 text-white">T{{ date('dmYHis') }}</p>
                      <input type="text" name="kode_transaksi" value="T{{ date('dmYHis') }}" hidden="">
                    </div>
                  </div>
                  <div class="btn-group mt-h">
                    {{-- <button class="btn btn-search" data-toggle="modal" data-target="#tableModal" type="button">
                      <i class="mdi mdi-magnify"></i>
                    </button> --}}
                    <button class="btn btn-scan" data-toggle="modal" data-target="#scanModal" type="button">
                      <i class="mdi mdi-crop-free"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 mb-4">
          <div class="card card-noborder b-radius">
            <div class="card-body">
              <div class="row">
                {{-- <div class="col-12 d-flex justify-content-start align-items-center">
                  <div class="cart-icon mr-3">
                    <i class="mdi mdi-cart-outline"></i>
                  </div>
                  <p class="m-0 text-black-50">Daftar Barang</p>
                </div> --}}
                <div class="col-12 mt-3">
                  <div class="form-group">
                    <input type="text" class="form-control" name="search" placeholder="Cari barang">
                  </div>  
                </div>
                <div class="col-12">
                  <ul style="overflow:auto; max-height:290px; padding-bottom:10px;" class="list-group product-list">
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12">
          <div class="card card-noborder b-radius">
            <div class="card-body">
              <div class="row">
                <div class="col-12 d-flex justify-content-start align-items-center">
                  <div class="cart-icon mr-3">
                    <i class="mdi mdi-cart-outline"></i>
                  </div>
                  <p class="m-0 text-black-50">Daftar Pesanan</p>
                </div>
                <div class="col-12 mt-3 table-responsive">
                  <table class="table table-checkout">
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12">
      <div class="card card-noborder b-radius">
        <div class="card-body">
          <div class="row">
            <div class="col-12 payment-1">
              <table class="table-payment-1">
                <tr>
                  <td class="text-left">Tanggal</td>
                  <td class="text-right">{{ date('d M, Y') }}</td>
                </tr>
                <tr>
                  <td class="text-left">Waktu</td>
                  <td class="text-right">{{ date('H:i') }}</td>
                </tr>
                <tr>
                  <td class="text-left">Kasir</td>
                  <td class="text-right">{{ auth()->user()->nama }}</td>
                </tr>
              </table>
            </div>
            <div class="col-12 mt-4">
              <table class="table-payment-2">
                <tr>
                  <td class="text-left">
                    <span class="subtotal-td">Subtotal</span>
                    <span class="jml-barang-td">0 Barang</span>
                  </td>
                  <td class="text-right nilai-subtotal1-td">Rp. 0</td>
                  <td hidden=""><input type="text" class="nilai-subtotal2-td" name="subtotal" value="0"></td>
                </tr>
                <tr>
                  <td class="text-left">
                    <span class="diskon-td">Diskon</span>
                    <a href="#" class="ubah-diskon-td">Ubah diskon</a>
                    <a href="#" class="simpan-diskon-td" hidden="">Simpan</a>
                  </td>
                  <td class="text-right d-flex justify-content-end align-items-center pt-2">
                    <input type="number" class="form-control diskon-input mr-2" min="0" max="100" name="diskon" value="0" hidden="">
                    <span class="nilai-diskon-td mr-1">0</span>
                    <span>%</span>
                  </td>
                </tr>
                <tr>
                  <td colspan="2" class="text-center nilai-total1-td">Rp. 0</td>
                  <td hidden=""><input type="text" class="nilai-total2-td" name="total" value="0"></td>
                </tr>
              </table>
            </div>
            <div class="col-12 mt-2">
              <table class="table-payment-3">
                <tr>
                  <td>
                    <div class="input-group">
                      <select class="js-example-basic-single payment" id="payment" name="payment" style="width: 223px" required>
                        <option selected disabled>Metode Pembayaran</option>
                        @foreach ($method as $payments)
                            <option value="{{$payments->id}}">{{$payments->jenis}}</option>
                        @endforeach
                      </select>
                    </div>
                  </td>
                </tr>
                <tr class="paymentNull" hidden="">
                  <td class="text-danger nominal-min">Harap pilih metode pembayaran</td>
                </tr>
                <tr class="tenggat" hidden="">
                  <td>
                    <label class="col-12 font-weight-bold col-form-label"><b>Jatuh Tempo</b></label>
                      <div class="input-group">
                          <input type="date" class="form-control" name="tenggat">
                      </div>
                  </td>
                </tr>
                <tr class="tenggatNull" hidden="">
                  <td class="text-danger nominal-min">Harap pilih tenggat pembayaran</td>
                </tr>
                <tr>
                  <td>
                    <div class="input-group">
                      <select class="js-example-basic-single payment" name="customer" style="width: 223px" required>
                        <option selected disabled>Pilih customer</option>
                        @foreach ($customer as $item)
                            <option value="{{$item->id}}">{{$item->user->nama}}</option>
                        @endforeach
                      </select>
                    </div>
                  </td>
                </tr>
                {{-- <tr>
                  <td>
                    <button class="btn btn-search" data-toggle="modal" data-target="#tableModal" type="button">
                      <i class="mdi mdi-plus"></i> New Customer
                    </button>

                    <div class="modal fade" id="tableModal" tabindex="-1" role="dialog" aria-labelledby="tableModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="tableModalLabel">New Customer</h5>
                            <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-12">
                                <div class="card card-noborder b-radius">
                                  <div class="card-body">
                                    <form action="">
                                      <label for="">Nama Customer</label>
                                      <input type="text" class="form-control" name="nama" id="">
                                      <label class="mt-3" for="">E-Mail</label>
                                      <input type="email" class="form-control" name="email" id="">
                                      <label class="mt-3" for="">Username</label>
                                      <input type="text" class="form-control" name="username" id="">
                                      <label class="mt-3" for="">Password</label>
                                      <input type="password" class="form-control" name="password" id="">
                                      <div class="mt-4" style="float: right">
                                        <button class="btn btn-bayar" type="button">Simpan</button>
                                      </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                      </div>
                    </div>
                    </div>
                  </td>
                </tr> --}}
                <tr>
                  <td>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text">Rp.</div>
                      </div>
                      <input type="text" id="bayar" min="1" class="form-control number-input input-notzero bayar-input" name="bayar" value="0" placeholder="Masukkan nominal bayar">
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="row">
                      <div class="col-3">
                        <button class="btn btn-suggest" onclick="mySuggest(500)" style="width: 59px; font-size:11px" type="button">500</button>
                      </div>
                      <div class="col-3">
                        <button class="btn btn-suggest" onclick="mySuggest(1000)" style="width: 59px; font-size:11px" type="button">1k</button>
                      </div>
                      <div class="col-3">
                        <button class="btn btn-suggest" onclick="mySuggest(2000)" style="width: 59px; font-size:11px" type="button">2K</button>
                      </div>
                      <div class="col-3">
                        <button class="btn btn-suggest" onclick="mySuggest(5000)" style="width: 59px; font-size:11px" type="button">5k</button>
                      </div>
                    </div>
                    <div class="row mt-2">
                      <div class="col-3">
                        <button class="btn btn-suggest" onclick="mySuggest(10000)" style="width: 59px; font-size:11px" type="button">10k</button>
                      </div>
                      <div class="col-3">
                        <button class="btn btn-suggest" onclick="mySuggest(20000)" style="width: 59px; font-size:11px" type="button">20K</button>
                      </div>
                      <div class="col-3">
                        <button class="btn btn-suggest" onclick="mySuggest(50000)" style="width: 59px; font-size:11px" type="button">50k</button>
                      </div>
                      <div class="col-3">
                        <button class="btn btn-suggest" onclick="mySuggest(100000)" style="width: 59px; font-size:11px" type="button">100k</button>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr class="nominal-error" hidden="">
                  <td class="text-danger nominal-min">Nominal bayar kurang</td>
                </tr>
                <tr>
                  <td class="text-right">
                    <button class="btn btn-bayar" type="button">Bayar</button>
                  </td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
@endsection
@section('script')
<script src="{{ asset('plugins/js/quagga.min.js') }}"></script>
<script src="{{ asset('js/transaction/script.js') }}"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('.js-example-basic-single').select2();
  });

  $(function(){
    $("#payment").on("change", function(){
      var payments = $('option:selected', this).attr('value');
      if (payments == 6) {
        $('.tenggat').prop('hidden', false).attr('required', true);
        $('#bayar').attr('min', 0);
        $('.tenggatNull').prop('hidden', false);
      }
      else{
        $('.tenggat').prop('hidden', true);
        $('.tenggatNull').prop('hidden', true);
        $('#bayar').attr('min', 1);
      }
    });
  });

  function mySuggest(data) {
    var bayar = document.getElementById('bayar').value;
    if (bayar == 0) {
      document.getElementById('bayar').value = data;
      }
      else{
        document.getElementById('bayar').value = parseInt(bayar) + data;
      }
  }

  @if ($message = Session::get('transaction_success'))
    $('#successModal').modal('show');
  @endif

$(document).on('click', '.btn-pilih', function(e){
  e.preventDefault();
  var kode_barang = $(this).prev().prev().children().first().text();
  $.ajax({
    url: "{{ url('/transaction/product') }}/" + kode_barang,
    method: "GET",
    success:function(response){
      var check = $('.kode-barang-td:contains('+ response.product.kode_barang +')').length;
      if(check == 0){
        tambahData(response.product.kode_barang, response.product.nama_barang+' '+response.product.merek+' '+response.product.berat_barang, response.product.harga, response.product.stok, response.product.limit, response.status);
      }else{
        swal(
            "",
            "Barang telah ditambahkan",
            "error"
        );
      }
    }
  });
});

function startScan() {
  Quagga.init({
    inputStream : {
      name : "Live",
      type : "LiveStream",
      target: document.querySelector('#area-scan')
    },
    decoder : {
      readers : ["ean_reader"],
      multiple: false
    },
    locate: false
  }, function(err) {
      if (err) {
          console.log(err);
          return
      }
      console.log("Initialization finished. Ready to start");
      Quagga.start();
  });

  Quagga.onDetected(function(data){
    $('#area-scan').prop('hidden', true);
    $('#btn-scan-action').prop('hidden', false);
    $('.barcode-result').prop('hidden', false);
    $('.barcode-result-text').html(data.codeResult.code);
    $('.kode_barang_error').prop('hidden', true);
    stopScan();
  });
}

$(document).on('click', '.btn-scan', function(){
  $('#area-scan').prop('hidden', false);
  $('#btn-scan-action').prop('hidden', true);
  $('.barcode-result').prop('hidden', true);
  $('.barcode-result-text').html('');
  $('.kode_barang_error').prop('hidden', true);
  startScan();
});

$(document).on('click', '.btn-repeat', function(){
  $('#area-scan').prop('hidden', false);
  $('#btn-scan-action').prop('hidden', true);
  $('.barcode-result').prop('hidden', true);
  $('.barcode-result-text').html('');
  $('.kode_barang_error').prop('hidden', true);
  startScan();
});

$(document).on('click', '.btn-continue', function(e){
  e.stopPropagation();
  var kode_barang = $('.barcode-result-text').text();
  $.ajax({
    url: "{{ url('/transaction/product/check') }}/" + kode_barang,
    method: "GET",
    success:function(response){
      var check = $('.kode-barang-td:contains('+ response.product.kode_barang +')').length;
      if(response.check == 'tersedia'){
        if(check == 0){
          tambahData(response.product.kode_barang, response.product.nama_barang, response.product.harga, response.product.stok, response.product.limit, response.status);
          $('.close-btn').click();  
        }else{
          swal(
              "",
              "Barang telah ditambahkan",
              "error"
          );
        }
      }else{
        $('.kode_barang_error').prop('hidden', false);
      }
    }
  });
});

$(document).on('click', '.btn-bayar', function(){
  var total = parseInt($('.nilai-total2-td').val());
  var bayar = parseInt($('.bayar-input').val());
  var check_barang = parseInt($('.jumlah_barang_text').length);
  var payment = $('.payment').val();
  var payment_method = document.getElementById('payment').value;
  if (!payment) {
    $('.paymentNull').prop('hidden', false);
  }
  
  if(bayar >= total || payment_method == 6){
    $('.nominal-error').prop('hidden', true);
    if(check_barang != 0){
      if($('.diskon-input').attr('hidden') != 'hidden'){
        $('.diskon-input').addClass('is-invalid');
      }else{
        $('#transaction_form').submit();
      }
    }else{
      swal(
          "",
          "Pesanan Kosong",
          "error"
      );
    }
  }else{
    if(isNaN(bayar)) {
      $('.bayar-input').valid();
    }else{
      $('.nominal-error').prop('hidden', false);
    }
    
    if(check_barang == 0){
      swal(
          "",
          "Pesanan Kosong",
          "error"
      );
    }
  }
});
var xhrSearch = null;
$('input[name=search]').on('keyup', function(){
  if(xhrSearch != null){
    xhrSearch.abort()
  }
  var el = $('.product-list');
  var searchTerm = $(this).val().toLowerCase();
  if(searchTerm.trim() != ''){
    var loading = ''+
          '<li class="list-group-item d-flex justify-content-between align-items-center active-list">'+
            'Sedang mencari ...'+
          '</li>';
    el.html(loading)
    xhrSearch = $.ajax({
      url: "{{ url('/transaction/products/search') }}",
      method: "get",
      data:{
        cari: searchTerm
      },
      success:function(response){
        if(response.product.length>0){
          var html = '';
          for(var i=0; i<response.product.length; i++){
            var productEl = ''+
            '<li class="list-group-item d-flex justify-content-between align-items-center active-list">'+
              '<div class="text-group">'+
                '<p class="m-0">'+response.product[i].kode_barang+'</p>'+
                '<p class="m-0 txt-light">'+response.product[i].nama_barang+' '+response.product[i].merek+' '+response.product[i].berat_barang+'</p>'+
              '</div>'+
              '<div class="d-flex align-items-center">'+
                '<span class="ammount-box bg-secondary mr-1"><i class="mdi mdi-cube-outline"></i></span>'+
                '<p class="m-0">'+response.product[i].stok+'</p>'+
              '</div>'+
              '<button class="btn btn-icons btn-rounded btn-inverse-outline-primary font-weight-bold btn-pilih" role="button"><i class="mdi mdi-chevron-right"></i></button>'+
            '</li>';
            html+=productEl
          }
          el.html(html)
        }else{
          var html = ''+
          '<li class="list-group-item d-flex justify-content-between align-items-center active-list">'+
            'Product tidak ditemukan'+
          '</li>';
          el.html(html);
        }
        
      }
    });
  }else{
    var html = '';
    el.html(html);
  }
});
</script>
@endsection