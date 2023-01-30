@extends('layouts.layout_kasir')

@section('content')
<div class="container">
    <form action="http://localhost:8000/order/complete-order" id="complete_form" method="POST">
        <div class="row">
          <div class="col-md-6">
              <div class="from-group p-2">
                  <label for="username">Kasir</label>
                  <input type="text" class="form-control" id="kasir" placeholder="Username" aria-label="Username" value="Dikmars"  readonly>
              </div>
          </div>
          <div class="col-md-6">
              <div class="from-group p-2">
                  <label for="username">Pemesan</label>
                  <input type="text" class="form-control" placeholder="Nama Pemesan / No Meja" name="nama_pemesan" value="{{$order->nama_pemesan}}" aria-label="pemesan" readonly>
              </div>
          </div>


          <div class="col-md-6">
              <div class="from-group p-2">
                  <label for="username">Tipe Pemesanan</label><br>
                  <input type="text" class="form-control" placeholder="tipe order" name="tipe_order" value="{{$order->tipe_order == 1? 'Makan Ditempat': 'Bungkus'}}" aria-label="tipe" readonly>
              </div>
          </div>
          <div class="col-md-6">
              <div class="from-group p-2">
                  <label for="username">Tipe Pembayaran</label><br>
                  <select name="tipe_pembayaran" id="tipe-pembayaran" class="form-control">
                    <option value="">-- Pilih tipe Pembayaran -- </option>
                    <option value="Cash">Cash</option>
                    <option value="Non-Cash">Non-Cash</option>
                  </select>
              </div>
          </div>
        </div>

      </form>

      <div class="heading_container heading_center">
        <h2>
          Pesanan
        </h2>
      </div>

      <div class="content">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 100%;">Pesanan</th>
                    <th colspan=2>Harga</th>
                </tr>
            </thead>
            <tbody>
              @foreach($order->detail as $key => $value)
                <tr>
                    <td>{{ $value->nama." (".number_format($value->amount).")" }}<br>
                      <ul>
                        @foreach($value->topping as $key2=> $value2)
                          <li>{{ $value2->nama." (".number_format($value2->amount).")" }}</li>
                        @endforeach
                      </ul>
                    </td>
                    <td>{{ number_format($value->price) }}</td>
                    <td><a href="javascript:void(0)" data-id="{{ $value->id_detail_cart }}" class="btn btn-danger btn-sm delete">Hapus</a></td>
                </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th>Total</th>
                <th colspan=2>Rp. {{ number_format($total_price) }}</th>
              </tr>
            </tfoot>
        </table>

        <div class="row mt-4" style="float: right;">
          <div>
            <a href="{{route('add-order',['id'=>$id])}}"  class="btn btn-primary">Pilih Menu</a>
            @if(count($order->detail) > 0)
            <a href="javascript:void(0)" id="order" class="btn btn-success">Selesaikan Pesanan</a>
            <a href="javascript:void(0)" id="print_order" class="btn btn-info">print_order</a>
            @endif
          </div>
        </div>
      </div>
    </div>


  <script>

$('#order').click(function(){

 var tipePembayaran = $('select[name="tipe_pembayaran"]').val();
  

  if(tipePembayaran == ''){
    Swal.fire({
      title: 'Harap mengisi memilih tipe pembayaran',
      // text: 'Do you want to continue',
      icon: 'warning',
      confirmButtonText: 'Ok'
    });

    return false;
  }
  // alert($('input[name="pemesan"]').val());
  // return false;

  var form = $('#complete_form');
  var actionUrl = form.attr('action');

  
  Swal.fire({ 
  title: 'Selesaikan pesanan?',
  showDenyButton: true,
  // showCancelButton: true,
  confirmButtonText: 'Ya',
  denyButtonText: `Batal`,
}).then((result) => {

if (result.isConfirmed) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN':'{{ csrf_token() }}'
        },
        type: "POST",
        url: actionUrl,
        dataType: 'JSON',
        data: {tipePembayaran: tipePembayaran, id: {{$order->id}}, total: {{$total_price}}}, // serializes the form's elements.
        success: function(data)
        {
        console.log(data.msg)
        Swal.fire({
            icon: 'success',
            title: data.msg,
        }).then(()=>{
        window.location.href = "http://localhost:8000/order/list-order";
        });
        
        }
    });
    }
  });
});

$('.delete').click(function(){
  var id = $(this).attr('data-id');
  var actionUrl = "{{route('delete-order-add') }}";
  var $deletebtn = $(this);
Swal.fire({
  title: 'Hapus pesanan?',
  showDenyButton: true,
  // showCancelButton: true,
  confirmButtonText: 'Hapus',
  denyButtonText: `Batal`,
}).then((result) => {
if (result.isConfirmed) {
    $.ajax({
      headers: {
          'X-CSRF-TOKEN':'{{ csrf_token() }}'
      },
      type: "POST",
      dataType: "JSON",
      url: actionUrl,
      data: {id_detail: id}, 
      success: function(e)
      {
            if(e.status == 200){
              Swal.fire({
                icon: 'success',
                title: 'Sukses',
                text: e.msg
              }).then(()=>{
                location.reload();
              });
            }else{
              Swal.fire({
                icon: 'error',
                title: 'Sukses',
                text: e.msg
              });
            } 
          }
        });
      } 
    });
    // alert(id);
  })

  $('#print_order').click(function(){
    $.ajax({
      headers: {
          'X-CSRF-TOKEN':'{{ csrf_token() }}'
      },
      url: "{{route('print_order')}}",
      method: "POST",
      data: {id: {{$id}}},
      success:function(e){
        window.location.href=e;
      }
    })
  })
</script>

@endsection