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
        <a href="{{route('category.new')}}" class="btn btn-warning float-right mt-3">
            Create Category
        </a>
        <a href="/product" class="btn btn-info float-right mt-3 mr-2">
            Product View
        </a>  
        <br><br>
        <table class="table table-hover" id="category">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($category as $indeks)
                <tr>
                    <td scope="row">{{$loop->iteration}}</td>
                    <td>{{$indeks->name}}</td>
                    <td>
<<<<<<< HEAD
                        <a class="btn btn-sm btn-warning" href="{{ route('category.edit', $indeks->id) }}">
=======
                        <a class="btn btn-sm btn-warning" href="/category/{{$indeks->id}}/edit">
>>>>>>> 8b89de85d390654f3b223af49246284a8672e46b
                        Edit</a>

                        <a class="btn btn-sm btn-danger" href="{{ route('deleteCategory', $indeks->id) }}">
                        Delete
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
	</div>

<script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready( function () {
            $('#category').DataTable();
        } );
    </script>
</body>
</html>