@extends('layouts.menu')
@section('content')
{{-- add new akun modal start --}}
<div class="modal fade" id="addAkunModal" tabindex="-1" aria-labelledby="exampleModalLabel"
   data-bs-backdrop="static" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered">
   <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Account</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="add_akun_form" enctype="multipart/form-data">
        @csrf
        <div class="modal-body p-4 bg-light">
            <div class="my-2">
              <label for="name">Nama</label>
              <input type="text" name="name" class="form-control" required>
              <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-name"></div>
            </div>
          <div class="my-2">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control" required>
            <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-username"></div>
          </div>
          <div class="my-3 form-password-toggle">
                  <div class="d-flex justify-content-between">
                     <label class="form-label" for="password">{{ __('Password') }}</label>
                  </div>
                  <div class="input-group input-group-merge">
                     <input
                        type="password"
                        class="form-control pwd"
                        name="password"
                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                        aria-describedby="password"
                        autocomplete="current-password"
                        required
                        />
                        <span class="input-group-text cursor-pointer">
                          <button class="btn btn-default reveal" type="button"><i class="bx bx-hide"></i></button>
                        </span>  
                  </div>
                  <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-password"></div>
            </div>
               <div class="my-2">
                  <label for="level" class="col-sm-12 control-label">Level</label>
                  <div class="col-sm-12">
                     <select name="level" class="form-control" required>
                        <option value="">Choose</option>
                        <option value="1">Kasir</option>
                        <option value="2">Dapur</option>
                        <option value="3">Admin</option>
                     </select>
                  </div>
                  <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-level"></div>
               </div>
               <div class="my-2">
                  <label for="cabang" class="col-sm-12 control-label">Cabang</label>
                  <div class="col-sm-12">
                     <select name="level" class="form-control" required>
                     <option value="">Choose</option> @foreach($cabangs as $cabang) <option value="{{ trim($cabang->id) }}">
                      {{ $cabang->nama_cabang }}
                    </option> @endforeach
                     </select>
                  </div>
                  <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-level"></div>
               </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="add_akun_btn" class="btn btn-primary">Add Account</button>
        </div>
      </form>
    </div>
   </div>
</div>
{{-- add new akun modal end --}}

{{-- edit account modal start --}}
<div class="modal fade" id="editAkunModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Account</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="edit_akun_form" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="akun_id" id="akun_id">
        <div class="modal-body p-4 bg-light">
            <div class="my-2">
              <label for="name">Nama</label>
              <input type="text" name="name" id="name" class="form-control" required>
              <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-names"></div>
            </div>
            <div class="my-2">
              <label for="username">Username</label>
              <input type="text" name="username" id="username" class="form-control" disabled>
            </div>
            <div class="my-3 form-password-toggle">
                  <div class="d-flex justify-content-between">
                     <label class="form-label" for="password">{{ __('Password') }}</label>
                  </div>
                  <div class="input-group input-group-merge">
                     <input
                        type="password"
                        id="password"
                        class="form-control pwd"
                        name="password"
                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                        aria-describedby="password"
                        autocomplete="current-password" required
                        />
                        <span class="input-group-text cursor-pointer">
                          <button class="btn btn-default reveal" type="button"><i class="bx bx-hide"></i></button>
                        </span>  
                  </div>
                  <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-passwords"></div>
               </div>
               <div class="my-2">
                  <label for="level" class="col-sm-12 control-label">Level</label>
                  <div class="col-sm-12">
                     <select name="level" id="level" class="form-control" required>
                        <option value="">Choose</option>
                        <option value="1">Kasir</option>
                        <option value="2">Dapur</option>
                        <option value="3">Admin</option>
                     </select>
                  </div>
                  <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-levels"></div>
               </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="edit_akun_btn" class="btn btn-success">Update Account</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- edit account modal end --}}

