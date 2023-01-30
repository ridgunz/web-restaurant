@extends('layouts.layout_kasir')
@section('content')
<div class="container">
      <div class="heading_container heading_center">
        <h2>
          Topping {{ $nama_makanan }}
        </h2>

        <form action="{{ route('place-order'); }}" method="POST" id="form-order">
          <input type="hidden" id="id_makanan" value="{{ $id }}">
          <input type="hidden" id="harga" value="{{ $harga }}">
          <input type="hidden" id="topping" value="">
        </form>
      </div>

      <ul class="filters_menu">
        <li class="active" data-filter="*">Topping</li>
      </ul>

      <div class="filters-content">
        <div class="row grid">

        @foreach($topping as $key => $value)
          <div class="col-sm-6 col-lg-4 all bakso">
            <div class="box">
              <div style="background-color: #222831">
                <div class="detail-box">
                  <h5>
                    {{ $value->nama }}
                  </h5>
                  
                  <div class="options">
                    <h6>
                      Rp. {{ number_format($value->amount) }}
                    </h6>
                    <a href="javascript:void(0)" class="choose-topping" data-choosen="false" data-id="{{ $value->id }}">
                      <i class="fa fa-shopping-cart" style="color:white;"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endforeach
        
        </div>
        <div class="row mt-4" style="float: right;">
          <div>
            <a href="javascript:void(0)" id="back" class="btn btn-danger">Batal</a>
            <a href="javascript:void(0)" id="order" class="btn btn-primary">Pesan Pesanan</a>
          </div>
        </div>
      </div>
    </div>

    <script>
    const choosenTopping = [];
    $('.choose-topping').click(function(){
        var choosen = $(this).attr('data-choosen');
        var idChoosen = $(this).attr('data-id');
        if(choosen == 'true'){
            choosen = 'false';
            $(this).html('<i class="fa fa-shopping-cart" style="color:white;"></i>');
            $(this).css('background-color', '#ffbe33');
            choosenTopping.splice( $.inArray(idChoosen, choosenTopping), 1 );
        }else{
            choosen = 'true';
            $(this).html('<i class="fa fa-check" style="color:white;"></i>');
            $(this).css('background-color', '#39aad7');
            choosenTopping.push(idChoosen);
        }
        $(this).attr('data-choosen', choosen);
        $('#topping').val(JSON.stringify(choosenTopping));
    });

    $('#back').click(function(){
      window.history.back();
    });

    $('#order').click(function(){
      // $('#form-order').submit();

      var form = $('#form-order');
      var actionUrl = form.attr('action');

      $.ajax({
        headers: {
            'X-CSRF-TOKEN':'{{ csrf_token() }}'
        },
        type: "POST",
        url: actionUrl,
        data: {id_kasir : {{ Auth::user()->id }},pemesan : $('#pemesan').val(), tipe: $('#tipe_pemesanan').val(), id_makanan: $('#id_makanan').val(), topping: $('#topping').val()}, // serializes the form's elements.
        success: function(data)
        {
          // alert(data); // show response from the php script.
          Swal.fire({
            title: 'Sukses',
            showDenyButton: true,
            // showCancelButton: true,
            confirmButtonText: 'Lanjut',
            denyButtonText: 'Pesan Lagi',
          }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
              // Swal.fire('Saved!', '', 'success')
              window.location.href = "http://localhost:8000/order/preview-order";
            } else if (result.isDenied) {
              window.location.href = "http://localhost:8000/order";
            }
          })
        }
      });
    });
  </script>

  @endsection