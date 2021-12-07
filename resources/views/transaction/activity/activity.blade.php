@extends('templates/main')
@section('css')
<link rel="stylesheet" href="{{ asset('css/transaction/style.css') }}">
<style>
  .item{
    cursor: pointer;
  }
  .item.active {
    background-color:#007bff;
    color:rgb(230, 227, 227) !important;
  }
  .item.active i{
    color:rgb(230, 227, 227) !important;
  }

  .item.active:hover{
    background-color:#007bff;
  }
  .item:hover{
    background-color: rgb(245, 245, 245);
  }
  input::-webkit-outer-spin-button,
  input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }

  /* Firefox */
  input[type=number] {
    -moz-appearance: textfield;
  }
  .counter {
    cursor: pointer;
  }

  .text-secondary {
    color: #cad0d6 !important;
  }

  .disabled .counter  {
    background-color: #cad0d6 !important;
  }
  .disabled .product_name  {
    color: #cad0d6 !important;
  }

  .alasan_refund .item.active{
    background-color:#007bff;
    color:white;
  }
  .alasan_refund .item.active:hover{
    background-color:#007bff;
    color:white;
  }
  .alasan_refund .item:hover{
    background-color:rgb(245, 245, 245);
  }
</style>
@endsection
@section('content')
<div class="row page-title-header">
  <div class="col-12">
    <div class="page-header d-flex justify-content-start align-items-center">
      <h4 class="page-title">Activity</h4>
    </div>
  </div>
