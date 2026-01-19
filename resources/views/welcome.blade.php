<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>PT. BPR PRIMA NADI</title>
  <meta name="description" content="">
  <meta name="keywords" content="">
  
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
  
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    :root {
      --primary: #6366f1;
      --primary-dark: #4f46e5;
      --secondary: #06b6d4;
      --dark: #0f172a;
      --dark-light: #1e293b;
      --text: #e2e8f0;
      --text-muted: #94a3b8;
    }

    body {
      font-family: 'Inter', sans-serif;
      background: var(--dark);
      color: var(--text);
      overflow-x: hidden;
    }

    /* Animated Background */
    .bg-animation {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: -1;
      background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
    }

    .bg-animation::before {
      content: '';
      position: absolute;
      width: 500px;
      height: 500px;
      background: radial-gradient(circle, rgba(99, 102, 241, 0.15) 0%, transparent 70%);
      border-radius: 50%;
      top: -250px;
      right: -250px;
      animation: float 20s infinite alternate;
    }

    .bg-animation::after {
      content: '';
      position: absolute;
      width: 400px;
      height: 400px;
      background: radial-gradient(circle, rgba(6, 182, 212, 0.1) 0%, transparent 70%);
      border-radius: 50%;
      bottom: -200px;
      left: -200px;
      animation: float 15s infinite alternate-reverse;
    }

    @keyframes float {
      0% { transform: translate(0, 0) scale(1); }
      100% { transform: translate(50px, 50px) scale(1.1); }
    }

    /* Grid Pattern Overlay */
    .grid-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-image: 
        linear-gradient(rgba(99, 102, 241, 0.03) 1px, transparent 1px),
        linear-gradient(90deg, rgba(99, 102, 241, 0.03) 1px, transparent 1px);
      background-size: 50px 50px;
      z-index: -1;
    }

    /* Header */
    header {
      position: sticky;
      top: 0;
      z-index: 1000;
      backdrop-filter: blur(20px);
      background: rgba(15, 23, 42, 0.8);
      border-bottom: 1px solid rgba(99, 102, 241, 0.1);
      padding: 1rem 0;
    }

    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 2rem;
    }

    .header-content {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .logo {
      font-family: 'Space Grotesk', sans-serif;
      font-size: 1.5rem;
      font-weight: 700;
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      text-decoration: none;
    }

    /* Hero Section */
    .hero {
      min-height: 100vh;
      display: flex;
      align-items: center;
      padding: 4rem 0;
      position: relative;
    }

    .hero-content {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 4rem;
      align-items: center;
    }

    .hero-text h1 {
      font-family: 'Space Grotesk', sans-serif;
      font-size: 3.5rem;
      font-weight: 700;
      line-height: 1.2;
      margin-bottom: 1.5rem;
      background: linear-gradient(135deg, #fff 0%, var(--text-muted) 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .hero-text h1 .highlight {
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .hero-text p {
      font-size: 1.125rem;
      line-height: 1.8;
      color: var(--text-muted);
      margin-bottom: 2rem;
    }

    .btn-primary {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      background: linear-gradient(135deg, var(--primary), var(--primary-dark));
      color: white;
      padding: 1rem 2.5rem;
      border-radius: 50px;
      text-decoration: none;
      font-weight: 600;
      transition: all 0.3s ease;
      border: 2px solid transparent;
      box-shadow: 0 10px 30px rgba(99, 102, 241, 0.3);
      position: relative;
      overflow: hidden;
    }

    .btn-primary::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
      transition: left 0.5s;
    }

    .btn-primary:hover::before {
      left: 100%;
    }

    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 15px 40px rgba(99, 102, 241, 0.4);
    }

    /* Hero Image with Tech Elements */
    .hero-visual {
      position: relative;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .tech-circle {
      position: relative;
      width: 400px;
      height: 400px;
      border-radius: 50%;
      background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(6, 182, 212, 0.1));
      border: 2px solid rgba(99, 102, 241, 0.2);
      display: flex;
      align-items: center;
      justify-content: center;
      animation: pulse 4s infinite;
    }

    @keyframes pulse {
      0%, 100% { transform: scale(1); opacity: 0.8; }
      50% { transform: scale(1.05); opacity: 1; }
    }

    .tech-circle::before,
    .tech-circle::after {
      content: '';
      position: absolute;
      border-radius: 50%;
      border: 1px solid rgba(99, 102, 241, 0.1);
    }

    .tech-circle::before {
      width: 480px;
      height: 480px;
      animation: rotate 20s linear infinite;
    }

    .tech-circle::after {
      width: 560px;
      height: 560px;
      animation: rotate 30s linear infinite reverse;
    }

    @keyframes rotate {
      from { transform: rotate(0deg); }
      to { transform: rotate(360deg); }
    }

    .tech-icon {
      width: 250px;
      height: 250px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 8rem;
      box-shadow: 0 20px 60px rgba(99, 102, 241, 0.4);
      position: relative;
      z-index: 10;
    }

    /* Features */
    .features {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 2rem;
      margin-top: 4rem;
    }

    .feature-card {
      background: rgba(30, 41, 59, 0.5);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(99, 102, 241, 0.1);
      border-radius: 1rem;
      padding: 2rem;
      transition: all 0.3s ease;
    }

    .feature-card:hover {
      transform: translateY(-5px);
      border-color: var(--primary);
      box-shadow: 0 10px 30px rgba(99, 102, 241, 0.2);
    }

    .feature-icon {
      width: 60px;
      height: 60px;
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.5rem;
      margin-bottom: 1rem;
    }

    .feature-card h3 {
      font-size: 1.25rem;
      margin-bottom: 0.5rem;
      color: var(--text);
    }

    .feature-card p {
      color: var(--text-muted);
      font-size: 0.95rem;
      line-height: 1.6;
    }

    /* Footer */
    footer {
      margin-top: 8rem;
      padding: 2rem 0;
      border-top: 1px solid rgba(99, 102, 241, 0.1);
      text-align: center;
      color: var(--text-muted);
    }

    /* Responsive */
    @media (max-width: 768px) {
      .hero-content {
        grid-template-columns: 1fr;
        gap: 2rem;
      }

      .hero-text h1 {
        font-size: 2rem;
      }

      .tech-circle {
        width: 300px;
        height: 300px;
      }

      .tech-icon {
        width: 180px;
        height: 180px;
        font-size: 5rem;
      }

      .features {
        grid-template-columns: 1fr;
      }

      .logo {
        font-size: 1.2rem;
      }
    }
  </style>
</head>

<body>
  <div class="bg-animation"></div>
  <div class="grid-overlay"></div>

  <header>
    <div class="container">
      <div class="header-content">
        <a href="#" class="logo">PT. BPR PRIMA NADI</a>
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
              Login Sekarang
              <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                <path d="M4.167 10h11.666M10 4.167L15.833 10 10 15.833" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </a>
          </div>

          <div class="hero-visual">
            <div class="tech-circle">
              <div class="tech-icon">🔐</div>
            </div>
          </div>
        </div>

        <div class="features">
          <div class="feature-card">
            <div class="feature-icon">⚡</div>
            <h3>Verifikasi Cepat</h3>
            <p>Sistem otomatis yang memverifikasi data nasabah dalam hitungan detik dengan akurasi tinggi</p>
          </div>
          <div class="feature-card">
            <div class="feature-icon">🛡️</div>
            <h3>Keamanan Terjamin</h3>
            <p>Teknologi enkripsi modern melindungi setiap transaksi dan data nasabah Anda</p>
          </div>
          <div class="feature-card">
            <div class="feature-icon">📊</div>
            <h3>Dashboard Analytics</h3>
            <p>Pantau semua aktivitas verifikasi melalui dashboard yang intuitif dan real-time</p>
          </div>
        </div>
      </div>
    </section>
  </main>

  <footer>
    <div class="container">
      <p>© 2024 <strong>PT. BPR Prima Nadi</strong> - All Rights Reserved</p>
    </div>
  </footer>
</body>
</html>