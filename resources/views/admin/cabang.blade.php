@extends('layouts.menu')

@section('content')

{{-- add new cabang modal start --}}
<div class="modal fade" id="addCabangModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Cabang</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="add_cabang_form" enctype="multipart/form-data">
        @csrf
        <div class="modal-body p-4 bg-light">
            <div class="my-2">
              <label for="nama">Nama Cabang</label>
              <input type="text" name="nama_cabang" class="form-control" required>
            </div>
          <div class="my-2">
          <label for="is_active" class="col-sm-12 control-label">Aktif</label>
                <div class="col-sm-12">
                  <select name="is_active" class="form-control" required>
                    <option value="">Choose</option> 
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                  </select>
                </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="add_cabang_btn" class="btn btn-primary">Add Cabang</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- add new cabang modal end --}}

{{-- edit cabang modal start --}}
<div class="modal fade" id="editCabangModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Cabang</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="edit_cabang_form" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="cabang_id" id="cabang_id">
        <div class="modal-body p-4 bg-light">
            <div class="my-2">
              <label for="nama">Nama Cabang</label>
              <input type="text" name="nama_cabang" id="nama_cabang" class="form-control" required>
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
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="edit_cabang_btn" class="btn btn-success">Update Cabang</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- edit cabang modal end --}}

<body class="bg-light">
  <div class="container">
    <div class="row my-5">
      <div class="col-lg-12">
        <div class="card shadow">
          <div class="card-header bg-danger d-flex justify-content-between align-items-center">
            <h3 class="text-light">Manage Cabang</h3>
            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addCabangModal"><i
                class="bi-plus-circle me-2"></i>Add New Cabang</button>
          </div>
          <div class="card-body" id="show_all_cabangs">
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


       // add new cabang ajax request
       $("#add_cabang_form").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#add_cabang_btn").text('Adding...');
        $.ajax({
          url: '{{ route('storeCabang') }}',
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
                'Cabang Added Successfully!',
                'success'
              )
              fetchAllCabangs();
            }
            $("#add_cabang_btn").text('Add Cabang');
            $("#add_cabang_form")[0].reset();
            $("#addCabangModal").modal('hide');
          }
        });
      });

      // edit cabang ajax request
      $(document).on('click', '.editIcon', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        $.ajax({
          url: '{{ route('editCabang') }}',
          method: 'get',
          data: {
            id: id,
            _token: '{{ csrf_token() }}'
          },
          success: function(response) {
            $("#nama_cabang").val(response.nama_cabang);
            $("#is_active").val(response.is_active);
            $("#cabang_id").val(response.id);
          }
        });
      });

       // update cabang ajax request
       $("#edit_cabang_form").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#edit_cabang_btn").text('Updating...');
        $.ajax({
          url: '{{ route('updateCabang') }}',
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
                'Cabang Updated Successfully!',
                'success'
              )
              fetchAllCabangs();
            }
            $("#edit_cabang_btn").text('Update Cabang');
            $("#edit_cabang_form")[0].reset();
            $("#editCabangModal").modal('hide');
          }
        });
      });

       // delete cabang ajax request
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
              url: '{{ route('deleteCabang') }}',
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
                fetchAllCabangs();
              }
            });
          }
        })
      });

     
      // fetch all cabang ajax request
      fetchAllCabangs();

      function fetchAllCabangs() {
        $.ajax({
          url: '{{ route('fetchAllCabang') }}',
          method: 'get',
          success: function(response) {
            $("#show_all_cabangs").html(response);
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