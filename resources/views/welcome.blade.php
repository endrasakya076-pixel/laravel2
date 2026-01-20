<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>PT. BPR PRIMA NADI</title>
  <meta name="description" content="">
  <meta name="keywords" content="">
  
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
  
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    :root {
      --primary: #4A90E2;
      --primary-light: #6BA3E8;
      --primary-dark: #3B7DD6;
      --blue-bg: #E8F1FC;
      --blue-light: #F5F9FF;
      --accent: #5B9FED;
      --dark: #1e3a5f;
      --text-dark: #2c3e50;
    }

    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(135deg, #E8F1FC 0%, #F5F9FF 50%, #E0ECFA 100%);
      color: var(--text-dark);
      overflow-x: hidden;
      min-height: 100vh;
    }

    /* Floating Elements Background */
    .floating-elements {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 0;
      pointer-events: none;
      overflow: hidden;
    }

    .float-icon {
      position: absolute;
      opacity: 0.15;
      animation: float 15s infinite ease-in-out;
    }

    .float-icon:nth-child(1) {
      top: 10%;
      left: 5%;
      animation-delay: 0s;
      font-size: 2rem;
    }

    .float-icon:nth-child(2) {
      top: 20%;
      right: 10%;
      animation-delay: 2s;
      font-size: 1.5rem;
    }

    .float-icon:nth-child(3) {
      bottom: 15%;
      left: 8%;
      animation-delay: 4s;
      font-size: 1.8rem;
    }

    .float-icon:nth-child(4) {
      top: 60%;
      right: 5%;
      animation-delay: 1s;
      font-size: 2.2rem;
    }

    @keyframes float {
      0%, 100% { transform: translateY(0px) rotate(0deg); }
      50% { transform: translateY(-30px) rotate(10deg); }
    }

    /* Decorative Circles */
    .deco-circle {
      position: absolute;
      border-radius: 50%;
      border: 2px solid rgba(74, 144, 226, 0.2);
      animation: pulse-circle 4s infinite;
    }

    .deco-circle:nth-child(1) {
      width: 150px;
      height: 150px;
      top: 15%;
      right: 15%;
      animation-delay: 0s;
    }

    .deco-circle:nth-child(2) {
      width: 100px;
      height: 100px;
      bottom: 20%;
      left: 10%;
      animation-delay: 1s;
    }

    @keyframes pulse-circle {
      0%, 100% { transform: scale(1); opacity: 0.3; }
      50% { transform: scale(1.1); opacity: 0.5; }
    }

    /* Header */
    header {
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 1000;
      backdrop-filter: blur(20px);
      background: rgba(255, 255, 255, 0.9);
      border-bottom: 1px solid rgba(74, 144, 226, 0.1);
      padding: 1.2rem 0;
      box-shadow: 0 4px 20px rgba(74, 144, 226, 0.08);
    }

    .container {
      max-width: 1100px;
      margin: 0 auto;
      padding: 0 1.5rem;
      position: relative;
      z-index: 1;
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
      color: var(--primary);
      text-decoration: none;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .logo-icon {
      width: 40px;
      height: 40px;
      background: linear-gradient(135deg, var(--primary), var(--primary-light));
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 1.2rem;
      box-shadow: 0 4px 15px rgba(74, 144, 226, 0.3);
    }

    /* Hero Section */
    .hero {
      min-height: 100vh;
      display: flex;
      align-items: center;
      padding: 8rem 0 4rem;
      position: relative;
    }

    .hero-content {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 4rem;
      align-items: center;
    }

    .hero-text {
      max-width: 700px;
    }

    .hero-text h1 {
      font-family: 'Inter', sans-serif;
      font-size: 2.8rem;
      font-weight: 700;
      line-height: 1.3;
      margin-bottom: 1.5rem;
      color: var(--text-dark);
    }

    .hero-text h1 .highlight {
      background: linear-gradient(135deg, var(--primary), var(--accent));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .hero-text p {
      font-size: 1rem;
      line-height: 1.7;
      color: #5a6c7d;
      margin-bottom: 2rem;
    }

    .btn-primary {
      display: inline-flex;
      align-items: center;
      gap: 0.75rem;
      background: linear-gradient(135deg, var(--primary), var(--primary-light));
      color: white;
      padding: 1.2rem 3rem;
      border-radius: 50px;
      text-decoration: none;
      font-weight: 600;
      font-size: 1.05rem;
      transition: all 0.3s ease;
      box-shadow: 0 8px 25px rgba(74, 144, 226, 0.35);
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
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
      transition: left 0.5s;
    }

    .btn-primary:hover::before {
      left: 100%;
    }

    .btn-primary:hover {
      transform: translateY(-3px);
      box-shadow: 0 12px 35px rgba(74, 144, 226, 0.45);
    }

    /* Lock Visual */
    .lock-container {
      position: relative;
      width: 100%;
      height: 450px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    /* Rotating Circle */
    .rotating-circle {
      position: absolute;
      width: 350px;
      height: 350px;
      border: 3px dashed rgba(74, 144, 226, 0.3);
      border-radius: 50%;
      animation: rotate-slow 30s linear infinite;
    }

    .rotating-circle::before {
      content: '';
      position: absolute;
      top: -8px;
      left: 50%;
      transform: translateX(-50%);
      width: 12px;
      height: 12px;
      background: var(--primary);
      border-radius: 50%;
      box-shadow: 0 0 15px var(--primary);
    }

    @keyframes rotate-slow {
      from { transform: rotate(0deg); }
      to { transform: rotate(360deg); }
    }

    /* Lock */
    .lock-main {
      position: relative;
      width: 200px;
      height: 220px;
      z-index: 10;
    }

    .lock-shackle {
      position: absolute;
      top: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 100px;
      height: 80px;
      border: 20px solid var(--primary);
      border-bottom: none;
      border-radius: 80px 80px 0 0;
      box-shadow: 
        inset 0 5px 15px rgba(74, 144, 226, 0.3),
        0 0 30px rgba(74, 144, 226, 0.2);
    }

    .lock-body {
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 160px;
      height: 140px;
      background: linear-gradient(135deg, var(--primary-light), var(--primary));
      border-radius: 20px;
      box-shadow: 
        0 20px 60px rgba(74, 144, 226, 0.4),
        inset 0 -5px 20px rgba(0, 0, 0, 0.1),
        inset 0 5px 20px rgba(255, 255, 255, 0.3);
      animation: lock-glow 3s ease-in-out infinite;
    }

    @keyframes lock-glow {
      0%, 100% { box-shadow: 0 20px 60px rgba(74, 144, 226, 0.4), inset 0 -5px 20px rgba(0, 0, 0, 0.1), inset 0 5px 20px rgba(255, 255, 255, 0.3); }
      50% { box-shadow: 0 25px 70px rgba(74, 144, 226, 0.6), inset 0 -5px 20px rgba(0, 0, 0, 0.1), inset 0 5px 20px rgba(255, 255, 255, 0.3); }
    }

    .lock-keyhole {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 16px;
      height: 16px;
      background: #2c5aa0;
      border-radius: 50%;
      box-shadow: 0 0 15px rgba(44, 90, 160, 0.5);
      z-index: 5;
    }

    .lock-keyhole::after {
      content: '';
      position: absolute;
      top: 12px;
      left: 50%;
      transform: translateX(-50%);
      width: 8px;
      height: 20px;
      background: #2c5aa0;
      border-radius: 0 0 4px 4px;
    }

    /* Floating Security Icons */
    .security-icon {
      position: absolute;
      background: white;
      border-radius: 15px;
      padding: 1rem;
      box-shadow: 0 8px 25px rgba(74, 144, 226, 0.2);
      font-size: 1.8rem;
      animation: float-security 4s ease-in-out infinite;
    }

    .security-icon:nth-child(1) {
      top: 10%;
      left: 5%;
      animation-delay: 0s;
    }

    .security-icon:nth-child(2) {
      top: 15%;
      right: 8%;
      animation-delay: 1s;
    }

    .security-icon:nth-child(3) {
      bottom: 15%;
      left: 10%;
      animation-delay: 2s;
    }

    .security-icon:nth-child(4) {
      bottom: 20%;
      right: 5%;
      animation-delay: 1.5s;
    }

    @keyframes float-security {
      0%, 100% { transform: translateY(0px); }
      50% { transform: translateY(-15px); }
    }



    /* Footer */
    footer {
      margin-top: 8rem;
      padding: 3rem 0;
      background: white;
      border-top: 1px solid rgba(74, 144, 226, 0.1);
      text-align: center;
      color: #5a6c7d;
    }

    footer strong {
      color: var(--primary);
      font-weight: 600;
    }

    /* Responsive */
    @media (max-width: 1024px) {
      .container {
        max-width: 900px;
        padding: 0 1.5rem;
      }

      .hero-content {
        gap: 3rem;
      }

      .hero-text h1 {
        font-size: 2.3rem;
      }

      .lock-container {
        height: 400px;
      }

      .lock-main {
        transform: scale(0.9);
      }


    }

    @media (max-width: 768px) {
      .container {
        padding: 0 1.25rem;
      }

      .hero-content {
        grid-template-columns: 1fr;
        gap: 2rem;
      }

      .hero-text h1 {
        font-size: 2rem;
      }

      .hero-text p {
        font-size: 0.95rem;
      }

      .lock-container {
        height: 350px;
      }

      .lock-main {
        transform: scale(0.75);
      }



      .logo {
        font-size: 1.1rem;
      }

      .btn-primary {
        padding: 1rem 2rem;
        font-size: 1rem;
      }

      .security-icon {
        font-size: 1.3rem;
        padding: 0.7rem;
      }

      .floating-elements .float-icon {
        display: none;
      }
    }

    @media (max-width: 480px) {
      .hero-text h1 {
        font-size: 1.75rem;
      }

      .hero-text p {
        font-size: 0.9rem;
      }

      .lock-container {
        height: 320px;
      }

      .lock-main {
        transform: scale(0.65);
      }

      .logo {
        font-size: 1rem;
      }

      .btn-primary {
        padding: 0.9rem 1.8rem;
        font-size: 0.95rem;
      }

      .security-icon {
        font-size: 1.1rem;
        padding: 0.6rem;
      }
    }
  </style>
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
          <span>PT. BPR PRIMA NADI</span>
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