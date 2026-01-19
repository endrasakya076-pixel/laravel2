<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>PT. BPR PRIMA NADI</title>
  <meta name="description" content="">
  <meta name="keywords" content="">
  
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;600;700;900&family=Exo+2:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    :root {
      --primary: #00f0ff;
      --secondary: #7000ff;
      --accent: #ff00ff;
      --dark: #0a1628;
      --dark-light: #0f1f3a;
    }

    body {
      font-family: 'Exo 2', sans-serif;
      background: var(--dark);
      color: #fff;
      overflow-x: hidden;
    }

    /* Holographic Background */
    .hologram-bg {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: -1;
      background: radial-gradient(ellipse at top, #0f2847 0%, #0a1628 50%, #05111f 100%);
    }

    .hologram-bg::before {
      content: '';
      position: absolute;
      width: 100%;
      height: 100%;
      background: 
        repeating-linear-gradient(0deg, transparent, transparent 2px, rgba(0, 240, 255, 0.03) 2px, rgba(0, 240, 255, 0.03) 4px),
        repeating-linear-gradient(90deg, transparent, transparent 2px, rgba(112, 0, 255, 0.03) 2px, rgba(112, 0, 255, 0.03) 4px);
      animation: scanline 8s linear infinite;
    }

    @keyframes scanline {
      0% { transform: translateY(0); }
      100% { transform: translateY(20px); }
    }

    /* Floating Particles */
    .particles {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 0;
      pointer-events: none;
    }

    .particle {
      position: absolute;
      width: 2px;
      height: 2px;
      background: var(--primary);
      border-radius: 50%;
      box-shadow: 0 0 10px var(--primary);
      animation: float-particle 10s infinite;
      opacity: 0;
    }

    @keyframes float-particle {
      0%, 100% { opacity: 0; transform: translateY(0) translateX(0); }
      50% { opacity: 1; }
    }

    /* Light Beams */
    .light-beam {
      position: fixed;
      width: 2px;
      height: 100%;
      background: linear-gradient(to bottom, transparent, var(--primary), transparent);
      opacity: 0.1;
      animation: beam-move 6s infinite;
    }

    .light-beam:nth-child(1) { left: 20%; animation-delay: 0s; }
    .light-beam:nth-child(2) { left: 50%; animation-delay: 2s; }
    .light-beam:nth-child(3) { left: 80%; animation-delay: 4s; }

    @keyframes beam-move {
      0%, 100% { transform: translateX(-50px); opacity: 0; }
      50% { transform: translateX(50px); opacity: 0.2; }
    }

    /* Header */
    header {
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 1000;
      backdrop-filter: blur(20px);
      background: rgba(10, 22, 40, 0.8);
      border-bottom: 1px solid rgba(0, 240, 255, 0.2);
      padding: 1rem 0;
      box-shadow: 0 0 30px rgba(0, 240, 255, 0.1);
    }

    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 2rem;
      position: relative;
      z-index: 1;
    }

    .header-content {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .logo {
      font-family: 'Orbitron', sans-serif;
      font-size: 1.5rem;
      font-weight: 700;
      background: linear-gradient(90deg, var(--primary), var(--accent));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      text-decoration: none;
      text-shadow: 0 0 20px rgba(0, 240, 255, 0.5);
      animation: glow-text 3s ease-in-out infinite;
    }

    @keyframes glow-text {
      0%, 100% { filter: brightness(1); }
      50% { filter: brightness(1.3); }
    }

    /* Hero Section */
    .hero {
      min-height: 100vh;
      display: flex;
      align-items: center;
      padding: 6rem 0 4rem;
      position: relative;
    }

    .hero-content {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 4rem;
      align-items: center;
    }

    .hero-text h1 {
      font-family: 'Orbitron', sans-serif;
      font-size: 4rem;
      font-weight: 900;
      line-height: 1.2;
      margin-bottom: 1.5rem;
      background: linear-gradient(135deg, #fff 0%, var(--primary) 50%, var(--accent) 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      text-shadow: 0 0 50px rgba(0, 240, 255, 0.3);
      animation: flicker 5s infinite;
    }

    @keyframes flicker {
      0%, 100% { opacity: 1; }
      50% { opacity: 0.95; }
      51% { opacity: 1; }
      52% { opacity: 0.98; }
      53% { opacity: 1; }
    }

    .hero-text p {
      font-size: 1.125rem;
      line-height: 1.8;
      color: rgba(255, 255, 255, 0.7);
      margin-bottom: 2rem;
      text-shadow: 0 0 10px rgba(0, 240, 255, 0.2);
    }

    /* Holographic Button */
    .btn-hologram {
      position: relative;
      display: inline-flex;
      align-items: center;
      gap: 0.75rem;
      padding: 1.2rem 3rem;
      background: transparent;
      border: 2px solid var(--primary);
      color: var(--primary);
      font-family: 'Orbitron', sans-serif;
      font-weight: 600;
      font-size: 1rem;
      text-decoration: none;
      text-transform: uppercase;
      letter-spacing: 2px;
      overflow: hidden;
      transition: all 0.3s ease;
      clip-path: polygon(10% 0%, 100% 0%, 90% 100%, 0% 100%);
      box-shadow: 
        0 0 20px rgba(0, 240, 255, 0.5),
        inset 0 0 20px rgba(0, 240, 255, 0.1);
    }

    .btn-hologram::before {
      content: '';
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
      background: linear-gradient(45deg, transparent, rgba(0, 240, 255, 0.3), transparent);
      animation: hologram-sweep 3s infinite;
    }

    @keyframes hologram-sweep {
      0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
      100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
    }

    .btn-hologram:hover {
      background: rgba(0, 240, 255, 0.1);
      box-shadow: 
        0 0 40px rgba(0, 240, 255, 0.8),
        inset 0 0 30px rgba(0, 240, 255, 0.2);
      transform: translateY(-3px);
    }

    /* Holographic Display */
    .hologram-display {
      position: relative;
      width: 500px;
      height: 500px;
      margin: 0 auto;
    }

    .hologram-core {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 300px;
      height: 300px;
      background: radial-gradient(circle, rgba(0, 240, 255, 0.2), transparent 70%);
      border-radius: 50%;
      animation: pulse-hologram 3s infinite;
    }

    @keyframes pulse-hologram {
      0%, 100% { transform: translate(-50%, -50%) scale(1); opacity: 0.5; }
      50% { transform: translate(-50%, -50%) scale(1.2); opacity: 0.8; }
    }

    .hologram-ring {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      border: 2px solid var(--primary);
      border-radius: 50%;
      box-shadow: 
        0 0 20px var(--primary),
        inset 0 0 20px var(--primary);
      animation: rotate-ring 20s linear infinite;
    }

    .hologram-ring:nth-child(1) {
      width: 350px;
      height: 350px;
      animation-duration: 15s;
    }

    .hologram-ring:nth-child(2) {
      width: 450px;
      height: 450px;
      animation-duration: 25s;
      animation-direction: reverse;
      border-color: var(--accent);
      box-shadow: 
        0 0 20px var(--accent),
        inset 0 0 20px var(--accent);
    }

    .hologram-ring:nth-child(3) {
      width: 250px;
      height: 250px;
      animation-duration: 10s;
      border-color: var(--secondary);
      box-shadow: 
        0 0 20px var(--secondary),
        inset 0 0 20px var(--secondary);
    }

    @keyframes rotate-ring {
      from { transform: translate(-50%, -50%) rotate(0deg); }
      to { transform: translate(-50%, -50%) rotate(360deg); }
    }

    .hologram-icon {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      font-size: 8rem;
      z-index: 10;
      filter: drop-shadow(0 0 30px var(--primary));
      animation: float-icon 4s ease-in-out infinite;
    }

    @keyframes float-icon {
      0%, 100% { transform: translate(-50%, -50%) translateY(0) scale(1); }
      50% { transform: translate(-50%, -50%) translateY(-20px) scale(1.05); }
    }

    /* Hexagon Grid */
    .hex-grid {
      position: absolute;
      width: 100%;
      height: 100%;
      opacity: 0.1;
    }

    .hex {
      position: absolute;
      width: 60px;
      height: 60px;
      border: 1px solid var(--primary);
      clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
      animation: hex-glow 4s infinite;
    }

    .hex:nth-child(1) { top: 10%; left: 10%; animation-delay: 0s; }
    .hex:nth-child(2) { top: 20%; right: 15%; animation-delay: 1s; }
    .hex:nth-child(3) { bottom: 20%; left: 20%; animation-delay: 2s; }
    .hex:nth-child(4) { bottom: 15%; right: 10%; animation-delay: 3s; }

    @keyframes hex-glow {
      0%, 100% { opacity: 0.1; box-shadow: 0 0 5px var(--primary); }
      50% { opacity: 0.5; box-shadow: 0 0 20px var(--primary); }
    }

    /* Features */
    .features {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 2rem;
      margin-top: 6rem;
    }

    .feature-card {
      position: relative;
      background: rgba(15, 31, 58, 0.6);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(0, 240, 255, 0.3);
      padding: 2rem;
      transition: all 0.3s ease;
      clip-path: polygon(0 0, 100% 0, 100% calc(100% - 20px), calc(100% - 20px) 100%, 0 100%);
      overflow: hidden;
    }

    .feature-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(0, 240, 255, 0.1), transparent);
      transition: left 0.5s;
    }

    .feature-card:hover::before {
      left: 100%;
    }

    .feature-card:hover {
      transform: translateY(-10px);
      border-color: var(--primary);
      box-shadow: 
        0 0 30px rgba(0, 240, 255, 0.4),
        0 20px 40px rgba(0, 0, 0, 0.5);
    }

    .feature-icon {
      width: 70px;
      height: 70px;
      background: linear-gradient(135deg, var(--primary), var(--accent));
      clip-path: polygon(30% 0%, 70% 0%, 100% 30%, 100% 70%, 70% 100%, 30% 100%, 0% 70%, 0% 30%);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 2rem;
      margin-bottom: 1.5rem;
      box-shadow: 0 0 30px var(--primary);
      animation: rotate-feature 10s linear infinite;
    }

    @keyframes rotate-feature {
      from { transform: rotate(0deg); }
      to { transform: rotate(360deg); }
    }

    .feature-card h3 {
      font-family: 'Orbitron', sans-serif;
      font-size: 1.25rem;
      margin-bottom: 0.75rem;
      color: var(--primary);
      text-shadow: 0 0 10px var(--primary);
    }

    .feature-card p {
      color: rgba(255, 255, 255, 0.7);
      font-size: 0.95rem;
      line-height: 1.6;
    }

    /* Footer */
    footer {
      margin-top: 8rem;
      padding: 2rem 0;
      border-top: 1px solid rgba(0, 240, 255, 0.2);
      text-align: center;
      color: rgba(255, 255, 255, 0.5);
    }

    footer strong {
      color: var(--primary);
      text-shadow: 0 0 10px var(--primary);
    }

    /* Responsive */
    @media (max-width: 768px) {
      .hero-content {
        grid-template-columns: 1fr;
        gap: 3rem;
      }

      .hero-text h1 {
        font-size: 2.5rem;
      }

      .hologram-display {
        width: 100%;
        height: 400px;
      }

      .features {
        grid-template-columns: 1fr;
      }

      .logo {
        font-size: 1rem;
      }

      .btn-hologram {
        padding: 1rem 2rem;
        font-size: 0.9rem;
      }
    }
  </style>
