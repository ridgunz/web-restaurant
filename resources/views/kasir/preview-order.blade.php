@extends('layouts.layout_kasir')


@section('content')
<div class="container">
    <form id="submit-order" action="http://localhost:8000/order/submit-order" method="POST">
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
                  <input type="text" class="form-control" placeholder="Nama Pemesan / No Meja" name="pemesan" aria-label="pemesan" >
              </div>
          </div>


          <div class="col-md-6">
              <div class="from-group p-2">
                  <label for="username">Tipe Pemesanan</label><br>
                  <select class="form-control" name="tipe_pemesanan" required>
                      <option value="">-- Pilih --</option>
                      <option value="1">Bungkus</option>
                      <option value="2">Makan ditempat</option>
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
                    <th style="width: 60%;">Pesanan</th>
                    <th style="width:40%;">Catatan</th>
                    <th colspan=2>Harga</th>
                </tr>
            </thead>
            <tbody>
              @foreach($cart as $key => $value)
                <tr>
                    <td>{{ $value->nama." (".number_format($value->amount).")" }}<br>
                      <ul>
                        @foreach($value->topping as $key2=> $value2)
                          <li>{{ $value2->nama." (".number_format($value2->amount).")" }}</li>
                        @endforeach
                      </ul>
                    </td>
                    <td><textarea class="form-control catatan" data-id="{{$value->id}}" rows="3"></textarea></td>
                    <td>{{ number_format($value->price) }}</td>
                    <td><a href="javascript:void(0)" data-id="{{ $value->id_detail_cart }}" class="btn btn-danger btn-sm delete">Hapus</a></td>
                </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th colspan=2>Total</th>
                <th colspan=2>Rp. {{ number_format($total_price) }}</th>
              </tr>
            </tfoot>
        </table>

        <div class="row mt-4" style="float: right;">
          <div>
            <a href="{{route('order')}}"  class="btn btn-primary">Pilih Menu</a>
            @if(count($cart) > 0)<a href="javascript:void(0)" id="order" class="btn btn-success">Pesan</a>@endif
          </div>
        </div>
      </div>
    </div>



  <script>

$('#order').click(function(){
  var id_makanan = [];
  var value_makanan = [];
  $.each($('.catatan'), function(index, value){
  if($('.catatan').eq(index).val() != ''){
   id_makanan.push($('.catatan').eq(index).attr('data-id'));
   value_makanan.push($('.catatan').eq(index).val()); 
  }
  });
  // console.log(id_makanan);
  // console.log(value_makanan);
  // return false;
 var namaPemesan = $('input[name="pemesan"]').val();
 var tipePesanan = $('select[name="tipe_pemesanan"]').val();
  if(namaPemesan == ''){
    Swal.fire({
      title: 'Harap mengisi nama pemesan',
      // text: 'Do you want to continue',
      icon: 'warning',
      confirmButtonText: 'Ok'
    });

    return false;
  }

  if(tipePesanan == ''){
    Swal.fire({
      title: 'Harap mengisi memilih tipe pemesanan',
      // text: 'Do you want to continue',
      icon: 'warning',
      confirmButtonText: 'Ok'
    });

    return false;
  }
  // alert($('input[name="pemesan"]').val());
  // return false;

  var form = $('#submit-order');
  var actionUrl = form.attr('action');

  
  Swal.fire({ 
  title: 'Konfirmasi pesanan?',
  showDenyButton: true,
  // showCancelButton: true,
  confirmButtonText: 'Pesan',
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
      data: {namaPemesan: namaPemesan, tipePesanan: tipePesanan, catatan_id_makanan: id_makanan, catatan_val_makanan: value_makanan}, // serializes the form's elements.
      success: function(data)
      {
        console.log(data.msg)
        Swal.fire({
          icon: 'success',
          title: data.msg,
        }).then(()=>{
        window.location.href = "http://localhost:8000/order";
        });
        
      }
    });
  }
  });
});

$('.delete').click(function(){
  var id = $(this).attr('data-id');
  var actionUrl = "{{route('delete-order') }}";
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
</script>
@endsection