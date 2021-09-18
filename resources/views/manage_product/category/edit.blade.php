<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<title>Category</title>
</head>
<body>
	<div class="container">
<div class="card mt-3">
   <div class="card-header">
    <h1>Edit Category</h1>
   </div>
   <div class="card-body">
<<<<<<< HEAD
    <form action="{{ route('category.update', $data->id) }}" method="POST">
     @csrf
     <div class="form-group">
      <label for="" class="label">Nama</label>
      <br>
      <input type="text" class="form-control" name="nama" value="{{$data->name}}" required>
=======
   @foreach($category as $ct)
    <form action="#" method="#">
     @csrf
     <input type="hidden" name="id" value="{{$ct->id}}">
     <div class="form-group">
      <label for="" class="label">Nama</label>
      <br>
      <input type="text" class="form-control" name="nama" value="{{$ct->name}}">
>>>>>>> 8b89de85d390654f3b223af49246284a8672e46b
     </div>
     <br>
     <input style="float: right;" type="submit" class="btn btn-success" value="Update">
    </form>
<<<<<<< HEAD
=======
    @endforeach
>>>>>>> 8b89de85d390654f3b223af49246284a8672e46b
   </div>
  </div>
	</div>
</body>
</html>