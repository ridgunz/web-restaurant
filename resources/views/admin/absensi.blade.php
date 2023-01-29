@extends('layouts.menu')

@section('content')

<body class="bg-light">
  <div class="container">
  <div class="row input-daterange">
        <div class="col-md-4">
            <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" readonly />
        </div>
        <div class="col-md-4">
            <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" readonly />
        </div>
        <div class="col-md-4">
            <button type="button" name="filter" id="filter" class="btn btn-primary">Filter</button>
            <button type="button" name="refresh" id="refresh" class="btn btn-default">Refresh</button>
        </div>
    </div>
    <div class="row my-5">
      <div class="col-lg-12">
        <div class="card shadow">
          <div class="card-header bg-danger d-flex justify-content-between align-items-center">
            <h3 class="text-light">Report Absensi</h3>
          </div>
          <div class="card-body" id="show_all_absen">
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
  <script>
    $(function() {
      // fetch all makanans ajax request
      fetchAllAbsens();

      function fetchAllAbsens() {
        $.ajax({
          url: '{{ route('fetchAllAbsen') }}',
          method: 'get',
          success: function(response) {
            $("#show_all_absen").html(response);
            $("table").DataTable({
              order: [0, 'desc']
            });
          }
        });
      }
    });
  </script>
</body>

@endsection