<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier</title>
</head>
<body>
    <div class="container">

        <a href="/supply" class="btn btn-info mt-3 ml-2 float-right">
            View Supply
        </a>

        <a href="{{route('supplier.new')}}" class="btn btn-info mt-3 ml-2 float-right">
            Create
        </a>

        <table class="table table-hover mt-3" id="supplier">
            <thead>
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
            </thead>
            <tbody>
                @foreach($suplier as $sp)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$sp->nama}}</td>
                    <td>{{$sp->asal}}</td>
                    <td>{{$sp->perusahaan}}</td>
                    <td>{{$sp->alamat}}</td>
                    <td>{{$sp->telepon}}</td>
                    <td>{{$sp->email}}</td>
                    <td>
                        <a href="/supplier/{{$sp->id}}/edit" class="btn btn-warning btn-sm">edit</a>
                        <a href="/supplier/{{$sp->id}}/delete" class="btn btn-danger btn-sm">delete</a>
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
            $('#supplier').DataTable();
        } );
    </script>  
</body>
</html>