<body class="bg-light">
   <div class="container">
      <div class="row my-5">
         <div class="col-lg-12">
            <div class="card shadow">
               <div class="card-header bg-danger d-flex justify-content-between align-items-center">
                  <h3 class="text-light">Manage Account</h3>
                  <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addAkunModal"><i
                     class="bi-plus-circle me-2"></i>Add Account</button>
               </div>
               <div class="card-body" id="show_all_akuns">
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

        $(".reveal").on('click',function() {
          var $pwd = $(".pwd");
          if ($pwd.attr('type') === 'password') {
              $pwd.attr('type', 'text');
          } else {
              $pwd.attr('type', 'password');
          }
      });
      
      
         // add new akun ajax request
         $("#add_akun_form").submit(function(e) {
          e.preventDefault();
          const fd = new FormData(this);
          $.ajax({
            url: '{{ route('storeAkun') }}',
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
                  'Akun Added Successfully!',
                  'success'
                )
                fetchAllAkuns();
              }
              $("#add_akun_btn").text('Add Account');
              $("#add_akun_form")[0].reset();
              $("#addAkunModal").modal('hide');
            },
            error:function(error){
                
                if(error.responseJSON.name) {

                    //show alert
                    $('#alert-name').removeClass('d-none');
                    $('#alert-name').addClass('d-block');

                    //add message to alert
                    $('#alert-name').html(error.responseJSON.name);
                } 

                if(error.responseJSON.username) {

                    //show alert
                    $('#alert-username').removeClass('d-none');
                    $('#alert-username').addClass('d-block');

                    //add message to alert
                    $('#alert-username').html(error.responseJSON.username);
                } 

                if(error.responseJSON.password) {

                //show alert
                $('#alert-password').removeClass('d-none');
                $('#alert-password').addClass('d-block');

                //add message to alert
                $('#alert-password').html(error.responseJSON.password);
                } 

                if(error.responseJSON.level) {

                //show alert
                $('#alert-level').removeClass('d-none');
                $('#alert-level').addClass('d-block');

                //add message to alert
                $('#alert-level').html(error.responseJSON.level);
                } 

            }
          });
        });

         // edit akun ajax request
      $(document).on('click', '.editIcon', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        $.ajax({
          url: '{{ route('editAkun') }}',
          method: 'get',
          data: {
            id: id,
            _token: '{{ csrf_token() }}'
          },
          success: function(response) {
            $("#name").val(response.name);
            $("#username").val(response.username);
            $("#level").val(response.level);
            $("#akun_id").val(response.id);
          }
        });
      });

       // update akun ajax request
       $("#edit_akun_form").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        console.log(fd);
        $.ajax({
          url: '{{ route('updateAkun') }}',
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
                'Account Updated Successfully!',
                'success'
              )
              fetchAllAkuns();
            }
            $("#edit_akun_btn").text('Update account');
            $("#edit_akun_form")[0].reset();
            $("#editAkunModal").modal('hide');
          },
          error:function(error){
                
                if(error.responseJSON.name) {

                    //show alert
                    $('#alert-names').removeClass('d-none');
                    $('#alert-names').addClass('d-block');

                    //add message to alert
                    $('#alert-names').html(error.responseJSON.name);
                } 

                if(error.responseJSON.password) {

                //show alert
                $('#alert-passwords').removeClass('d-none');
                $('#alert-passwords').addClass('d-block');

                //add message to alert
                $('#alert-passwords').html(error.responseJSON.password);
                } 

                if(error.responseJSON.level) {

                //show alert
                $('#alert-levels').removeClass('d-none');
                $('#alert-levels').addClass('d-block');

                //add message to alert
                $('#alert-levels').html(error.responseJSON.level);
                } 

            }
        });
      });
      
         // delete akun ajax request
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
                url: '{{ route('deleteAkun') }}',
                method: 'delete',
                data: {
                  id: id,
                  _token: csrf
                },
                success: function(response) {
                  console.log(response.status);
                  if(response.status == 400)
                  {
                    Swal.fire(
                    'Gagal!',
                    'Tidak bisa menghapus akun admin.',
                    'error'
                  )
                  }else{
                    Swal.fire(
                    'Deleted!',
                    'Behasil menghapus akun',
                    'success'
                  )
                  }
                  fetchAllAkuns();
                }
              });
            }
          })
        });
      
       
        // fetch all akun ajax request
        fetchAllAkuns();
      
        function fetchAllAkuns() {
          $.ajax({
            url: '{{ route('fetchAllAkun') }}',
            method: 'get',
            success: function(response) {
              $("#show_all_akuns").html(response);
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