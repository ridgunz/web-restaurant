<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="/assets/frontend/images/favicon.png" type="">

  <title> Bakso Simpang Tugu </title>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="/assets/frontend/css/bootstrap.css" />

  <!--owl slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <!-- nice select  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" integrity="sha512-CruCP+TD3yXzlvvijET8wV5WxxEh5H8P4cmz0RFbKK6FlZ2sYl3AEsKlLPHbniXKSrDdFewhbmBK5skbdsASbQ==" crossorigin="anonymous" />
  <!-- font awesome style -->
  <link href="/assets/frontend/css/font-awesome.min.css" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="/assets/frontend/css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="/assets/frontend/css/responsive.css" rel="stylesheet" />


  <!-- jQery -->
  <script src="/assets/frontend/js/jquery-3.4.1.min.js"></script>


  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <link rel="stylesheet" href="sweetalert2.min.css">

  <style>

    input[readonly] {
        background-color: white !important;
    }
    ul { list-style-type: "»"; }
  </style>
</head>

<body class="sub_page">

  <div class="hero_area">
    <div class="bg-box">
      <img src="/assets/frontend/images/hero-bg.jpg" alt="">
    </div>
    <!-- header section strats -->
    <header class="header_section">
      <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="{{ route('order') }}">
            <span>
              Bakso Simpang Tugu
            </span>
          </a>

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""> </span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav  mx-auto ">
              <!-- <li class="nav-item">
                <a class="nav-link" href="index.html">Home </a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="menu.html">Menu <span class="sr-only">(current)</span> </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="about.html">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="book.html">Book Table</a>
              </li> -->
            </ul>
            <div class="user_option">
              <a href="" class="user_link">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i><span class="badge">{{ $count_cart }}</span>
              </a>
              <a href="{{ route('preview-order') }}" class="order_online">
                Keluar
              </a>
            </div>
          </div>
        </nav>
      </div>
    </header>
    <!-- end header section -->
  </div>

  <!-- food section -->

  <section class="food_section layout_padding">
    <div class="container">
    <form action="http://localhost:8000/order/submit-order" method="POST">
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
                    <th style="width: 100%;">Pesanan</th>
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
            <a href="{{route('order')}}"  class="btn btn-primary">Pilih Menu</a>
            @if(count($cart) > 0)<a href="javascript:void(0)" id="order" class="btn btn-success">Pesan</a>@endif
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- end food section -->

  <!-- footer section -->
  <footer class="footer_section">
    <div class="container">
      <div class="row">
        <div class="col-md-4 footer-col">
          <div class="footer_contact">
            <h4>
              Hubungi Kami
            </h4>
            <div class="contact_link_box">
              <a href="">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
                <span>
                  Lokasi
                </span>
              </a>
              <a href="">
                <i class="fa fa-phone" aria-hidden="true"></i>
                <span>
                  Telphone +628123456789
                </span>
              </a>
              <a href="">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                <span>
                  email@gmail.com
                </span>
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-4 footer-col">
          <div class="footer_detail">
            <a href="" class="footer-logo">
                Bakso Simpang Tugu
            </a>
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea quo non sit incidunt autem at neque porro saepe ab aliquid sequi ducimus eaque, quod molestias tempore, velit dignissimos maxime odit?
            </p>
            <div class="footer_social">
              <a href="">
                <i class="fa fa-facebook" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-twitter" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-linkedin" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-instagram" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-pinterest" aria-hidden="true"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-4 footer-col">
          <h4>
            Jam Buka
          </h4>
          <p>
            Setiap Hari
          </p>
          <p>
            10:00 sampai 21:00
          </p>
        </div>
      </div>
      <div class="footer-info">
        <p>
          &copy; <span id="displayYear"></span> All Rights Reserved By
          <a href="#">Bakso Simpang Tugu</a><br><br>
          <!-- &copy; <span id="displayYear"></span> Distributed By
          <a href="#" target="_blank">ThemeWagon</a> -->
        </p>
      </div>
    </div>
  </footer>
  <!-- footer section -->

  <!-- popper js -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <!-- bootstrap js -->
  <script src="/assets/frontend/js/bootstrap.js"></script>
  <!-- owl slider -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
  </script>
  <!-- isotope js -->
  <script src="https://unpkg.com/isotope-layout@3.0.4/dist/isotope.pkgd.min.js"></script>
  <!-- custom js -->
  <script src="/assets/frontend/js/custom.js"></script>
  <!-- Google Map -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap">
  </script>
  <!-- End Google Map -->
  

  <script>

    $('#order').click(function(){

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

      var form = $('form');
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
          data: {namaPemesan: namaPemesan, tipePesanan: tipePesanan}, // serializes the form's elements.
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

</body>

</html>