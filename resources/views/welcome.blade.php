<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>PT. BPR PRIMA NADI</title>
  <meta name="description" content="">
  <meta name="keywords" content="">
  
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
  <link href="{{ asset('css/landing.css') }}" rel="stylesheet">
  <link href="{{ asset('enno/assets/img/prima.png') }}" rel="icon">
  <link rel="icon" type="image/png" href="{{ asset('sbadmn2/img/logo.png') }}"/>
</head>

<body>
  <div class="floating-elements">
    <div class="float-icon">🔒</div>
    <div class="float-icon">🔐</div>
    <div class="float-icon">🛡️</div>
    <div class="float-icon">⚡</div>
    <div class="deco-circle"></div>
    <div class="deco-circle"></div>
  </div>

  <header>
    <div class="container">
      <div class="header-content">
        <a href="#" class="logo">
          <img src="{{ asset('images/logo/logoprima.png') }}" class="logo-image" style="height: 45px; width: 174px;">
        </a>
      </div>
    </div>
</header>

  <main>
    <section class="hero">
      <div class="container">
        <div class="hero-content">
          <div class="hero-text">
            <h1>Membangun <span class="highlight">Bersama</span> Masyarakat</h1>
            <p>Verifikasi merupakan proses pengendalian internal untuk menjamin keabsahan instruksi nasabah dengan cara membandingkan identitas serta spesimen tanda tangan yang tersimpan dalam sistem dengan dokumen transaksi yang diajukan.</p>
            <a href="{{ route('login') }}" class="btn-primary">
              <span>Login Sekarang</span>
              <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                <path d="M4.167 10h11.666M10 4.167L15.833 10 10 15.833" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </a>
          </div>

          <div class="lock-container">
            <div class="rotating-circle"></div>
            
            <div class="security-icon">🔒</div>
            <div class="security-icon">🛡️</div>
            <div class="security-icon">💳</div>
            <div class="security-icon">⚙️</div>
            
            <div class="lock-main">
              <div class="lock-shackle"></div>
              <div class="lock-body">
                <div class="lock-keyhole"></div>
              </div>
            </div>
          </div>
        </div>


      </div>
    </section>
  </main>

  <footer>
    <div class="container">
      <p>© 2026 <strong>PT. BPR Prima Nadi</strong> - All Rights Reserved</p>
    </div>
  </footer>
</body>
</html>