@extends('templates/main')
@section('css')
<link rel="stylesheet" href="{{ asset('css/manage_product/adjustment/create/style.css') }}">
<style>
	.margin{
		margin-right: 5px;
	}
	.mg-top{
		margin-top: 10px;
	}
	.form-hidden{
		visibility: hidden;
	}
</style>
@endsection
@section('content')

<div class="row page-title-header">
	<div class="col-12">
		<div class="page-header d-flex justify-content-start align-items-center">
			<div class="quick-link-wrapper d-md-flex flex-md-wrap">
				<ul class="quick-links">
					<li><a href="https://koperasi.ittelkom-sby.ac.id/supply">Riwayat Pasok</a></li>
					<li><a href="https://koperasi.ittelkom-sby.ac.id/supply/new">Pasok Barang</a></li>
				</ul>
			</div>
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
	<div class="modal fade" id="formatModal" tabindex="-1" role="dialog" aria-labelledby="formatModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="formatModalLabel">Format Upload</h5>
					<button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-12 img-import-area">
							<img src="{{ asset('images/instructions/ImportSupply.jpg') }}" class="img-import">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="modal_cari_barang" tabindex="-1" role="dialog" aria-labelledby="tableModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="tableModalLabel">Add Product</h5>
					<button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-12">
							<div class="card card-noborder b-radius">
								<div class="card-body">
									<nav>
										<div class="nav nav-tabs" id="nav-tab" role="tablist">
										<a class="nav-link active" id="master-form-tab" data-toggle="tab" href="#master-form" role="tab" aria-controls="master-form" aria-selected="true">Master</a>
										<a class="nav-link" id="new-form-tab" data-toggle="tab" href="#new-form" role="tab" aria-controls="new-form" aria-selected="false">New</a>
										</div>
									</nav>
									<div class="tab-content" id="nav-tabContent">
										<div class="tab-pane fade show active" id="master-form" role="tabpanel" aria-labelledby="master-form-tab">
											<div class="row">
												<div class="col-12 mt-3">
													<div class="form-group">
													  <input type="text" class="form-control" name="search" placeholder="Cari barang">
													</div>  
												  </div>
												<div class="product_search col-12">
													<ul style="overflow:auto; max-height:290px; padding-bottom:10px;" class="list-group product-list">
													</ul>
												</div>
												<form class="col-12 input_product" name="input_product" style="display: none;">
													<input type="hidden" required class="form-control" name="kode_barang" readonly="">
													<div class="form-group row top-min">
														<label class="col-12 font-weight-bold col-form-label">Nama Barang <small>(read only)</small></label>
														<div class="col-12">
															<input type="text" required readonly class="form-control number-input input-notzero" name="nama_barang">
														</div>
														{{-- <div class="col-12 error-notice" id="nama_"></div> --}}
													</div>
													<div class="form-group row top-min">
														<label class="col-12 font-weight-bold col-form-label">In-Stock <small>(read only)</small></label>
														<div class="col-12">
															<input type="text" required readonly class="form-control number-input input-notzero" name="in_stock">
														</div>
														<div class="col-12 error-notice" id="jumlah_error"></div>
													</div>
													<div class="form-group row top-min">
														<label class="col-12 font-weight-bold col-form-label">Actual Stock <small class="text-danger">*</small></label>
														<div class="col-12">
															<input type="number" required class="form-control input-notzero" name="actual_stock" placeholder="Masukkan Stock Sebenarnya">
														</div>
														<div class="col-12 text-danger" hidden id="actual_stock_error">Wajib diisi</div>
													</div>
													<div class="form-group row top-min">
														<label class="col-12 font-weight-bold col-form-label">Stok Difference <small>(read only)</small></label>
														<div class="col-12">
															<input type="number" required class="form-control number-input input-notzero" name="stock_difference" readonly value="0">
														</div>
														<div class="col-12 text-danger" hidden id="stock_difference_error">Tidak ada perubahan</div>
													</div>
													<input type="number" name="hpp" hidden>
													<div class="form-group row top-min">
														<label class="col-12 font-weight-bold col-form-label">Note</label>
														<div class="col-12">
															<textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="note"></textarea>
														</div>
													</div>
													<div class="row">
														<div class="col-12 d-flex justify-content-end">
															<button class="btn font-weight-bold btn-tambah" id="input_product" type="button">Tambah</button>
														</div>
													</div>
												</form>
											</div>
										</div>
										<div class="tab-pane fade" id="new-form" role="tabpanel" aria-labelledby="new-form-tab">
											<form action="https://koperasi.ittelkom-sby.ac.id/supply/new_product" method="POST">
												<input type="hidden" name="_token" value="jXbVyE4XNiggp6m9NlI3BnUpKrMAdZ4q7lYMnXFo">	
												<div class="form-group row top-min mg-top">
													<label class="col-12 font-weight-bold col-form-label">Nama Barang</label>
													<div class="col-12">
														<input type="text" class="form-control" name="nama_barang" placeholder="Masukkan Nama Barang">
													</div>
												</div>
												<div class="form-group row top-min mg-top">
													<label class="col-12 font-weight-bold col-form-label">Jenis Barang</label>
													<div class="col-12">
														<select name="kategori" required class="form-control">
															<option value="">Pilih Jenis Barang</option>
															<option value="4">Minuman</option>
															<option value="5">Snack</option>
															<option value="6">ATK</option>
															<option value="7">Pantry</option>
															<option value="9">Ice Cream</option>
															<option value="10">Lain-lain</option>
															<option value="11">Elektronik</option>
														</select>
													</div>
												</div>
												<div>
													<button class="btn btn-simpan" type="submit"><i class="mdi mdi-content-save"></i> Create</button>
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
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12">
		<div class="card card-noborder b-radius">
			<div class="card-body">
				<form method="post" action="{{url('adjustment/store')}}">
					@csrf			
					<div class="row">
						<div class="col-12 table-responsive mb-4">
							<table class="table table-custom mb-5">
								<thead>
									<tr>
										<th>Barang</th>
										<th>In-Stock</th>
										<th>Actual Stock</th>
										<th>Stock Difference</th>
										<th>Nominal</th>
										<th>Note</th>
										<th></th>
									</tr>
								</thead>
								<tbody id="input_product_list">
								</tbody>
							</table>
							<button class="btn btn-info btn-sm margin w-100" data-toggle="modal" data-target="#modal_cari_barang" type="button" name="add_product" value="Add Product"><i class="mdi mdi-plus"></i>Add Product</button>
						</div>
						{{-- <div class="form-hidden" id="detail">
							<div class="container">
								<div class="row">
									<div class="col">
										<div class="form-group row top-min">
											<label class="col-12 font-weight-bold col-form-label">Nota Pembelian</label>
											<div class="col-12">
												<input type="text" class="form-control input-notzero" name="nota" placeholder="Masukkan Nota Pembelian" required>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="container">
								<div class="row">
									<div class="col">
										<div class="form-group row top-min">
											<label class="col-12 font-weight-bold col-form-label"><b>Tanggal</b></label>
											<div class="col-12">
												<div class="input-group">
													<input type="date" class="form-control" name="date" required>
												</div>
											</div>
											<div class="col-12 error-notice" id="backdate_error"></div>
										</div>
									</div>
								</div>
							</div>
						</div> --}}
						<div class="col-12 d-flex justify-content-end">
							<button class="btn btn-simpan btn-sm margin" disabled type="submit" name="save_adjustment" value="create"><i class="mdi mdi-content-save"></i> Save Adjustment</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection
