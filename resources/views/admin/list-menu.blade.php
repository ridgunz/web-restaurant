@extends('layouts.layout')

@section('content')

<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"/>
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('List Menu Makanan') }}</div>
                <div class="card-body">
                <table class="table data-menu">
                  <thead class="thead-dark">
                    <tr>
                      <th>ID</th>
                      <th>Nama Menu</th>
                      <th>Deskripsi</th>
                      <th>Harga</th>
                      <th>Gambar</th>
                      <th>Stock</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <!-- Masukan data disini -->
                </table>
                </div>
            </div>
            <br>
            <br>
            <br>
            <div class="card">
                <div class="card-header">{{ __('List Menu Minuman') }}</div>
                <div class="card-body">
                <table class="table data-minuman">
                  <thead class="thead-dark">
                    <tr>
                      <th>No</th>
                      <th>Nama Menu</th>
                      <th>Deskripsi</th>
                      <th>Harga</th>
                      <th>Gambar</th>
                      <th>Stock</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <!-- Masukan data disini -->
                </table>
                </div>
            </div>
          <br>
            <br>
            <br>
            <div class="card">
                <div class="card-header">{{ __('List Menu Topping') }}</div>
                <div class="card-body">
                <table class="table data-topping">
                  <thead class="thead-dark">
                    <tr>
                      <th>No</th>
                      <th>Nama Menu</th>
                      <th>Deskripsi</th>
                      <th>Harga</th>
                      <th>Gambar</th>
                      <th>Stock</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <!-- Masukan data disini -->
                </table>
                </div>
            </div>
          </div>
        </div>
    </div>
</div>

@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">
 $(function () {
    var table = $('.data-menu').DataTable({
        processing: true,
        serverSide: true,
        ordering: false,
        searching:true,
        info:false,
        lengthChange: false,
        ajax: "{{ route('list-menu') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'nama', name: 'nama',  width: '120px'},
            {data: 'deskripsi', name: 'deskripsi',  width: '150px'},
            {data: 'amount', name: 'amount'},
            {data: 'image', name: 'image'},
            {data: 'stock', name: 'stock'},
            {
                data: 'action', 
                name: 'action', 
                orderable: false, 
                searchable: false,
                width: '200px',
            },
        ]
    });
    

    var table = $('.data-minuman').DataTable({
        processing: true,
        serverSide: true,
        ordering: false,
        searching:true,
        info:false,
        lengthChange: false,
        ajax: "{{ route('list-minuman') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'nama', name: 'nama',  width: '120px'},
            {data: 'deskripsi', name: 'deskripsi',  width: '150px'},
            {data: 'amount', name: 'amount'},
            {data: 'image', name: 'image'},
            {data: 'stock', name: 'stock'},
            {
                data: 'action', 
                name: 'action', 
                orderable: false, 
                searchable: false,
                width: '200px',
            },
        ]
    });

    var table = $('.data-topping').DataTable({
        processing: true,
        serverSide: true,
        ordering: false,
        searching:true,
        info:false,
        lengthChange: false,
        ajax: "{{ route('list-topping') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'nama', name: 'nama',  width: '120px'},
            {data: 'deskripsi', name: 'deskripsi',  width: '150px'},
            {data: 'amount', name: 'amount'},
            {data: 'image', name: 'image'},
            {data: 'stock', name: 'stock'},
            {
                data: 'action', 
                name: 'action', 
                orderable: false, 
                searchable: false,
                width: '200px',
            },
        ]
    });
    
  });
</script>