</div>
<div class="content bg-white h-100">
  <div id="pilih_refund" class="modal fade pilih-refund" tabindex="-1" role="dialog" aria-labelledby="pilih-refund" aria-hidden="true">
    <div class="modal-dialog" style="max-width:600px;">
      <div class="modal-content py-4">
        <div class="mb-4 px-4 pb-3 d-flex align-items-center justify-content-between border-bottom">
          <button class="btn btn-outline-primary" data-dismiss="modal">Batal</button>
          <h4>Pilih Refund</h4>
          <button class="btn btn-primary" id="button_refund" disabled>Refund</button>
        </div>
        <div class="px-5">
          <div class="mb-3 px-3 py-2 border d-flex justify-content-between font-weight-bold rounded">
            <span>Jumlah yang di-refund</span>
            <span id="total_refund" class="text-secondary"></span>
          </div>
          <div class="border-top py-1 d-flex justify-content-center">
            <small class="font-weight-bold">PRODUK YANG DI-REFUND</small>
          </div>
          <form id="product_refund">
            @csrf
            <div id="add_input">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <form id="formSearch" method="get" class="row mx-0 px-0">
    <div class="col-sm-12 col-md-12 col-lg-12 px-0">
      <input class="form-control border-bottom border-top-0 border-left-0 border-right-0 py-4 text-md" type="search" name="search" value="{{isset($_GET['search']) ? $_GET['search'] : ''}}" id="search" placeholder="Nomor struk atau invoice">
    </div>
  </form>
  <div class="row mx-0 px-0 pr-4 d-flex">
    <div class="col-sm-12 col-md-5 col-lg-5 px-0 border-right">
      <div style="height: 500px; position: relative; overflow:auto;" class="group-date">
        @if(count($transactions) > 0)
        @foreach($transactions as $key => $group_transactions)
        <div class="date px-2 py-2 bg-secondary font-weight-bold">{{$key}}</div>
        <div class="items d-flex flex-column">
          @foreach($group_transactions as $transaction)
          <div onclick="getDetailTransactions('{{$transaction->id}}', this)"  class="item d-flex pr-3 pl-1 py-2 w-100 align-items-center border-bottom {{$transaction->id == $transaction_details->id  ? 'active' : ''}}">
            <div class="px-3">
              <i style="font-size:20px; color:gray;" class="mdi mdi-cash"></i>
            </div>
            <div class="d-flex flex-column w-100 text-truncate">
              <div class="d-flex justify-content-between">
                <span class="d-flex flex-column">
                  <span class="font-weight-bold">{{ $transaction->total_string }}</span>
                  @if($transaction->is_refund)
                  <small class="font-weight-bold text-warning">Canceled</small>
                  @endif
                </span>
                <span class="font-weight-bold">{{ $transaction->jam }}</span> 
              </div>
              <div class="text-truncate">{{$transaction->nama_barang}}</div>
            </div>
          </div>
          @endforeach
        </div>
        @endforeach
        @else
          <div class="px-3">
            Data tidak ada
          </div>
        @endif
      </div>
      <div class="d-flex justify-content-center">
        {{$transactionPaginate->links()}}
      </div>
    </div>
    <div class="col-sm-12 col-md-1 col-lg-1 m-0 p-0 my-4"></div>
    @if($transaction_details!=null)
    <div id="transactionDetails" class="col-sm-12 col-md-6 col-lg-6 pt-5" style="height: 500px; position: relative; overflow:auto;">
      <div class="mb-4 d-flex" style="height: 50px;">
        <button id="tombolCetakStruk" class="w-50 mx-2 btn btn-outline-primary">Cetak Struk</button>
        @if(!$transaction_details->is_refund)
        <button id="tombolPilihRefund" onclick="getTransactionRefund({{$transaction_details->id}})" class="w-50 btn btn-outline-primary">Pilih Refund</button>
        @endif
      </div>
      <div class="border-top border-bottom">
        <div style="font-size: .7em; color:gray;" class="font-weight-bold py-1">Detil Transaksi</div>
        @if($transaction_details->is_refund)
        <div class="d-flex align-items-center justify-content-between pr-3 py-1 border-top">
          <div class="d-flex align-items-center">
            <div style="width:58px; min-height:48px;" class="d-flex align-items-center">
              <i style="font-size:24px; color:gray; width:48px;" class="mdi mdi-information-outline text-center"></i>
            </div>
            <span class="font-weight-bold">Status Transaksi</span>
          </div>
          <span class="text-warning font-weight-bold">Canceled</span>
        </div>
        <div class="d-flex align-items-center justify-content-between pr-3 py-1 border-top">
          <div class="d-flex align-items-center">
            <div style="width:58px; min-height:48px;" class="d-flex align-items-center">
              <i style="font-size:24px; color:gray; width:48px;" class="mdi mdi-information-outline text-center"></i>
            </div>
            <span class="font-weight-bold">Alasan Refund</span>
          </div>
          <span class="font-weight-bold text-truncate pl-5">{{$transaction_details->alasan_refund}}</span>
        </div>
        @endif
        <div class="d-flex align-items-center justify-content-between pr-3 py-1 border-top">
          <div class="d-flex align-items-center">
            <div style="width:58px; min-height:48px;" class="d-flex align-items-center">
              <i style="font-size:24px; color:gray; width:48px;" class="mdi mdi-cash text-center"></i>
            </div>
            <span class="font-weight-bold">Metode Pembayaran</span>
          </div>
          <span class="font-weight-bold">Tunai</span>
        </div>
        <div class="d-flex align-items-center justify-content-between pr-3 py-1 border-top">
          <div class="d-flex align-items-center">
            <div style="width:58px; min-height:48px;" class="d-flex align-items-center">
              <i style="font-size:24px; color:gray; width:48px;" class="mdi mdi-clock-outline text-center"></i>
            </div>
            <span class="font-weight-bold">Waktu Pembelian</span>
          </div>
          <span class="font-weight-bold" id="waktu_pembelian">{{$transaction_details->date.' pada '.$transaction_details->jam}}</span>
        </div>
        <div class="d-flex align-items-center justify-content-between pr-3 py-1 border-top">
          <div class="d-flex align-items-center">
            <div style="width:58px; min-height:48px;" class="d-flex align-items-center">
              <i style="font-size:24px; color:gray; width:48px;" class="mdi mdi-script-text-outline text-center"></i>
            </div>
            <span class="font-weight-bold">Nomor Struk</span>
          </div>
          <span class="font-weight-bold" id="nomor_struk">{{$transaction_details->kode_transaksi}}</span>
        </div>
      </div>
      <div class="border-top border-bottom" style="margin-top:50px;">
        @if($transaction_details->is_refund)
        <div style="font-size: .7em; color:gray;" class="font-weight-bold py-1">Produk yang di refund</div>
        @else
        <div style="font-size: .7em; color:gray;" class="font-weight-bold py-1">Produk</div>
        @endif
        <div id="product">
          @foreach($transaction_details->transaction_details as $product)
            <div class="d-flex align-items-center justify-content-between pr-3 border-top" style="height:48px">
              <div class="d-flex align-items-center">
                <div style="width:58px;" class="d-flex align-items-center">
                  <div class="bg-secondary text-center text-white" style="width:48px; line-height:47px;">{{$product->nama_singkatan}}</div>
                </div>
                <div class="d-flex flex-column">
                  <span class="font-weight-bold product_name">{{$product->nama_barang}}</span>
                  <span>{{$product->jumlah}} pcs</span>
                </div>
              </div>
              <span class="font-weight-bold">{{$product->total_barang_string}}</span>
            </div>
          @endforeach
          <div class="d-flex align-items-center justify-content-between pr-3 border-top" style="height:48px">
            <div class="d-flex align-items-center">
              <span class="font-weight-bold product_name">Total</span>
            </div>
            <span class="font-weight-bold text-success">{{$transaction_details->total_string}}</span>
          </div>
        </div>
      </div>
    </div>
    @endif
  </div>