@section('script')
<script src="{{ asset('plugins/js/quagga.min.js') }}"></script>
<script type="text/javascript">
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

$('#modal_cari_barang').on('hidden.bs.modal', function (e) {
  $('input[name=search]').val('')
  $('.product-list').html('');
  resetInput();
})

var xhrSearch = null;
$('input[name=search]').on('keyup', function(){
  if(xhrSearch != null){
    xhrSearch.abort()
  }
  var el = $('.product-list');
  var searchTerm = $(this).val().toLowerCase();
  resetInput();
  if(searchTerm.trim() != ''){
    var loading = ''+
          '<li class="list-group-item d-flex justify-content-between align-items-center active-list">'+
            'Sedang mencari ...'+
          '</li>';
    el.html(loading)
    xhrSearch = $.ajax({
      url: "{{ url('/adjustment/products/search') }}",
      method: "get",
      data:{
        cari: searchTerm
      },
      success:function(response){
		response.product = response.product.filter(p => {
			return !input_product.some(q => q==p.kode_barang) 
		})
        if(response.product.length>0){
          var html = '';
          for(var i=0; i<response.product.length; i++){
            var productEl = ''+
            '<li class="list-group-item d-flex justify-content-between align-items-center active-list">'+
              '<div class="text-group">'+
                '<p class="m-0">'+response.product[i].kode_barang+'</p>'+
                '<p class="m-0 txt-light">'+response.product[i].nama_barang+'</p>'+
              '</div>'+
              '<div class="d-flex align-items-center">' +
				'<p class="m-0 mr-5">'+response.product[i].merek+'</p>' +
                '<span class="ammount-box bg-secondary mr-1"><i class="mdi mdi-cube-outline"></i></span>'+
                '<p class="m-0">'+response.product[i].stok+'</p>' +
              '</div>'+
            //   '<a href="{{url("adjustment/create/")}}/'+response.product[i].kode_barang+'" class="btn btn-icons btn-rounded btn-inverse-outline-primary font-weight-bold btn-pilih" role="button"><i class="mdi mdi-chevron-right"></i></a>'+
              '<span onclick="pilihBarang('+"&quot;"+response.product[i].kode_barang+"&quot;"+', '+"&quot;"+response.product[i].nama_barang+"&quot;"+', '+"&quot;"+response.product[i].hpp+"&quot;"+', '+"&quot;"+response.product[i].stok+"&quot;"+')" class="btn btn-icons btn-rounded btn-inverse-outline-primary font-weight-bold btn-pilih" role="button"><i class="mdi mdi-chevron-right"></i></span>'+
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
$('input[name=actual_stock]').on('keyup', function(){
	var value = $(this).val()-$('input[name=in_stock]').val()
	$('input[name=stock_difference]').val(value)
});



function resetInput(){
	$('input[name=kode_barang]').val('')
	$('input[name=nama_barang]').val('')
	$('input[name=in_stock]').val('')
	$('input[name=actual_stock]').val('')
	$('input[name=stock_difference]').val('')
	$('textarea[name=note]').val('')
	$('input[name=hpp]').val('')
	$('.input_product').css('display', 'none')
	$('.product_search').css('display', 'block')
}

function changeSaveAdjustment(stat){
	// var error = $('.error_stock_difference_array');
	var er = $('.error_stock_difference_array.error');
	if(er.length>0){
		$('button[name=save_adjustment]').prop('disabled', true)
	}else{
		$('button[name=save_adjustment]').prop('disabled', false)
	}
}

$(function() {
    $("#input_product").click(function() {
		var kode_barang = $('input[name=kode_barang]').val()
		var nama_barang = $('input[name=nama_barang]').val()
		var in_stock = $('input[name=in_stock]').val()
		var actual_stock = $('input[name=actual_stock]').val()
		var stock_difference = $('input[name=stock_difference]').val()
		var hpp = $('input[name=hpp]').val()
		var note = $('textarea[name=note]').val()
		var nominal = stock_difference * hpp;
		if(kode_barang.trim()=="" && nama_barang.trim()=="" && in_stock.trim()=="" && hpp.trim()==""){
			$('#kode_barang_error').prop('hidden', false)
		}else{
			$('#kode_barang_error').prop('hidden', true)
			if(actual_stock.trim()==''){
				$('#actual_stock_error').prop('hidden', false)
			}else{
				$('#actual_stock_error').prop('hidden', true)
				if(stock_difference == 0){
					$('#stock_difference_error').prop('hidden', false)
				}else{
					$('#stock_difference_error').prop('hidden', true)
					var productEl = ''+
					'<tr>'+
						'<td>'+
							nama_barang+
							'<input hidden value="'+kode_barang+'" class="kode_barang_array" name="kode_barang_array[]">'+
						'</td>'+
						'<td>'+
							in_stock+
							'<input hidden value="'+in_stock+'" class="in_stock_array" name="in_stock_array[]">'+
						'</td>'+
						'<td>'+
							'<input type="number" oninput="editItemAdjustment(this)" class="form-control" value="'+actual_stock+'" name="actual_stock_array[]">'+
							'<input type="number" hidden class="hpp_array" value="'+hpp+'" />'+
						'</td>'+
						'<td class="stock_difference">'+
							'<span>'+stock_difference+'</span>'+
							'<br>'+
							'<small class="text-danger error_stock_difference_array" hidden>Tidak ada perubahan</small>'+
						'</td>'+
						'<td class="nominal_array">'+
							(nominal<0 ? '-' : '')+'Rp'+(nominal<0 ? nominal * -1 : nominal).toLocaleString()+
						'</td>'+
						'<td>'+
							'<textarea class="form-control" name="note_array[]">'+
							note+
							'</textarea>'+
						'</td>'+
						'<td>'+
							'<button onclick="deleteBarang(this)" type="button" class="btn btn-icons btn-rounded btn-secondary ml-1 btn-delete">'+
								'<i class="mdi mdi-close"></i>'+
							'</button>'+
						'</td>'+
					'</tr>';
					$('#input_product_list').append(productEl);
					input_product.push(kode_barang)
					changeSaveAdjustment(false)
					resetInput();
					$('button[data-dismiss=modal]').click()
				}
			}
		}
    });
  });

  var input_product = []

function pilihBarang(kode_barang, nama_barang, hpp, stok){
	resetInput();
	$('input[name=kode_barang]').val(kode_barang)
	$('input[name=nama_barang]').val(nama_barang)
	$('input[name=in_stock]').val(stok)
	$('input[name=hpp]').val(hpp)
	$('.product_search').css("display", 'none')
	$('.input_product').css("display", 'block')

}

function editItemAdjustment(self){
	var tr = $(self.closest('tr'));
	var stock_difference = tr.find('.stock_difference');
	var in_stock = tr.find('input.in_stock_array').val();
	var hpp = tr.find('.hpp_array').val();
	var nominal = ($(self).val() - in_stock)*hpp;
	if($(self).val() == in_stock){
		tr.find('.error_stock_difference_array').prop('hidden', false)
		tr.find('.error_stock_difference_array').addClass('error')
	}else{
		tr.find('.error_stock_difference_array').prop('hidden', true)
		tr.find('.error_stock_difference_array').removeClass('error')
	}
	stock_difference.find('span').html($(self).val() - in_stock)
	tr.find('.nominal_array').html((nominal<0 ? '-' : '')+'Rp'+(nominal<0 ? nominal * -1 : nominal).toLocaleString())
	changeSaveAdjustment();
}

function deleteBarang(self){
	var tr = $(self.closest('tr'));
	var kode_barang = tr.find('.kode_barang_array').val();
	var index = input_product.indexOf(kode_barang);
	input_product.splice(index, 1);
	tr.remove()
	if(input_product.length<1){
		$('button[name=save_adjustment]').prop('disabled', true)
	}
	// console.log(kode_barang)
}



</script>
<script type="text/javascript">
	@if ($message = Session::get('create_failed'))
	  swal(
		  "Gagal!",
		  "{{ $message }}",
		  "error"
	  );
	@endif
  </script>
@endsection