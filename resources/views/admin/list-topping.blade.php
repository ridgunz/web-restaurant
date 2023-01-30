@extends('layouts.menu')

@section('content')

{{-- add new topping modal start --}}
<div class="modal fade" id="addToppingModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Topping</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="add_topping_form" enctype="multipart/form-data">
        @csrf
        <div class="modal-body p-4 bg-light">
            <div class="my-2">
              <label for="nama">Nama</label>
              <input type="text" name="nama" class="form-control" required>
            </div>
          <div class="my-2">
            <label for="deskripsi">Deskripsi</label>
            <input type="text" name="deskripsi" class="form-control" required>
          </div>
          <div class="my-2">
            <label for="harga">Harga</label>
            <input type="text" name="harga" class="form-control" required>
          </div>
          <div class="my-2">
            <label for="stock">Stock</label>
            <input type="text" name="stock" class="form-control" required>
          </div>
          <div class="my-2">
          <label for="is_active" class="col-sm-12 control-label">Aktif</label>
                <div class="col-sm-12">
                  <select name="is_active" id="is_active" class="form-control" required>
                    <option value="">Choose</option> 
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                  </select>
                </div>
          </div>
          <div class="my-2">
            <label for="image">Select Image</label>
            <input type="file" name="image" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="add_topping_btn" class="btn btn-primary">Add Topping</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- add new topping modal end --}}

{{-- edit topping modal start --}}
<div class="modal fade" id="editToppingModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Topping</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="edit_topping_form" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="topping_id" id="topping_id">
        <input type="hidden" name="topping_image" id="topping_image">
        <div class="modal-body p-4 bg-light">
            <div class="my-2">
              <label for="nama">Nama</label>
              <input type="text" name="nama" id="nama" class="form-control" required>
            </div>
            <div class="my-2">
              <label for="lname">Deskripsi</label>
              <input type="text" name="deskripsi" id="deskripsi" class="form-control" required>
            </div>
          <div class="my-2">
            <label for="text">Harga</label>
            <input type="text" name="harga" id="harga" class="form-control" required>
          </div>
          <div class="my-2">
            <label for="stock">Stock</label>
            <input type="text" name="stock" id="stock" class="form-control" required>
          </div>
          <div class="my-2">
          <label for="is_active" class="col-sm-12 control-label">Aktif</label>
                <div class="col-sm-12">
                  <select name="is_active" id="is_active" class="form-control" required>
                    <option value="">Choose</option> 
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                  </select>
                </div>
          </div>
          <div class="my-2">
            <label for="image">Select Image</label>
            <input type="file" name="image" class="form-control">
          </div>
          <div class="mt-2" id="image">

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="edit_topping_btn" class="btn btn-success">Update Topping</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- edit topping modal end --}}

<body class="bg-light">
  <div class="container">
    <div class="row my-5">
      <div class="col-lg-12">
        <div class="card shadow">
          <div class="card-header bg-danger d-flex justify-content-between align-items-center">
            <h3 class="text-light">Manage Topping</h3>
            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addToppingModal"><i
                class="bi-plus-circle me-2"></i>Add Topping</button>
          </div>
          <div class="card-body" id="show_all_toppings">
            <h1 class="text-center text-secondary my-5">Loading...</h1>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js'></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    $(function() {


       // add new topping ajax request
       $("#add_topping_form").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#add_topping_btn").text('Adding...');
        $.ajax({
          url: '{{ route('storeTopping') }}',
          method: 'post',
          data: fd,
          cache: false,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function(response) {
            if (response.status == 200) {
              Swal.fire(
                'Added!',
                'Topping Added Successfully!',
                'success'
              )
              fetchAllTopping();
            }
            $("#add_topping_btn").text('Add Topping');
            $("#add_topping_form")[0].reset();
            $("#addToppingModal").modal('hide');
          }
        });
      });

      // edit topping ajax request
      $(document).on('click', '.editIcon', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        $.ajax({
          url: '{{ route('editTopping') }}',
          method: 'get',
          data: {
            id: id,
            _token: '{{ csrf_token() }}'
          },
          success: function(response) {
            $("#nama").val(response.nama);
            $("#deskripsi").val(response.deskripsi);
            $("#harga").val(response.amount);
            $("#stock").val(response.stock);
            $("#is_active").val(response.is_active);
            $("#image").html(
              `<img src="storage/images/${response.image}" width="100" class="img-fluid img-thumbnail">`);
            $("#topping_id").val(response.id);
            $("#topping_image").val(response.image);
          }
        });
      });

       // update topping ajax request
       $("#edit_topping_form").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#edit_topping_btn").text('Updating...');
        $.ajax({
          url: '{{ route('updateTopping') }}',
          method: 'post',
          data: fd,
          cache: false,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function(response) {
            if (response.status == 200) {
              Swal.fire(
                'Updated!',
                'Topping Updated Successfully!',
                'success'
              )
              fetchAllTopping();
            }
            $("#edit_topping_btn").text('Update Topping');
            $("#edit_topping_form")[0].reset();
            $("#editToppingModal").modal('hide');
          }
        });
      });

       // delete topping ajax request
       $(document).on('click', '.deleteIcon', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        let csrf = '{{ csrf_token() }}';
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: '{{ route('deleteTopping') }}',
              method: 'delete',
              data: {
                id: id,
                _token: csrf
              },
              success: function(response) {
                console.log(response);
                Swal.fire(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success'
                )
                fetchAllTopping();
              }
            });
          }
        })
      });

     
      // fetch all topping ajax request
      fetchAllTopping();

      function fetchAllTopping() {
        $.ajax({
          url: '{{ route('fetchAllTopping') }}',
          method: 'get',
          success: function(response) {
            $("#show_all_toppings").html(response);
            $("table").DataTable({
              order: [0, 'desc'],
              responsive: true
            });
          }
        });
      }
    });
  </script>
</body>

@endsection