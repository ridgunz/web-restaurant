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


  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <link rel="stylesheet" href="sweetalert2.min.css">

  <style>

    input[readonly] {
        background-color: white !important;
    }
  </style>
</head>

<body class="sub_page">

  <div class="hero_area">
    <div class="bg-box" style="background-color:#333333;">
      <!-- <img src="/assets/frontend/images/hero-bg.jpg" alt=""> -->
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
              <li class="nav-item">
                <a class="nav-link" href="http://localhost:8000/order">Home </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('list-order')}}">List Pesanan </a>
              </li>
            </ul>
            <div class="user_option">
              <a href="{{ route('preview-order') }}" class="user_link">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i><span class="badge">{{ $count_cart }}</span>
              </a>
              <a href="" class="order_online">
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
              <div>
                <div class="img-box m-0 p-0" style="height:auto;">
                  <img src="https://akcdn.detik.net.id/community/media/visual/2019/08/12/dca21bf3-923c-486f-bc2e-a3dcd759b1df.jpeg" style="width: 100%; height: auto; object-fit: cover;" alt="">
                </div>
                <div class="detail-box">
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
              <div>
                <div class="img-box m-0 p-0" style="height:auto;">
                  <img src="https://akcdn.detik.net.id/community/media/visual/2019/08/12/dca21bf3-923c-486f-bc2e-a3dcd759b1df.jpeg" style="width: 100%; height: auto; object-fit: cover;" alt="">
                </div>
                <div class="detail-box">
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
                    <a href="javascript:void(0)" class="open-topping" data-nama="{{ $value->nama }}" data-harga="{{ $value->amount }}" data-id="{{ $key }}">
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

  <!-- jQery -->
  <script src="/assets/frontend/js/jquery-3.4.1.min.js"></script>
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
  </script>

</body>

</html>