</div>
@endsection
@section('script')
<script src="{{ asset('plugins/js/quagga.min.js') }}"></script>
<script src="{{ asset('js/transaction/script.js') }}"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
function templateTransaction(data){
  var html = '<div class="mb-4 d-flex" style="height: 50px;">'+
      '<button id="tombolCetakStruk" class="w-50 mx-2 btn btn-outline-primary">Cetak Struk</button>';
      if(!data.is_refund){
        html+='<button id="tombolPilihRefund" onclick="getTransactionRefund('+data.id+')" class="w-50 btn btn-outline-primary">Pilih Refund</button>';
      }
      html+='</div>'+
      '<div class="border-top border-bottom">'+
        '<div style="font-size: .7em; color:gray;" class="font-weight-bold py-1">Detil Transaksi</div>';
      if(data.is_refund){
        html+='<div class="d-flex align-items-center justify-content-between pr-3 py-1 border-top">'+
          '<div class="d-flex align-items-center">'+
            '<div style="width:58px; min-height:48px;" class="d-flex align-items-center">'+
              '<i style="font-size:24px; color:gray; width:48px;" class="mdi mdi-information-outline text-center"></i>'+
            '</div>'+
            '<span class="font-weight-bold">Status Transaksi</span>'+
          '</div>'+
          '<span class="text-warning font-weight-bold">Canceled</span>'+
        '</div>'+
        '<div class="d-flex align-items-center justify-content-between pr-3 py-1 border-top">'+
          '<div class="d-flex align-items-center">'+
            '<div style="width:58px; min-height:48px;" class="d-flex align-items-center">'+
              '<i style="font-size:24px; color:gray; width:48px;" class="mdi mdi-information-outline text-center"></i>'+
            '</div>'+
            '<span class="font-weight-bold">Alasan Refund</span>'+
          '</div>'+
          '<span class="font-weight-bold text-truncate pl-5">'+data.alasan_refund+'</span>'+
        '</div>';
      }
      html+='<div class="d-flex align-items-center justify-content-between pr-3 py-1 border-top">'+
          '<div class="d-flex align-items-center">'+
            '<div style="width:58px; min-height:48px;" class="d-flex align-items-center">'+
              '<i style="font-size:24px; color:gray; width:48px;" class="mdi mdi-cash text-center"></i>'+
            '</div>'+
            '<span class="font-weight-bold">Metode Pembayaran</span>'+
          '</div>'+
          '<span class="font-weight-bold">Tunai</span>'+
        '</div>'+
        '<div class="d-flex align-items-center justify-content-between pr-3 py-1 border-top">'+
          '<div class="d-flex align-items-center">'+
            '<div style="width:58px; min-height:48px;" class="d-flex align-items-center">'+
              '<i style="font-size:24px; color:gray; width:48px;" class="mdi mdi-clock-outline text-center"></i>'+
            '</div>'+
            '<span class="font-weight-bold">Waktu Pembelian</span>'+
          '</div>'+
          '<span class="font-weight-bold" id="waktu_pembelian">'+data.date+' pada '+data.jam+'</span>'+
        '</div>'+
        '<div class="d-flex align-items-center justify-content-between pr-3 py-1 border-top">'+
          '<div class="d-flex align-items-center">'+
            '<div style="width:58px; min-height:48px;" class="d-flex align-items-center">'+
              '<i style="font-size:24px; color:gray; width:48px;" class="mdi mdi-script-text-outline text-center"></i>'+
            '</div>'+
            '<span class="font-weight-bold">Nomor Struk</span>'+
          '</div>'+
          '<span class="font-weight-bold" id="nomor_struk">'+data.kode_transaksi+'</span>'+
        '</div>'+
      '</div>'+
      '<div class="border-top border-bottom" style="margin-top:50px;">';
  if(data.is_refund){
    html+='<div style="font-size: .7em; color:gray;" class="font-weight-bold py-1">Produk yang di refund</div>'
  }else{
    html+='<div style="font-size: .7em; color:gray;" class="font-weight-bold py-1">Produk</div>'
  }
  html+='<div id="product">';
  for(let i=0; i<data.transaction_details.length; i++){
    html+='<div class="d-flex align-items-center justify-content-between pr-3 border-top" style="height:48px">'+
            '<div class="d-flex align-items-center">'+
              '<div style="width:58px;" class="d-flex align-items-center">'+
                '<div class="bg-secondary text-center text-white" style="width:48px; line-height:47px;">SU</div>'+
              '</div>'+
              '<div class="d-flex flex-column">'+
                '<span class="font-weight-bold product_name">'+data.transaction_details[i].nama_barang+'</span>'+
                '<span>'+data.transaction_details[i].jumlah+' pcs</span>'+
              '</div>'+
            '</div>'+
            '<span class="font-weight-bold">'+data.transaction_details[i].total_barang_string+'</span>'+
          '</div>';
  }
  html+=
  '<div class="d-flex align-items-center justify-content-between pr-3 border-top" style="height:48px">'+
    '<div class="d-flex align-items-center">'+
      '<span class="font-weight-bold product_name">Total</span>'+
    '</div>'+
    '<span class="font-weight-bold text-success">'+data.total_string+'</span>'+
  '</div>'+
  '</div>'+
  '</div>';
  return html;
}
function getDetailTransactions(id, that=null){
  if(that==null || !$(that).hasClass("active")){
    if(that!=null){
      $(".item.active").removeClass('active')
      $(that).addClass('active')
    }
    $("#transactionDetails").html("Loading...")
    $.ajax({
      url: "{{ url('/transaction/activity') }}"+'/'+id,
      method: "get",
      success:function(response){
        response = JSON.parse(response);
        var html = templateTransaction(response);
        $("#transactionDetails").html(html);
      }
    });
  }
}
function getTransactionRefund(id){
  $.ajax({
    url: "{{ url('/transaction/activity/refund') }}"+'/'+id,
    method: "get",
    success:function(response){
      response = JSON.parse(response);
      var html = templateTransactionRefund(response)
      $("#product_refund #add_input").html(html);
      $("#total_refund").text(response.total_string);
      $("#button_refund").attr("onclick", 'proccessRefund('+response.id+')');
      $("#pilih_refund").modal('show');
    }
  });
}
function templateTransactionRefund(product_refund){
  var html = '' 
  for(let i=0; i<product_refund.transaction_details.length; i++){
    html+='<div class="border-top py-1">'+
    '<div class="d-flex align-items-center justify-content-between" style="height:48px">'+
      '<div class="d-flex align-items-center">'+
        '<div style="width:58px;" class="d-flex align-items-center">'+
          '<div class="bg-secondary text-center text-white" style="width:48px; line-height:47px;">'+product_refund.transaction_details[i].nama_singkatan+'</div>'+
        '</div>'+
        '<div class="d-flex flex-column">'+
          '<span class="font-weight-bold product_name">'+product_refund.transaction_details[i].nama_barang+'</span>'+
          '<span>'+product_refund.transaction_details[i].jumlah+' pcs</span>'+
        '</div>'+
      '</div>'+
      '<div class="d-flex align-items-center">'+
        '<input type="hidden" name="transaction_details_id" value="'+product_refund.transaction_details[i].id+'">'+
        '<input type="hidden" name="harga" value="'+product_refund.transaction_details[i].harga+'">'+
        '<input type="hidden" name="jumlah" value="'+product_refund.transaction_details[i].jumlah+'">'+
        '<input type="hidden" name="jenis_diskon" value="'+product_refund.transaction_details[i].jenis_diskon_per_barang+'">'+
        '<input type="hidden" name="diskon" value="'+product_refund.transaction_details[i].diskon_per_barang+'">'+
        '<span class="font-weight-bold">'+product_refund.transaction_details[i].total_barang_string+'</span>'+
      '</div>'+
    '</div>'+
  '</div>'
  }
  html += '<input id="alasan_refund" type="hidden" name="alasan_refund">'+
  '<div class="border-top py-1">'+
    '<small class="font-weight-bold">ALASAN REFUND</small>'+
  '</div>'+
  '<div class="alasan_refund mb-3 border d-flex flex-column font-weight-bold rounded">'+
    '<span onclick="setAlasanReturn(&quot;Produk Retur&quot;, this)" class="item px-3 py-2 border-bottom">Produk Retur</span>'+
    '<span onclick="setAlasanReturn(&quot;Kesalahan Transaksi&quot;, this)" class="item px-3 py-2 border-bottom">Kesalahan Transaksi</span>'+
    '<span onclick="setAlasanReturn(&quot;Pesanan yang dibatalkan&quot;, this)" class="item px-3 py-2 border-bottom">Pesanan yang dibatalkan</span>'+
    '<input oninput="setAlasanReturn($(this).val())" class="px-3 py-2 border-0" type="text" placeholder="Lainnya">'+
  '</div>'+
  '<input type="hidden" name="total_refund" id="total_refund_input" value="0">'
  return html
}

