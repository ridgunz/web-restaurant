@extends('layouts.layout_kasir')

@section('content')
<div class="container">
      <div class="heading_container heading_center">
        <h2>
          List Pesanan
        </h2>
      </div>

      <div class="content">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 80%;">Pemesan</th>
                    <th style="width: 20%;">Tipe</th>
                </tr>
            </thead>
            <tbody>
            @if(count($order) > 0)
              @foreach($order as $key => $value)
                <tr class='clickable-row' data-href='http://localhost:8000/order/payment-order/{{$value->id}}'>
                    <td>{{ $value->nama_pemesan }}</td>
                    <td>{{ ($value->tipe_order == 1)? 'Makan Ditempat': 'Bungkus' }}</td>
                </tr>
              @endforeach

            @else
            <tr>
                <td colspan="2"><center>  Belum ada pesanan </center></td>
            </tr>
            @endif
            </tbody>
        </table>

      </div>
    </div>


        <script>
            
            jQuery(document).ready(function($) {
                $(".clickable-row").click(function() {
                    window.location = $(this).data("href");
                });
            });
      </script>
    

    @endsection