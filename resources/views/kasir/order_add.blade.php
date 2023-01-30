@extends('layouts.layout_kasir')

@section('content')
    <div class="container">
    <!-- <div class="row">
        <div class="col-md-6">
            <div class="from-group p-2">
                <label for="username">Kasir</label>
                <input type="text" class="form-control" id="kasir" placeholder="Username" aria-label="Username" value="Dikmars" data-id="{{ Session('id_kasir') }}" readonly>
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
    </div> -->

      <div class="heading_container heading_center">
        <h2>
          Menu
        </h2>
      </div>

      <ul class="filters_menu">
        <li class="active" data-filter="*">Semua</li>
        <li data-filter=".Makanan">Makanan</li>
        <li data-filter=".Minuman">Minuman</li>
      </ul>

      <div class="filters-content">
        <div class="row grid">

        @foreach($makanan as $key => $value)
          <div class="col-sm-6 col-lg-4 all {{ $value->kategori }}">
            <div class="box">
              <div style="background-color: #222831">
                <div class="detail-box">
                  <small>{{$value->kategori}}</small>
                  <hr style="background-color:white;">  
                  <h5>
                    {{ $value->nama }}
                  </h5>
                  <p>
                    {{ $value->deskripsi }}
                  </p>
                  <div class="options">
                    <h6>
                      Rp. {{ number_format($value->amount) }}
                    </h6>
                    <a href="javascript:void(0)" class="open-topping" data-nama="{{ $value->nama }}" data-harga="{{ $value->amount }}" data-id="{{ $value->id }}">
                      <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 456.029 456.029" style="enable-background:new 0 0 456.029 456.029;" xml:space="preserve">
                        <g>
                          <g>
                            <path d="M345.6,338.862c-29.184,0-53.248,23.552-53.248,53.248c0,29.184,23.552,53.248,53.248,53.248
                         c29.184,0,53.248-23.552,53.248-53.248C398.336,362.926,374.784,338.862,345.6,338.862z" />
                          </g>
                        </g>
                        <g>
                          <g>
                            <path d="M439.296,84.91c-1.024,0-2.56-0.512-4.096-0.512H112.64l-5.12-34.304C104.448,27.566,84.992,10.67,61.952,10.67H20.48
                         C9.216,10.67,0,19.886,0,31.15c0,11.264,9.216,20.48,20.48,20.48h41.472c2.56,0,4.608,2.048,5.12,4.608l31.744,216.064
                         c4.096,27.136,27.648,47.616,55.296,47.616h212.992c26.624,0,49.664-18.944,55.296-45.056l33.28-166.4
                         C457.728,97.71,450.56,86.958,439.296,84.91z" />
                          </g>
                        </g>
                        <g>
                          <g>
                            <path d="M215.04,389.55c-1.024-28.16-24.576-50.688-52.736-50.688c-29.696,1.536-52.224,26.112-51.2,55.296
                         c1.024,28.16,24.064,50.688,52.224,50.688h1.024C193.536,443.31,216.576,418.734,215.04,389.55z" />
                          </g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                      </svg>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endforeach

        @foreach($minuman as $key => $value)
        <div class="col-sm-6 col-lg-4 all {{ $value->kategori }}">
            <div class="box">
              <div style="background-color: #222831">
                <div class="detail-box">
                  <small>{{$value->kategori}}</small>
                  <hr style="background-color:white;">  
                  <h5>
                    {{ $value->nama }}
                  </h5>
                  <p>
                    {{ $value->deskripsi }}
                  </p>
                  <div class="options">
                    <h6>
                      Rp. {{ number_format($value->amount) }}
                    </h6>
                    <a href="javascript:void(0)" class="order-minuman" data-nama="{{ $value->nama }}" data-harga="{{ $value->amount }}" data-id="{{ $value->id }}">
                      <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 456.029 456.029" style="enable-background:new 0 0 456.029 456.029;" xml:space="preserve">
                        <g>
                          <g>
                            <path d="M345.6,338.862c-29.184,0-53.248,23.552-53.248,53.248c0,29.184,23.552,53.248,53.248,53.248
                         c29.184,0,53.248-23.552,53.248-53.248C398.336,362.926,374.784,338.862,345.6,338.862z" />
                          </g>
                        </g>
                        <g>
                          <g>
                            <path d="M439.296,84.91c-1.024,0-2.56-0.512-4.096-0.512H112.64l-5.12-34.304C104.448,27.566,84.992,10.67,61.952,10.67H20.48
                         C9.216,10.67,0,19.886,0,31.15c0,11.264,9.216,20.48,20.48,20.48h41.472c2.56,0,4.608,2.048,5.12,4.608l31.744,216.064
                         c4.096,27.136,27.648,47.616,55.296,47.616h212.992c26.624,0,49.664-18.944,55.296-45.056l33.28-166.4
                         C457.728,97.71,450.56,86.958,439.296,84.91z" />
                          </g>
                        </g>
                        <g>
                          <g>
                            <path d="M215.04,389.55c-1.024-28.16-24.576-50.688-52.736-50.688c-29.696,1.536-52.224,26.112-51.2,55.296
                         c1.024,28.16,24.064,50.688,52.224,50.688h1.024C193.536,443.31,216.576,418.734,215.04,389.55z" />
                          </g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                        <g>
                        </g>
                      </svg>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endforeach
        </div>
      </div>
    </div>

    <script>
    @if(Session('msg'))
      // alert('{{Session("msg")}}');
      Swal.fire({
          title: '{{Session("msg")}}',
          // text: 'Do you want to continue',
          icon: 'success',
          confirmButtonText: 'Ok'
        });
    @endif

    $('.open-topping').on('click', function(){
      var namaMakanan = $(this).data('nama');
      var hargaMakanan = $(this).data('harga'); 
      var idMakanan = $(this).data('id');
      window.location.href = "http://localhost:8000/order/add-order/{{$id}}/"+namaMakanan+'/'+hargaMakanan+'/'+idMakanan;

    });

    $('.order-minuman').click(function(){
      $.ajax({
        headers: {
            'X-CSRF-TOKEN':'{{ csrf_token() }}'
        },
        type: "POST",
        url: "{{route('place-order-minuman-add')}}",
        data: {id_kasir : {{ Auth::user()->id }}, id: {{$id}},id_makanan: $(this).attr('data-id')}, // serializes the form's elements.
        success: function(data)
        {
          // alert(data); // show response from the php script.
          Swal.fire({
            title: 'Sukses',
            showDenyButton: true,
            // showCancelButton: true,
            confirmButtonText: 'Lanjut Bayar',
            denyButtonText: 'Pesan Lagi',
          }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
              // Swal.fire('Saved!', '', 'success')
              window.location.href = "http://localhost:8000/order/payment-order/{{$id}}";
            } else if (result.isDenied) {
              window.location.href = "http://localhost:8000/order/add-order/{{$id}}";
            }
          })
        }
      });
    })
  </script>

@endsection