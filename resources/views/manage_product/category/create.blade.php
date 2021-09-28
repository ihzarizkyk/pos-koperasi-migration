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
    <h1>Create Category</h1>
   </div>
   <div class="card-body">
    <form action="{{route('category.create')}}" method="post">
     @csrf
     <div class="form-group">
      <label for="" class="label">Category</label>
      <br>
      <input type="text" class="form-control" name="name">
     </div>
     <br>
     <input style="float: right;" type="submit" class="btn btn-success" value="Create">
    </form>
   </div>
  </div>
	</div>
</body>
</html>