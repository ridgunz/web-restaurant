@extends('layouts.menu')

@section('content')

{{-- add new makanan modal start --}}
<div class="modal fade" id="addmakananModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Makanan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="add_makanan_form" enctype="multipart/form-data">
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
                  <label for="cabang" class="col-sm-12 control-label">Cabang</label>
                  <div class="col-sm-12">
                     <select name="cabang" class="form-control" required>
                     <option value="">Choose</option> @foreach($cabangs as $cabang) <option value="{{ trim($cabang->id) }}">
                      {{ $cabang->nama_cabang }}
                    </option> @endforeach
                     </select>
                  </div>
                  <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-cabang"></div>
               </div>
          <div class="my-2">
            <label for="image">Select Image</label>
            <input type="file" name="image" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="add_makanan_btn" class="btn btn-primary">Add makanan</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- add new makanan modal end --}}

{{-- edit makanan modal start --}}
<div class="modal fade" id="editMakananModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit makanan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="edit_makanan_form" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="makanan_id" id="makanan_id">
        <input type="hidden" name="makanan_image" id="makanan_image">
        <div class="modal-body p-4 bg-light">
            <div class="my-2">
              <label for="nama">Nama</label>
              <input type="text" name="nama" id="nama" class="form-control" required>
            </div>
            <div class="my-2">
              <label for="deskripsi">Deskripsi</label>
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
                  <label for="cabang" class="col-sm-12 control-label">Cabang</label>
                  <div class="col-sm-12">
                     <select name="cabang" class="form-control" required>
                     <option value="">Choose</option> @foreach($cabangs as $cabang) <option value="{{ trim($cabang->id) }}">
                      {{ $cabang->nama_cabang }}
                    </option> @endforeach
                     </select>
                  </div>
                  <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-cabang"></div>
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
          <button type="submit" id="edit_makanan_btn" class="btn btn-success">Update makanan</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- edit makanan modal end --}}

<body class="bg-light">
  <div class="container">
    <div class="row my-5">
      <div class="col-lg-12">
      <div class="form-control">
                <select id="cabang" class="form-control" style="width: 200px">
                <option value="">--Pilih Cabang--</option> @foreach($cabangs as $cabang) <option value="{{ trim($cabang->id) }}">
                      {{ $cabang->nama_cabang }}
                    </option> @endforeach
                </select>
           </div>
           <br>
        <div class="card shadow">
          <div class="card-header bg-danger d-flex justify-content-between align-items-center">
            <h3 class="text-light">Manage Makanan</h3>
            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addmakananModal"><i
                class="bi-plus-circle me-2"></i>Add New Makanan</button>
          </div>
          <div class="card-body" id="show_all_makanans">
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

      $('#cabang').change(function(){
      var cabang = $('#cabang').val();
      $('#table').DataTable().destroy();
      fetchAllMakananx(cabang);
    });

    var _token = $('input[name="_token"]').val();

    function fetchAllMakananx(cabang = '')
      {
        $.ajax({
        url:"{{ route('fetchAllMakananx') }}",
        method:"POST",
        data:{cabang:cabang, _token:_token},
        dataType:"json",
        success:function(data)
        {
          var output = '';
          for(var count = 0; count < data.length; count++)
          {
          output += '<tr>';
          output += '<td>' + data[count].id + '</td>';
          output += '<td> <img src="storage/images/' + data[count].image + '" width="50" class="img-thumbnail"></td>'
          output += '<td>' + data[count].nama + '</td>';
          output += '<td>' + data[count].deskripsi + '</td>';
          output += '<td>' + data[count].amount + '</td>';
          output += '<td>' + data[count].stock + '</td>';
          output += '<td>' + data[count].nama_cabang + '</td>';
          output += '<td>' + data[count].is_active + '</td>';
          output += '<td><a href="#" id="' + data[count].id + '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editMakananModal"><i class="bi-pencil-square h4"></i></a>  <a href="#" id="' + data[count].id + '" class="text-danger mx-1 deleteIcon"><i class="bi-trash h4"></i></a> </td></tr>';
          
          }
          $('tbody').html(output);
              }
              })
      }



       // add new makanan ajax request
       $("#add_makanan_form").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#add_makanan_btn").text('Adding...');
        $.ajax({
          url: '{{ route('store') }}',
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
                'Makanan Added Successfully!',
                'success'
              )
              fetchAllmakanans();
            }
            $("#add_makanan_btn").text('Add Makanan');
            $("#add_makanan_form")[0].reset();
            $("#addmakananModal").modal('hide');
          }
        });
      });

      // edit makanan ajax request
      $(document).on('click', '.editIcon', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        $.ajax({
          url: '{{ route('edit') }}',
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
            $("#makanan_id").val(response.id);
            $("#makanan_image").val(response.image);
          }
        });
      });

       // update makanan ajax request
       $("#edit_makanan_form").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#edit_makanan_btn").text('Updating...');
        $.ajax({
          url: '{{ route('update') }}',
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
                'Employee Updated Successfully!',
                'success'
              )
              fetchAllmakanans();
            }
            $("#edit_makanan_btn").text('Update Makanan');
            $("#edit_makanan_form")[0].reset();
            $("#editMakananModal").modal('hide');
          }
        });
      });

       // delete makanan ajax request
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
              url: '{{ route('delete') }}',
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
                fetchAllmakanans();
              }
            });
          }
        })
      });

     
      // fetch all makanans ajax request
      fetchAllmakanans();

      function fetchAllmakanans() {
        $.ajax({
          url: '{{ route('fetchAll') }}',
          method: 'get',
          success: function(response) {
            $("#show_all_makanans").html(response);
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