</head>

<body>
  <div class="hologram-bg"></div>
  
  <div class="particles">
    <div class="light-beam"></div>
    <div class="light-beam"></div>
    <div class="light-beam"></div>
  </div>

  <header>
    <div class="container">
      <div class="header-content">
        <a href="#" class="logo">PT. BPR PRIMA NADI</a>
      </div>
    </div>
  </header>

  <main>
    <section class="hero">
      <div class="hex-grid">
        <div class="hex"></div>
        <div class="hex"></div>
        <div class="hex"></div>
        <div class="hex"></div>
      </div>

      <div class="container">
        <div class="hero-content">
          <div class="hero-text">
            <h1>MEMBANGUN BERSAMA MASYARAKAT</h1>
            <p>Verifikasi merupakan proses pengendalian internal untuk menjamin keabsahan instruksi nasabah dengan cara membandingkan identitas serta spesimen tanda tangan yang tersimpan dalam sistem dengan dokumen transaksi yang diajukan.</p>
            <a href="{{ route('login') }}" class="btn-hologram">
              <span>LOGIN SEKARANG</span>
              <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                <path d="M4.167 10h11.666M10 4.167L15.833 10 10 15.833" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </a>
          </div>

          <div class="hero-visual">
            <div class="hologram-display">
              <div class="hologram-core"></div>
              <div class="hologram-ring"></div>
              <div class="hologram-ring"></div>
              <div class="hologram-ring"></div>
              <div class="hologram-icon">🔐</div>
            </div>
          </div>
        </div>

        <div class="features">
          <div class="feature-card">
            <div class="feature-icon">⚡</div>
            <h3>VERIFIKASI CEPAT</h3>
            <p>Sistem otomatis yang memverifikasi data nasabah dalam hitungan detik dengan akurasi tinggi menggunakan teknologi AI terdepan</p>
          </div>
          <div class="feature-card">
            <div class="feature-icon">🛡️</div>
            <h3>KEAMANAN MAKSIMAL</h3>
            <p>Teknologi enkripsi quantum-resistant melindungi setiap transaksi dan data nasabah dengan standar keamanan tertinggi</p>
          </div>
          <div class="feature-card">
            <div class="feature-icon">📊</div>
            <h3>REAL-TIME ANALYTICS</h3>
            <p>Dashboard holografik yang menampilkan semua aktivitas verifikasi secara real-time dengan visualisasi data yang canggih</p>
          </div>
        </div>
      </div>
    </section>
  </main>

  <footer>
    <div class="container">
      <p>© 2024 <strong>PT. BPR PRIMA NADI</strong> - All Rights Reserved</p>
    </div>
  </footer>

  <script>
    // Generate random particles
    const particlesContainer = document.querySelector('.particles');
    for (let i = 0; i < 50; i++) {
      const particle = document.createElement('div');
      particle.className = 'particle';
      particle.style.left = Math.random() * 100 + '%';
      particle.style.top = Math.random() * 100 + '%';
      particle.style.animationDelay = Math.random() * 10 + 's';
      particle.style.animationDuration = (5 + Math.random() * 10) + 's';
      particlesContainer.appendChild(particle);
    }
  </script>
</body>
</html>