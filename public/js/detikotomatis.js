// Carousel tabel otomatis
    let tabels = [
        document.getElementById('tabel1'),
        document.getElementById('tabel2'),
        document.getElementById('tabel3')
    ];
    let idx = 0;
    setInterval(function() {
        tabels[idx].style.display = 'none';
        idx = (idx + 1) % tabels.length;
        tabels[idx].style.display = 'table';
    }, 3000); // Ganti tabel setiap 3 detik

    // Aktifkan scroll smooth untuk semua anchor
    document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
        anchor.addEventListener('click', function(e) {
            var targetId = this.getAttribute('href').substring(1);
            var target = document.getElementById(targetId);
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });

    // Slideshow foto otomatis
let slides = [
    document.getElementById('slide1'),
    document.getElementById('slide2'),
    document.getElementById('slide3')
];
let slideIdx = 0;
setInterval(function() {
    slides[slideIdx].style.display = 'none';
    slideIdx = (slideIdx + 1) % slides.length;
    slides[slideIdx].style.display = 'block';
}, 3000);