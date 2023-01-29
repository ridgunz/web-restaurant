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

      var date = new Date();

      $('.input-daterange').datepicker({
        todayBtn: 'linked',
        format: 'yyyy-mm-dd',
        autoclose: true
      });

      var _token = $('input[name="_token"]').val();
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

      function fetchAllAbsenx(from_date = '', to_date = '')
      {
        $.ajax({
        url:"{{ route('fetchAllAbsenx') }}",
        method:"POST",
        data:{from_date:from_date, to_date:to_date, _token:_token},
        dataType:"json",
        success:function(data)
        {
          var output = '';
          for(var count = 0; count < data.length; count++)
          {
          output += '<tr>';
          output += '<td>' + data[count].id + '</td>';
          output += '<td>' + data[count].name + '</td>';
          output += '<td>' + data[count].level + '</td>';
          output += '<td>' + data[count].created_at + '</td>';
          output += '<td>' + data[count].updated_at + '</td></tr>';
          }
          $('tbody').html(output);
              }
              })
      }


    $('#filter').click(function(){
    var from_date = $('#from_date').val();
    var to_date = $('#to_date').val();
    if(from_date != '' &&  to_date != '')
    {
      $('#table').DataTable().destroy();
      fetchAllAbsenx(from_date, to_date);
    }
    else
    {
    alert('Both Date is required');
    }
  });

  $('#refresh').click(function(){
    $('#from_date').val('');
    $('#to_date').val('');
    fetchAllAbsens();
  });

});
  </script>
</body>

@endsection