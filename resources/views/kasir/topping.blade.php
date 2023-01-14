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
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" integrity="sha512-CruCP+TD3yXzlvvijET8wV5WxxEh5H8P4cmz0RFbKK6FlZ2sYl3AEsKlLPHbniXKSrDdFewhbmBK5skbdsASbQ==" crossorigin="anonymous" /> -->
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
      <div class="heading_container heading_center">
        <h2>
          Topping {{ $nama_makanan }}
        </h2>
      </div>

      <ul class="filters_menu">
        <li class="active" data-filter="*">Topping</li>
      </ul>

      <div class="filters-content">
        <div class="row grid">

        @for ($i = 1; $i <= 5; $i++)
          <div class="col-sm-6 col-lg-4 all bakso">
            <div class="box">
              <div>
                <div class="img-box m-0 p-0" style="height:auto;">
                  <img src="https://akcdn.detik.net.id/community/media/visual/2019/08/12/dca21bf3-923c-486f-bc2e-a3dcd759b1df.jpeg" style="width: 100%; height: auto; object-fit: cover;" alt="">
                </div>
                <div class="detail-box">
                  <h5>
                    Topping {{ $i }}
                  </h5>
                  
                  <div class="options">
                    <h6>
                      Rp. 10.000
                    </h6>
                    <a href="javascript:void(0)" class="choose-topping" data-choosen="false" data-id="{{ $i }}">
                      <i class="fa fa-shopping-cart" style="color:white;"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endfor
        
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
    const choosenTopping = [];
    $('.choose-topping').click(function(){
        var choosen = $(this).attr('data-choosen');
        var idChoosen = $(this).attr('data-id');
        // $(this).attr('data-choosen', choosen);
        if(choosen == 'true'){
            choosen = 'false';
            $(this).html('<i class="fa fa-shopping-cart" style="color:white;"></i>');
            
            // choosenTopping = jQuery.grep(choosenTopping, function(value) {
            //     return value != idChoosen;
            // });
            choosenTopping.splice( $.inArray(idChoosen, choosenTopping), 1 );
        }else{
            choosen = 'true';
            $(this).html('<i class="fa fa-check" style="color:white;"></i>');
            choosenTopping.push(idChoosen);
        }
        $(this).attr('data-choosen', choosen);
        console.log(choosen);

        console.log(idChoosen);
        console.log(choosenTopping);


        // alert(choosen);
    });
  </script>

</body>

</html>