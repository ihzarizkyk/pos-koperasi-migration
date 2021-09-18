@extends('templates/main')
@section('css')
<link rel="stylesheet" href="{{ asset('css/manage_product/product/style.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
<style>
  #search:hover{
    color: #ffff;
  }
</style>
@endsection
@section('content')
<div class="row page-title-header">
  <div class="col-12">
    <div class="page-header d-flex justify-content-between align-items-center">
      <h4 class="page-title">Daftar Barang</h4>
      <div class="d-flex justify-content-start">
      	<div class="dropdown">
	        <button class="btn btn-icons btn-inverse-primary btn-filter shadow-sm" type="button" id="dropdownMenuIconButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	          <i class="mdi mdi-filter-variant"></i>
	        </button>
	        <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton1">
	          <h6 class="dropdown-header">Urut Berdasarkan :</h6>
	          <div class="dropdown-divider"></div>
	          <a href="{{ route('sort_barang', ['id' => 'kode_barang']) }}" class="dropdown-item filter-btn" data-filter="kode_barang">Kode Barang</a>
            <a href="{{ route('sort_barang', ['id' => 'category_id']) }}" class="dropdown-item filter-btn" data-filter="jenis_barang">Jenis Barang</a>
            <a href="{{ route('sort_barang', ['id' => 'nama_barang']) }}" class="dropdown-item filter-btn" data-filter="nama_barang">Nama Barang</a>
            <a href="{{ route('sort_barang', ['id' => 'berat_barang']) }}" class="dropdown-item filter-btn" data-filter="berat_barang">Berat Barang</a>
            <a href="{{ route('sort_barang', ['id' => 'merek']) }}" class="dropdown-item filter-btn" data-filter="merek">Merek Barang</a>
            @if($supply_system->status == true)
            <a href="{{ route('sort_barang', ['id' => 'stok']) }}" class="dropdown-item filter-btn" data-filter="stok">Stok Barang</a>
            @endif
            <a href="{{ route('sort_barang', ['id' => 'harga']) }}" class="dropdown-item filter-btn" data-filter="harga">Harga Barang</a>
            <a href="{{ route('sort_barang', ['id' => 'harga_jual']) }}" class="dropdown-item filter-btn" data-filter="harga">Harga Jual</a>
	        </div>
	      </div>
        <div class="dropdown dropdown-search">
          <button class="btn btn-icons btn-inverse-primary btn-filter shadow-sm ml-2" type="button" id="dropdownMenuIconButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="mdi mdi-magnify"></i>
          </button>
          <div class="dropdown-menu search-dropdown" aria-labelledby="dropdownMenuIconButton1">
            <div class="row">
              <div class="col-11">
                <form action="{{ route('search_barang') }}" method="GET">
                <div class="input-group">
                  <input type="text" name="cari" class="form-control" placeholder="Cari Barang">
                  <button type="submit" title="Cari" id="search" class="btn btn-outline-success"><i class="bi bi-search"></i></button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <a href="{{ route('export_barang', ['cari' => $cari, 'sort' => $sort]) }}" class="btn btn-icons btn-inverse-primary btn-filter shadow-sm ml-2" title="Export"><i class="bi bi-file-spreadsheet"></i></a>
        </form>
	      <a href="{{ url('/product/new') }}" class="btn btn-icons btn-inverse-primary btn-new ml-2">
	      	<i class="mdi mdi-plus"></i>
	      </a>
        <a href="{{route('category')}}" class="btn btn-inverse-primary btn-new ml-2">
          Kategori
        </a>
      </div>
    </div>
  </div>
