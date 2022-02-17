@extends('templates/main')
@section('css')
<link rel="stylesheet" href="{{ asset('css/manage_product/supply_product/supply/style.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer"
    />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300&display=swap" rel="stylesheet">
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
<div class="row page-title-header" style="font-family: Rubik">
  <div class="col-12">
    <div class="page-header d-flex justify-content-between align-items-center">
      <h4 class="page-title">Supplier</h4>
      <div class="d-flex justify-content-start">
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
          <a href="{{route('supplier.new')}}" class="btn btn-icons btn-inverse-primary btn-new ml-2" title="Mulai Shift">
            <i class="mdi mdi-plus"></i>
          </a>
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
             
              
              <div class="table-responsive">
                <table class="table table-custom">
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Asal</th>
                    <th>Perusahaan</th>
                    <th>Alamat</th>
                    <th>Telepon</th>
                    <th>Email</th>
                    <th>Aksi</th>
                  </tr>
                 
                  @foreach ($suplier as $sp)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$sp->nama}}</td>
                        <td>{{$sp->asal}}</td>
                        <td>{{$sp->perusahaan}}</td>
                        <td>{{$sp->alamat}}</td>
                        <td>{{$sp->telepon}}</td>
                        <td>{{$sp->email}}</td>
                        <td>
                            <a class="btn btn-edit btn-icons btn-rounded btn-secondary" style="background-color: rgb(150, 150, 150)" href="/supplier/{{$sp->id}}/edit">
                                <i class="mdi mdi-pencil" style="color: white;" ></i></a>

                            <a
                                class="btn btn-edit btn-icons btn-rounded btn-danger"
                                href="/supplier/{{$sp->id}}/delete">
                                <i class="bi bi-trash"></i>
                            </a>
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