<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Hendra</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="{{ asset('enno/assets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('enno/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('enno/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('enno/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('enno/assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('enno/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('enno/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('enno/assets/css/main.css') }}" rel="stylesheet">

  <!-- Vendor JS Files -->
  <script src="{{ asset('enno/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}" defer></script>
  <script src="{{ asset('enno/assets/vendor/aos/aos.js') }}" defer></script>
  <script src="{{ asset('enno/assets/vendor/glightbox/js/glightbox.min.js') }}" defer></script>
  <script src="{{ asset('enno/assets/vendor/swiper/swiper-bundle.min.js') }}" defer></script>

  <!-- Main JS File -->
  <script src="{{ asset('enno/assets/js/main.js') }}" defer></script>
  <style>
    @media (max-width: 575px) {
      .sitename {
      font-size: 1.2rem; /* Memperkecil tulisan judul hanya di HP */
      }
      #hero h1 {
      font-size: 1.8rem; /* Memperkecil headline agar tidak terlalu panjang */
      }
      }
  </style>
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="#" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename">PT. BPR PRIMA NADI</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      {{-- <a class="btn-getstarted" href="{{ route('login') }}">Login</a> --}}

    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
<section id="hero" class="hero section">
    <div class="container">
        <div class="row gy-4 align-items-center"> <div class="col-lg-6 order-1 order-lg-1 d-flex flex-column justify-content-center text-center text-lg-start" data-aos="fade-up">
                <h1>Membangun Bersama Masyarakat</h1>
                {{-- <p>Aplikasi ini merupakan aplikasi untuk memverifikasi data spesimen nasabah secara akurat dan efisien guna meningkatkan keamanan serta validitas transaksi perbankan.</p> --}}
                <p>Verifikasi adalah proses pengendalian internal untuk menjamin keabsahan instruksi nasabah dengan cara membandingkan identitas serta spesimen tanda tangan yang tersimpan dalam sistem dengan dokumen transaksi yang diajukan.</p>
                
                <div class="d-flex justify-content-center justify-content-lg-start mt-3">
                    <a class="btn btn-primary rounded-pill px-4 shadow" href="{{ route('login') }}">Login Sekarang</a>
                </div>
            </div>
            
            <div class="col-lg-6 order-2 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="100">
                <img src="{{ asset('enno/assets/img/hero-img.png') }}" class="img-fluid animated" alt="" style="max-height: 400px; width: auto; margin: 0 auto; display: block;">
            </div>

        </div>
    </div>
</section>

  <footer id="footer" class="footer">

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">PT.BPR Prima Nadi</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
        {{-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> Distributed by <a href=“https://themewagon.com>ThemeWagon --}}
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

</body>

</html>