</div>
<div class="row modal-group">
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ url('/product/update') }}" method="post" name="update_form">
          <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel">Edit Barang</h5>
            <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="edit-modal-body">
              @csrf
              <div class="row" hidden="">
                <div class="col-12">
                  <input type="text" name="id">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-lg-3 col-md-3 col-sm-12 col-form-label font-weight-bold">Kode Barang</label>
                <div class="col-lg-9 col-md-9 col-sm-12">
                  <input type="text" class="form-control" name="kode_barang" readonly>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 offset-lg-3 offset-md-3 error-notice" id="kode_barang_error"></div>
              </div>
              <div class="form-group row">
                <label class="col-lg-3 col-md-3 col-sm-12 col-form-label font-weight-bold">Jenis Barang</label>
                <div class="col-lg-9 col-md-9 col-sm-12">
                  <select class="form-control" name="kategori" id="kategori" required>
                    <option value="">Pilih Kategori</option>
                    @foreach ($category as $item)
                      <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-lg-3 col-md-3 col-sm-12 col-form-label font-weight-bold">Nama Barang</label>
                <div class="col-lg-9 col-md-9 col-sm-12">
                  <input type="text" class="form-control" name="nama_barang">
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 offset-lg-3 offset-md-3 error-notice" id="nama_barang_error"></div>
              </div>
              <div class="form-group row">
                <label class="col-lg-3 col-md-3 col-sm-12 col-form-label font-weight-bold">Berat Barang</label>
                <div class="col-lg-9 col-md-9 col-sm-12">
                  <div class="input-group">
                      <input type="text" class="form-control number-input input-notzero" name="berat_barang">
                      <div class="input-group-append">
                        <select class="form-control" name="satuan_berat">
                          <option value="kg">Kilogram</option>
                          <option value="g">Gram</option>
                          <option value="ml">Miligram</option>
                          <option value="oz">Ons</option>
                          <option value="l">Liter</option>
                          <option value="ml">Mililiter</option>
                        </select>
                      </div>
                    </div>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-lg-3 col-md-3 col-sm-12 col-form-label font-weight-bold">Merek Barang</label>
                <div class="col-lg-9 col-md-9 col-sm-12">
                  <input type="text" class="form-control" name="merek">
                </div>
              </div>
              <div class="form-group row" @if($supply_system->status == false) hidden="" @endif>
                <label class="col-lg-3 col-md-3 col-sm-12 col-form-label font-weight-bold">Stok Barang</label>
                <div class="col-lg-9 col-md-9 col-sm-12">
                  <input type="text" class="form-control number-input" name="stok">
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 offset-lg-3 offset-md-3 error-notice" id="stok_error"></div>
              </div>
              <div class="form-group row">
                <label class="col-lg-3 col-md-3 col-sm-12 col-form-label font-weight-bold">Harga Barang</label>
                <div class="col-lg-9 col-md-9 col-sm-12">
                  <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">Rp. </span>
                      </div>
                      <input type="text" id="harga" class="form-control number-input input-notzero" name="harga">
                  </div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 offset-lg-3 offset-md-3 error-notice" id="harga_error"></div>
              </div>
              <div class="form-group row">
                <label class="col-lg-3 col-md-3 col-sm-12 col-form-label font-weight-bold">Laba Rupiah</label>
                <div class="col-lg-9 col-md-9 col-sm-12">
                  <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">Rp. </span>
                      </div>
                      <input type="text" id="laba_rupiah" class="form-control number-input input-notzero" name="laba_rupiah">
                  </div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 offset-lg-3 offset-md-3 error-notice" id="laba_rupiah_error"></div>
              </div>
              <div class="form-group row">
                <label class="col-lg-3 col-md-3 col-sm-12 col-form-label font-weight-bold">Hpp Barang</label>
                <div class="col-lg-9 col-md-9 col-sm-12">
                  <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">Rp. </span>
                      </div>
                      <input type="text" id="hpp" class="form-control number-input input-notzero" name="hpp">
                  </div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 offset-lg-3 offset-md-3 error-notice" id="harga_error"></div>
              </div>
          </div>
          <div class="modal-body" id="scan-modal-body" hidden="">
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
          <div class="modal-footer" id="edit-modal-footer">
            <button type="submit" class="btn btn-update"><i class="mdi mdi-content-save"></i> Simpan</button>
          </div>
          <div class="modal-footer" id="scan-modal-footer" hidden="">
            <button type="button" class="btn btn-primary btn-sm font-weight-bold rounded-0 btn-continue">Lanjutkan</button>
            <button type="button" class="btn btn-outline-secondary btn-sm font-weight-bold rounded-0 btn-repeat">Ulangi</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12">
    <div class="alert alert-primary d-flex justify-content-between align-items-center" role="alert">
      @if($supply_system->status == false)
      <div class="text-instruction">
        <i class="mdi mdi-information-outline mr-2"></i> Aktifkan sistem stok dan pasok barang dengan klik tombol disamping
      </div>
      <a href="{{ url('/supply/system/active') }}" class="btn stok-btn">Aktifkan</a>
      @else
      <div class="text-instruction">
        <i class="mdi mdi-information-outline mr-2"></i> Nonaktifkan sistem stok dan pasok barang dengan klik tombol disamping
      </div>
      <a href="{{ url('/supply/system/nonactive') }}" class="btn stok-btn">Nonaktifkan</a>
      @endif
    </div>
  </div>
  <div class="col-12 grid-margin">
    <div class="card card-noborder b-radius">
      <div class="card-body">
        <div class="row">
        	<div class="col-12 table-responsive">
        		<table class="table table-custom">
              <thead>
                <tr>
                  <th>Barang</th>
                  <th>Jenis</th>
                  <th>Berat</th>
                  <th>Merk</th>
                  @if($supply_system->status == true)
                  <th>Stok</th>
                  @endif
                  <th>Harga</th>
                  <th>HPP</th>
                  <th>Laba Rupiah</th>
                  <th>Laba Persen</th>
                  <th>Keterangan</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @if ($data == 0)
                  <tr>
                    <td colspan="11" style="text-align: center">
                      <div class="alert alert-secondary" role="alert">
                        Data Tidak Ditemukan
                      </div>
                    </td>
                  </tr>
                @else
                  @foreach($products as $product)
                    <tr>
                      <td>
                        <span class="kd-barang-field">{{ $product->kode_barang }}</span><br><br>
                        <span class="nama-barang-field">{{ $product->nama_barang }}</span>
                      </td>
                      <td>{{ $product->Category->name ?? 'null' }}</td>
                      <td>{{ $product->berat_barang ?? 'null'}}</td>
                      <td>{{ $product->merek ?? 'null'}}</td>
                      @if($supply_system->status == true)
                      <td><span class="ammount-box bg-secondary"><i class="mdi mdi-cube-outline"></i></span>{{ $product->stok }}</td>
                      @endif
                      <td><span class="ammount-box bg-green"><i class="mdi mdi-coin"></i></span>Rp. {{number_format($product->harga,2,',','.')}}</td>
                      <td><span class="ammount-box bg-green"><i class="mdi mdi-coin"></i></span>Rp. {{number_format($product->hpp,2,',','.')}}</td>
                      <td>Rp. {{number_format($product->laba_rupiah, 2, ',', '.')}}</td>
                      <td>{{ $product->laba_persen }}%</td>
                      @if($supply_system->status == true)
                      <td>
                        @if($product->keterangan == 'Tersedia')
                        <span class="btn tersedia-span"> {{ $product->keterangan }}</span>
                        @else
                        <span class="btn habis-span">{{ $product->keterangan }} </span>
                        @endif
                      </td>
                      @endif
                      <td>
                        <button type="button" class="btn btn-edit btn-icons btn-rounded btn-secondary" data-toggle="modal" data-target="#editModal" data-edit="{{ $product->id }}">
                            <i class="mdi mdi-pencil"></i>
                        </button>
                        <button type="button" class="btn btn-icons btn-rounded btn-secondary ml-1 btn-delete" data-delete="{{ $product->id }}">
                            <i class="mdi mdi-close"></i>
                        </button>
                      </td>
                    </tr>
                  @endforeach
                @endif
              </tbody>
            </table>
        	</div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
