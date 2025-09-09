
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Hendra - Modern Web</title>
    <link rel="stylesheet" href="/css/csshendra.css">
</head>
<body>
    <header>
        <img src="/img/logo.png" alt="Logo Laravel Hendra" style="height:40px;">
        <nav>
            <a href="#">Beranda</a>
            <div class="dropdown">
                <a href="#">Tentang</a>
                <div class="dropdown-content">
                    <a href="#">Profil</a>
                    <a href="#">Sejarah</a>
                </div>
            </div>
            <div class="dropdown">
                <a href="#" id="kontakBtn">Kontak</a>
                <div class="dropdown-content">
                    <a href="#" onclick="showTable('hp')">Nomor HP</a>
                    <a href="#" onclick="showTable('email')">Email</a>
                    <a href="#" onclick="showTable('alamat')">Alamat</a>
                </div>
            </div>
            <!-- ...existing code... -->
<form class="search-form" action="#" method="get">
    <input type="text" name="q" placeholder="Cari..." />
    <button type="submit" aria-label="Cari">
        <svg width="22" height="22" viewBox="0 0 22 22" fill="none">
            <circle cx="10" cy="10" r="8" stroke="#fff" stroke-width="2"/>
            <line x1="16" y1="16" x2="21" y2="21" stroke="#fff" stroke-width="2" stroke-linecap="round"/>
        </svg>
    </button>
</form>
<!-- ...existing code... -->
            <a href="#">Login</a>
        </nav>
    </header>
   <!-- ...existing code... -->

    <!-- Slideshow foto di paling atas -->
    <div class="slideshow-container" style="margin-bottom:2rem;">
        <img src="/img/foto1.jpg" class="slide-foto" id="slide1" style="display:block;">
        <img src="/img/foto2.jpg" class="slide-foto" id="slide2" style="display:none;">
        <img src="/img/foto3.jpg" class="slide-foto" id="slide3" style="display:none;">
    </div>
    <!-- Kolom produk dan info lainnya -->
    <div class="produk-container">
        <div class="produk-kiri">
            <h2>Produk BPR PRIMA NADI</h2>
            <div id="carousel-tabel">
                <table class="kontak-table" id="tabel1">
                    <tr><td>Produk</td><td>Tabungan Prima</td></tr>
                    <tr><td>Bunga</td><td>2% per tahun</td></tr>
                </table>
                <table class="kontak-table" id="tabel2" style="display:none;">
                    <tr><td>Produk</td><td>Kredit Usaha</td></tr>
                    <tr><td>Plafon</td><td>Hingga 500 juta</td></tr>
                </table>
                <table class="kontak-table" id="tabel3" style="display:none;">
                    <tr><td>Produk</td><td>Deposito</td></tr>
                    <tr><td>Tenor</td><td>1, 3, 6, 12 bulan</td></tr>
                </table>
            </div>
            <p>
                Ini adalah halaman depan web modern yang dibuat dengan HTML dan CSS. 
                Desain ini responsif dan cocok untuk berbagai perangkat.
            </p>
        </div>
        <div class="produk-kanan">
            <!-- Kosong atau bisa diisi konten lain -->
        </div>
    </div>

<!-- ...existing code... -->
    <div id="kontak-table" style="display:none;">
        <table class="kontak-table">
            <tbody id="kontak-table-body">
                <!-- Isi tabel akan muncul di sini -->
            </tbody>
        </table>
    </div>
    
    <!-- ...existing code... -->

<section class="info-section">
    <div class="info-container">
        <div class="info-box">
            <h3>Tentang Perusahaan</h3>
            <p>
                BPR Prima Nadi adalah lembaga keuangan yang berkomitmen memberikan layanan terbaik untuk masyarakat. Kami menyediakan produk tabungan, kredit usaha, dan deposito dengan bunga kompetitif.
            </p>
        </div>
        <div class="info-box">
           <h3>Profil Perusahaan</h3>
            <p>
                PT BPR Prima Nadi berdiri sejak tahun 2000 dan telah melayani ribuan nasabah di wilayah Jakarta dan sekitarnya. Dengan dukungan SDM profesional, kami terus berinovasi dalam produk dan layanan keuangan.
            </p>
            <h4>Struktur Organisasi</h4>
            <img src="/img/struktur-organisasi.png" alt="Struktur Organisasi" style="width:100%;max-width:400px;border-radius:12px;">
        </div>
        <div class="info-box">
            <h4>Visi & Misi</h4>
            <strong>Visi:</strong>
            <p>Menjadi BPR terpercaya dan terdepan dalam pelayanan keuangan masyarakat.</p>
            <strong>Misi:</strong>
            <ul>
                <li>Meningkatkan kualitas layanan dan produk keuangan.</li>
                <li>Mendukung pertumbuhan ekonomi lokal.</li>
                <li>Membangun SDM yang profesional dan berintegritas.</li>
            </ul>
        </div>
    </div>
</section>
<!-- ...existing code... -->

<section class="info-section">
    <div class="info-container">
        <div class="info-box">
            <h3>Tentang Perusahaan</h3>
            <p>
                BPR Prima Nadi adalah lembaga keuangan yang berkomitmen memberikan layanan terbaik untuk masyarakat. Kami menyediakan produk tabungan, kredit usaha, dan deposito dengan bunga kompetitif.
            </p>
        </div>
        <div class="info-box">
            <h3>Berita Terbaru</h3>
            <ul>
                <li><strong>15 Agustus 2025:</strong> BPR Prima Nadi membuka cabang baru di Jakarta Selatan.</li>
                <li><strong>10 Juli 2025:</strong> Promo bunga deposito hingga 5% per tahun.</li>
                <li><strong>1 Juni 2025:</strong> Peluncuran aplikasi mobile banking.</li>
            </ul>
        </div>
        <div class="info-box">
            <h3>Kontak Kami</h3>
            <table class="kontak-table">
                <tr>
                    <td>Nomor Telpon</td>
                    <td>0812-3456-7890</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>info@bprprimanadi.co.id</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>Jl. Merdeka No. 123, Jakarta</td>
                </tr>
            </table>
            <div class="maps-box" style="margin-top:1rem;">
                <iframe 
                    src="https://www.google.com/maps?q=Jl.+Merdeka+No.+123,+Jakarta&output=embed"
                    width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </div>
</section>
<!-- ...existing code... -->
    <footer>
        &copy; 2025 Laravel Hendra. All rights reserved.
    </footer>
    <script>
        function showTable(type) {
            var table = document.getElementById('kontak-table');
            var body = document.getElementById('kontak-table-body');
            var html = '';
            if(type === 'hp') {
                html = '<tr><td>Nomor HP</td><td>0812-3456-7890</td></tr>';
            } else if(type === 'email') {
                html = '<tr><td>Email</td><td>hendra@example.com</td></tr>';
            } else if(type === 'alamat') {
                html = '<tr><td>Alamat</td><td>Jl. Merdeka No. 123, Jakarta</td></tr>';
            }
            body.innerHTML = html;
            table.style.display = 'block';
        }
    </script>
    <script src="/js/script.js"></script>
    <script src="/js/detikotomatis.js"></script>
</body>
</html>