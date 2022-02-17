@extends('templates/main')
@section('content')
<link rel="stylesheet" href="{{ asset('css/manage_product/supply_product/supply/style.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	<div class="container">
    <div class="card mt-3 border-0 shadow" style="border-radius: 25px">
        <div class="card-header" style="border-radius: 25px 25px 0 0">
            <h1>Create Category</h1>
        </div>
        <div class="card-body">
            <form action="{{route('category.create')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="" class="label" style="font-weight: 500">Category</label
          >
          <br />
          <input type="text" class="form-control" name="name" />
        </div>
        <br />
        <input
          style="float: right"
          type="submit"
          class="btn btn-primary"
          value="Create"
        />
        <input
          style="float: right"
          type="submit"
          class="btn btn-secondary mr-2"
          value="Cancel"
        />
      </form>
    </div>
  </div>
</div>
@endsection