<script src="{{ asset('plugins/js/quagga.min.js') }}"></script>
<script src="{{ asset('js/manage_product/product/script.js') }}"></script>
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

	var hpp = document.getElementById('hpp');
  hpp.addEventListener('keyup', function(e){
      hpp.value = formatHpp(this.value, '');
  });
            
  function formatHpp(input, hasil){
    var number_string = input.replace(/[^,\d]/g, '').toString(),
    split   		= number_string.split(','),
    sisa     		= split[0].length % 3,
    hpp     		= split[0].substr(0, sisa),
    ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
    
    if(ribuan){
        separator = sisa ? '.' : '';
        hpp += separator + ribuan.join('.');
    }
    
    hpp = split[1] != undefined ? hpp + ',' + split[1] : hpp;
    return hasil == undefined ? hpp : (hpp ? '' + hpp : '');
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

  @if ($message = Session::get('update_success'))
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

  @if ($message = Session::get('update_failed'))
    swal(
        "",
        "{{ $message }}",
        "error"
    );
  @endif

  @if ($message = Session::get('supply_system_status'))
    swal(
        "",
        "{{ $message }}",
        "success"
    );
  @endif

  // $(document).on('click', '.filter-btn', function(e){
  //   e.preventDefault();
  //   var data_filter = $(this).attr('data-filter');
    
  //   $.ajax({
  //     method: "GET",
  //     url: "{{ url('/product/filter') }}/" + data_filter,
  //     success:function(data)
  //     {
  //       $('tbody').html(data);
  //     }
  //   });
  // });

  $(document).on('click', '.btn-edit', function(){
    var data_edit = $(this).attr('data-edit');
    $.ajax({
      method: "GET",
      url: "{{ url('/product/edit') }}/" + data_edit,
      success:function(response)
      {
        $('input[name=id]').val(response.product.id);
        $('input[name=kode_barang]').val(response.product.kode_barang);
        $('input[name=nama_barang]').val(response.product.nama_barang);
        $('input[name=merek]').val(response.product.merek);
        $('input[name=stok]').val(response.product.stok);
        $('input[name=harga]').val(response.product.harga);
        $('input[name=laba_rupiah]').val(response.product.laba_rupiah);
        $('input[name=hpp]').val(response.product.hpp);
        $('select[name=kategori] option[value="'+ response.product.category_id +'"]').prop('selected', true);
        var berat_barang = response.product.berat_barang.split(" ");
        $('input[name=berat_barang]').val(berat_barang[0]);
        $('select[name=satuan_berat] option[value="'+ berat_barang[1] +'"]').prop('selected', true);
        validator.resetForm();
      }
    });
  });

  $(document).on('click', '.btn-delete', function(e){
    e.preventDefault();
    var data_delete = $(this).attr('data-delete');
    swal({
      title: "Apa Anda Yakin?",
      text: "Data barang akan terhapus, klik oke untuk melanjutkan",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        window.open("{{ url('/product/delete') }}/" + data_delete, "_self");
      }
    });
  });
</script>
@endsection