function setAlasanReturn(alasan, el=null){
  $('#alasan_refund').val(alasan)
  $('.alasan_refund').find('.item.active').removeClass('active')
  if(el!=null){
    $(el).addClass('active')
  }
  updateButton()
}

function updateButton(){
  // let checked = $('#product_refund').find('input[name="checked"]:checked')
  let alasan = $('#alasan_refund').val().trim()
  if(alasan!=""){
    $("#button_refund").prop('disabled', false)
  }else{
    $("#button_refund").prop('disabled', true)
  }
}

function proccessRefund(transaction_id){
  var form = new FormData(document.querySelector('#product_refund'))
  var data = {
    _token: $("#product_refund input[name='_token']").val(),
    alasan_refund: $("#product_refund #alasan_refund").val(),
    total_refund: $("#product_refund #total_refund_input").val()
  }
  $.ajax({
    url: "{{ url('/transaction/activity/refund/process') }}"+'/'+transaction_id,
    method: "POST",
    data: data,
    success:function(response){
      swal(
          "Berhasil!",
          "Refund transaksi berhasil",
          "success"
      ).then(() => {
        $("#pilih_refund").modal('hide');
        getDetailTransactions(transaction_id);
      });
    },
    fail:function(er){
      swal(
        "Gagal!",
        "Refund transaksi gagal",
        "error"
      ).then(() => {
        $("#pilih_refund").modal('hide');
        getDetailTransactions(transaction_id);
      });

    }
  });
}

function formatRupiah(angka, prefix){
    var number_string = angka.toString().replace(/[^,\d]/g, ''),
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
</script>
@endsection