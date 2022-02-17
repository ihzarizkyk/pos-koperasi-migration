@extends('templates/main')
@section('content')
<link rel="stylesheet" href="{{ asset('css/manage_product/supply_product/supply/style.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
<div class="container">
    <div class="card mt-3 border-0 shadow" style="border-radius: 25px">
        <div class="card-header" style="border-radius: 25px 25px 0 0">
            <h1>Edit Supplier</h1>
        </div>
        <div class="card-body">
			@foreach($data as $datas)
				<form action="{{route('supplier.update')}}" method="post">
					@csrf
                    <input type="hidden" name="id" value="{{$datas->id}}">
					<div class="form-group">
						<label for="" class="label">Nama</label>
						<br>
						<input type="text" class="form-control" name="nama" value="{{$datas->nama}}">
					</div>
					<div class="form-group">
						<label for="" class="label">Alamat</label>
						<br>
						<input type="text" class="form-control" name="alamat" value="{{$datas->alamat}}">
					</div>
					<div class="form-group">
						<label for="" class="label">Asal</label>
						<br>
						<input type="text" class="form-control" name="asal" value="{{$datas->asal}}">
					</div>
					<div class="form-group">
						<label for="" class="label">Perusahaan</label>
						<br>
						<input type="text" class="form-control" name="perusahaan" value="{{$datas->perusahaan}}">
					</div>
					<div class="form-group">
						<label for="" class="label">Telepon</label>
						<br>
						<input type="number" class="form-control" name="telepon" value="{{$datas->telepon}}">
					</div>
					<div class="form-group">
						<label for="" class="label">Email</label>
						<br>
						<input type="text" class="form-control" name="email" value="{{$datas->email}}">
					</div>
					<br>
					<input
					style="float: right"
					type="submit"
					class="btn btn-primary"
					value="Update"
					/>
					<a href="{{ route('supplier') }}" type="button" style="float: right" class="btn btn-danger mr-3">cancel</a>
				</form>
				@endforeach
		</div>
	</div>
</div>
@endsection

