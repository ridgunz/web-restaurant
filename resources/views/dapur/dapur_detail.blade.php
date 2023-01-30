@extends('layouts.layout_dapur')
@section('content')
<div class="container">
      <div class="heading_container heading_center">
        <h2>
          Pemesan
        </h2>
      </div>

      <div class="content">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 80%;">Pemesan</th>
                    <th style="width: 20%;">Topping</th>
                </tr>
            </thead>
            <tbody>
              @foreach($order as $key => $value)
                <tr class="clickable-row" data-flag="0" data-id="{{$value->id}}" data-idorder='{{ $value->order_id }}'>
                    <td>{{ $value->nama }}</td>
                    <td>
                        <ul style="padding-left: 10px;">
                            @foreach($value->topping as $value2)
                                <li>{{ $value2->nama }}</li>   
                            @endforeach
                        </ul>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
      </div>
    </div>

    <script>
    
jQuery(document).ready(function($) {
    var jumlah_done = 0;
    var jumlah_pesanan = $('.clickable-row').length;
    $(".clickable-row").click(function() {
        var flag = $(this).attr('data-flag');
        if(flag == 0){
            $(this).addClass('table-success');
            $(this).attr('data-flag', 1);
            jumlah_done += 1;
        }else{
            $(this).removeClass('table-success');
            $(this).attr('data-flag', 0);
            jumlah_done -=1;
        }

        var curr_flag = $(this).attr('data-flag');
        var id = $(this).attr('data-id');

        var url = 'http://localhost:8000/dapur/update-pesanan';

        $.ajax({
          headers: {
              'X-CSRF-TOKEN':'{{ csrf_token() }}'
          },
          type: "POST",
          dataType: "JSON",
          url: url,
          data: {id: id, flag: curr_flag}, 
          success: function(e)
          {
                if(e.status == 200){
                    Swal.fire({
                    icon: 'success',
                    title: 'Sukses',
                    text: e.msg
                    }).then(()=>{
                        var url = 'http://localhost:8000/dapur/update-order';
        // var id_order = $(this).attr('data-idorder');

        if(jumlah_done == jumlah_pesanan){
            window.location.href = 'http://localhost:8000/dapur';
        }
                    });
                }else{
                    Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: e.msg
                    });
                } 
            }
        });


        
    });
});
  </script>

  @endsection