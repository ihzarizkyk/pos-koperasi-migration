<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<title>Suplier</title>
</head>
<body>
	<div class="container">
				<div class="card mt-3 mb-3">
			<div class="card-header">
				<h1>Data Suplier</h1>
			</div>
			<div class="card-body">
				<form action="{{route('supplier.create')}}" method="post">
					@csrf
					<div class="form-group">
						<label for="" class="label">Nama</label>
						<br>
						<input type="text" class="form-control" name="nama">
					</div>
					<div class="form-group">
						<label for="" class="label">Alamat</label>
						<br>
						<input type="text" class="form-control" name="alamat">
					</div>
					<div class="form-group">
						<label for="" class="label">Asal</label>
						<br>
						<input type="text" class="form-control" name="asal">
					</div>
					<div class="form-group">
						<label for="" class="label">Perusahaan</label>
						<br>
						<input type="text" class="form-control" name="perusahaan">
					</div>
					<div class="form-group">
						<label for="" class="label">Telepon</label>
						<br>
						<input type="number" class="form-control" name="telepon">
					</div>
					<div class="form-group">
						<label for="" class="label">Email</label>
						<br>
						<input type="text" class="form-control" name="email">
					</div>
					<br>
					<input type="submit" class="btn btn-success" value="CREATE">
				</form>
			</div>
		</div>
	</div>
</body>
</html>