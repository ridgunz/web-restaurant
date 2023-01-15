@extends('layouts.app')

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
                      <th>Aktif</th>
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

<!-- MULAI MODAL-->
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="modal fade" id="myModal" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-total-judul"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="form-edit-total" name="form-edit-total" class="form-horizontal">
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label for="id" class="col-sm-12 control-label" hidden>ID</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" id="id" name="id" hidden>
                </div>
              </div>
              <div class="form-group">
                <label for="nama" class="col-sm-12 control-label">Nama Menu</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" id="nama" name="nama">
                </div>
              </div>
              <div class="form-group">
                <label for="deskripsi" class="col-sm-12 control-label">Deskripsi</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" id="deskripsi" name="deskripsi">
                </div>
              </div>
              <div class="form-group">
                <label for="amount" class="col-sm-12 control-label">Harga</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" id="amount" name="amount">
                </div>
              </div>
              <div class="form-group">
                <label for="image" class="col-sm-12 control-label">Gambar</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" id="image" name="image">
                </div>
              </div>
              <div class="form-group">
                <label for="stock" class="col-sm-12 control-label">Stock</label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" id="stock" name="stock">
                </div>
              </div>
              <div class="form-group">
                <label for="is_active" class="col-sm-12 control-label">Aktif</label>
                <div class="col-sm-12">
                  <select name="is_active" id="is_active" class="form-control">
                    <option value="">Choose</option> 
                    <option value="1">Yes</option>
                    <option value="2">No</option>
                  </select>
                </div>
              </div>
            </div>
            <br>
            <div class="col-sm-offset-2 col-sm-12">
              <button type="submit" class="btn btn-primary btn-block" id="tombol-total-simpan" value="create">Simpan </button>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer"></div>
    </div>
  </div>
</div>
<!-- AKHIR MODAL -->

@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">
 $(function () {
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
            {data: 'is_active',
              render: function(data, type, row) {
                if(data == '1') {  
                    return 'Yes'; 
                }else if (data == '0' ) {
                    return 'No'; 
                }
              }
            },
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