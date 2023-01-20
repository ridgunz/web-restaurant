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

  <style>

    input[readonly] {
        background-color: white !important;
    }
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
          <a class="navbar-brand" href="index.html">
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
                <i class="fa fa-user" aria-hidden="true"></i>
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
    <div class="row">
        <div class="col-md-6">
            <div class="from-group p-2">
                <label for="username">Kasir</label>
                <input type="text" class="form-control" id="kasir" placeholder="Username" aria-label="Username" value="Dikmars" data-id="1" readonly>
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

      <div class="heading_container heading_center">
        <h2>
          Pesanan
        </h2>
      </div>

      <div class="content">
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 100%;">Pesanan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Bakso Urat<br>(Mie, Jamur, Sawi)</td>
                    <td><a href="#" class="btn btn-danger btn-sm">Hapus</a></td>
                </tr>
                
                <tr>
                    <td>Bakso Urat<br>(Mie, Jamur, Sawi)</td>
                    <td><a href="#" class="btn btn-danger btn-sm">Hapus</a></td>
                </tr>

                <tr>
                    <td>Bakso Urat<br>(Mie, Jamur, Sawi)</td>
                    <td><a href="#" class="btn btn-danger btn-sm">Hapus</a></td>
                </tr>
            </tbody>
        </table>

        <div class="row mt-4" style="float: right;">
          <div>
            <a href="javascript:void(0)" id="back" class="btn btn-primary">Pilih Menu</a>
            <a href="javascript:void(0)" id="order" class="btn btn-success">Pesan</a>
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
    $('.open-topping').on('click', function(){
     var id_kasir = $('#kasir').attr('data-id');
     var namaPemesan = $('input[name="pemesan"]').val();
     var tipePesanan = $('select[name="tipe_pemesanan"]').val();
     var namaMakanan = $(this).data('nama');
     var hargaMakanan = $(this).data('harga'); 
     var idMakanan = $(this).data('id');
     if(namaPemesan == '' || tipePesanan == ''){
      alert('harap mengisi data pemesanan')
      return false;
     }
    //  console.log("/"+id_kasir+'/'+namaPemesan+'/'+tipePesanan+'/'+namaMakanan+'/'+idMakanan+'/'+hargaMakanan)
     window.location.href = "http://localhost:8000/order/"+id_kasir+'/'+namaPemesan+'/'+tipePesanan+'/'+namaMakanan+'/'+hargaMakanan+'/'+idMakanan;
      // alert(tipePesanan);
      

    });
  </script>

</body>

</html>