@extends('layouts.app')

@section('title', 'Portfolio Profesional | Desainer Grafis & Video Editor')

@section('content')
    <!-- Hero Section -->
    <section id="home" class="hero-section">
        <div class="floating-elements">
            <div class="floating-circle circle-1"></div>
            <div class="floating-circle circle-2"></div>
            <div class="floating-circle circle-3"></div>
        </div>
        
        <div class="container position-relative z-2">
            <div class="row align-items-center">
                <div class="col-lg-8 mx-auto text-center hero-content">
                    <h1 class="fade-in">Nama Anda</h1>
                    <p class="lead fade-in" style="animation-delay: 0.2s">Desainer Grafis | Video Editor | Excel Specialist</p>
                    <p class="mb-4 fade-in" style="animation-delay: 0.4s">Mengubah ide menjadi visual yang memukau, cerita yang menarik, dan data yang bermakna</p>
                    <a href="#projects" class="btn btn-primary-custom fade-in" style="animation-delay: 0.6s">Lihat Karya Saya</a>
                </div>
            </div>
        </div>
        
        <a href="#skills" class="scroll-down">
            <i class="fas fa-chevron-down"></i>
        </a>
    </section>

    <!-- Skills Section -->
    <section id="skills" class="py-5">
        <div class="container">
            <div class="section-title text-center">
                <h2>Keahlian Saya</h2>
                <p class="lead">Kombinasi kreativitas dan keahlian teknis untuk menghasilkan karya terbaik</p>
            </div>
            
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="skill-card fade-in">
                        <div class="skill-icon design">
                            <i class="fas fa-palette"></i>
                        </div>
                        <h3>Desain Grafis</h3>
                        <p>Menciptakan identitas visual yang kuat dan memorable untuk berbagai brand dan proyek</p>
                        <div class="display-font">
                            <span class="fw-bold" style="color: #FF6B6B;">3 Proyek</span>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="skill-card fade-in" style="animation-delay: 0.2s">
                        <div class="skill-icon video">
                            <i class="fas fa-video"></i>
                        </div>
                        <h3>Editing Video</h3>
                        <p>Menyusun cerita visual yang engaging melalui editing profesional dan efek kreatif</p>
                        <div class="display-font">
                            <span class="fw-bold" style="color: #4ECDC4;">3 Proyek</span>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="skill-card fade-in" style="animation-delay: 0.4s">
                        <div class="skill-icon excel">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <h3>Excel & Analisis Data</h3>
                        <p>Mengolah data menjadi insight yang actionable dengan visualisasi yang mudah dipahami</p>
                        <div class="display-font">
                            <span class="fw-bold" style="color: #FFD93D;">2 Proyek</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section id="projects" class="py-5 bg-light">
        <div class="container">
            <div class="section-title text-center">
                <h2>Portfolio Proyek</h2>
                <p class="lead">Koleksi karya terpilih yang menunjukkan dedikasi dan kualitas pekerjaan</p>
            </div>
            
            <!-- Project Tabs -->
            <ul class="nav nav-pills justify-content-center mb-5" id="projectTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="design-tab" data-bs-toggle="pill" data-bs-target="#design" type="button" role="tab">Desain Grafis</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="video-tab" data-bs-toggle="pill" data-bs-target="#video" type="button" role="tab">Video Editing</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="excel-tab" data-bs-toggle="pill" data-bs-target="#excel" type="button" role="tab">Excel</button>
                </li>
            </ul>
            
            <!-- Project Content -->
            <div class="tab-content" id="projectTabContent">
                <!-- Design Projects -->
                <div class="tab-pane fade show active" id="design" role="tabpanel">
                    <div class="row g-4">
                        <div class="col-lg-4 col-md-6">
                            <div class="project-card fade-in">
                                <div class="project-img position-relative">
                                    <img src="https://images.unsplash.com/photo-1626785774625-ddcddc3445e9?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Branding Kafe Modern">
                                    <div class="project-category">Branding</div>
                                </div>
                                <div class="p-4">
                                    <h4>Branding Kafe Modern</h4>
                                    <p class="text-muted">Identitas visual lengkap untuk kafe dengan konsep minimalis modern, termasuk logo, menu, dan packaging</p>
                                    <div class="mb-3">
                                        <span class="badge bg-light text-dark me-2">Adobe Illustrator</span>
                                        <span class="badge bg-light text-dark me-2">Photoshop</span>
                                        <span class="badge bg-light text-dark">Figma</span>
                                    </div>
                                    <small class="text-muted">2024</small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-4 col-md-6">
                            <div class="project-card fade-in" style="animation-delay: 0.2s">
                                <div class="project-img position-relative">
                                    <img src="https://images.unsplash.com/photo-1611162617213-7d7a39e9b1d7?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Poster Event Musik">
                                    <div class="project-category">Print Design</div>
                                </div>
                                <div class="p-4">
                                    <h4>Poster Event Musik</h4>
                                    <p class="text-muted">Serangkaian poster promosi untuk festival musik dengan style bold dan vibrant</p>
                                    <div class="mb-3">
                                        <span class="badge bg-light text-dark me-2">Adobe Photoshop</span>
                                        <span class="badge bg-light text-dark">Illustrator</span>
                                    </div>
                                    <small class="text-muted">2024</small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-4 col-md-6">
                            <div class="project-card fade-in" style="animation-delay: 0.4s">
                                <div class="project-img position-relative">
                                    <img src="https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="UI/UX Mobile App">
                                    <div class="project-category">UI/UX Design</div>
                                </div>
                                <div class="p-4">
                                    <h4>UI/UX Mobile App</h4>
                                    <p class="text-muted">Desain antarmuka aplikasi mobile untuk e-commerce fashion dengan fokus pada user experience</p>
                                    <div class="mb-3">
                                        <span class="badge bg-light text-dark me-2">Figma</span>
                                        <span class="badge bg-light text-dark">Adobe XD</span>
                                    </div>
                                    <small class="text-muted">2023</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Video Projects -->
                <div class="tab-pane fade" id="video" role="tabpanel">
                    <div class="row g-4">
                        <div class="col-lg-4 col-md-6">
                            <div class="project-card">
                                <div class="project-img position-relative">
                                    <img src="https://images.unsplash.com/photo-1516035069371-29a1b244cc32?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Video Promosi Produk">
                                    <div class="project-category">Video Promosi</div>
                                </div>
                                <div class="p-4">
                                    <h4>Video Promosi Produk</h4>
                                    <p class="text-muted">Video promosi produk teknologi dengan animasi dan efek visual yang menarik</p>
                                    <div class="mb-3">
                                        <span class="badge bg-light text-dark me-2">Adobe Premiere Pro</span>
                                        <span class="badge bg-light text-dark">After Effects</span>
                                    </div>
                                    <small class="text-muted">2024</small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-4 col-md-6">
                            <div class="project-card">
                                <div class="project-img position-relative">
                                    <img src="https://images.unsplash.com/photo-1522869635100-9f4c5e86aa37?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Video Dokumenter">
                                    <div class="project-category">Dokumenter</div>
                                </div>
                                <div class="p-4">
                                    <h4>Video Dokumenter Perusahaan</h4>
                                    <p class="text-muted">Video dokumenter yang menceritakan perjalanan perusahaan dari awal berdiri hingga sekarang</p>
                                    <div class="mb-3">
                                        <span class="badge bg-light text-dark me-2">Final Cut Pro</span>
                                        <span class="badge bg-light text-dark">DaVinci Resolve</span>
                                    </div>
                                    <small class="text-muted">2023</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Excel Projects -->
                <div class="tab-pane fade" id="excel" role="tabpanel">
                    <div class="row g-4">
                        <div class="col-lg-4 col-md-6">
                            <div class="project-card">
                                <div class="project-img position-relative">
                                    <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Dashboard Excel">
                                    <div class="project-category">Dashboard</div>
                                </div>
                                <div class="p-4">
                                    <h4>Dashboard Analisis Penjualan</h4>
                                    <p class="text-muted">Dashboard interaktif untuk menganalisis data penjualan dengan visualisasi yang informatif</p>
                                    <div class="mb-3">
                                        <span class="badge bg-light text-dark me-2">Excel Advanced</span>
                                        <span class="badge bg-light text-dark">Power Query</span>
                                    </div>
                                    <small class="text-muted">2024</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="py-5">
        <div class="container">
            <div class="section-title text-center">
                <h2>Testimoni Klien</h2>
                <p class="lead">Kepercayaan dan kepuasan klien adalah prioritas utama</p>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="testimonial-card fade-in">
                        <div class="d-flex align-items-center mb-4">
                            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80" alt="Budi Santoso" class="testimonial-img">
                            <div>
                                <h5 class="mb-0">Budi Santoso</h5>
                                <small class="text-muted">CEO, TechStart Indonesia</small>
                            </div>
                        </div>
                        <div class="star-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="fst-italic">"Hasil desain grafis dan video promosi yang dibuat sangat melampaui ekspektasi kami. Profesional dan kreatif!"</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="testimonial-card fade-in" style="animation-delay: 0.2s">
                        <div class="d-flex align-items-center mb-4">
                            <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80" alt="Siti Nurhaliza" class="testimonial-img">
                            <div>
                                <h5 class="mb-0">Siti Nurhaliza</h5>
                                <small class="text-muted">Marketing Manager, Kafe Harmoni</small>
                            </div>
                        </div>
                        <div class="star-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="fst-italic">"Branding package yang sempurna! Logo dan identitas visual sangat mencerminkan karakter bisnis kami."</p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="testimonial-card fade-in" style="animation-delay: 0.4s">
                        <div class="d-flex align-items-center mb-4">
                            <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80" alt="Andi Wijaya" class="testimonial-img">
                            <div>
                                <h5 class="mb-0">Andi Wijaya</h5>
                                <small class="text-muted">Founder, UMKM Sejahtera</small>
                            </div>
                        </div>
                        <div class="star-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="fst-italic">"Dashboard Excel yang dibuat sangat membantu kami dalam menganalisis data penjualan. Sangat direkomendasikan!"</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- E-Books Section -->
    <section id="ebooks" class="py-5 bg-light">
        <div class="container">
            <div class="section-title text-center">
                <h2>E-Book Digital</h2>
                <p class="lead">Koleksi buku digital untuk meningkatkan skill dan pengetahuan Anda</p>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="ebook-card fade-in">
                        <div class="ebook-img position-relative">
                            <img src="https://images.unsplash.com/photo-1544947950-fa07a98d237f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Panduan Lengkap Adobe Illustrator">
                            <div class="project-category">Design</div>
                        </div>
                        <div class="p-4">
                            <h4>Panduan Lengkap Adobe Illustrator</h4>
                            <p class="text-muted">E-book komprehensif yang membahas teknik-teknik desain grafis menggunakan Adobe Illustrator dari dasar hingga mahir</p>
                            
                            <div class="d-flex align-items-center mb-3">
                                <div class="star-rating me-3">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <small class="text-muted">(124 ulasan)</small>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="ebook-price">Rp 150.000</div>
                                <button class="btn btn-primary-custom btn-sm">Beli Sekarang</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="ebook-card fade-in" style="animation-delay: 0.2s">
                        <div class="ebook-img position-relative">
                            <img src="https://images.unsplash.com/photo-1512820790803-83ca734da794?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Mastering Video Editing">
                            <div class="project-category">Video</div>
                        </div>
                        <div class="p-4">
                            <h4>Mastering Video Editing</h4>
                            <p class="text-muted">Buku digital yang mengajarkan teknik editing video profesional dengan Adobe Premiere Pro dan After Effects</p>
                            
                            <div class="d-flex align-items-center mb-3">
                                <div class="star-rating me-3">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <small class="text-muted">(89 ulasan)</small>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="ebook-price">Rp 175.000</div>
                                <button class="btn btn-primary-custom btn-sm">Beli Sekarang</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="ebook-card fade-in" style="animation-delay: 0.4s">
                        <div class="ebook-img position-relative">
                            <img src="https://images.unsplash.com/photo-1497633762265-9d179a990aa6?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Excel untuk Bisnis Modern">
                            <div class="project-category">Excel</div>
                        </div>
                        <div class="p-4">
                            <h4>Excel untuk Bisnis Modern</h4>
                            <p class="text-muted">Panduan lengkap penggunaan Excel untuk analisis data bisnis, dashboard, dan otomatisasi pekerjaan kantor</p>
                            
                            <div class="d-flex align-items-center mb-3">
                                <div class="star-rating me-3">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <small class="text-muted">(67 ulasan)</small>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="ebook-price">Rp 120.000</div>
                                <button class="btn btn-primary-custom btn-sm">Beli Sekarang</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-5 contact-section">
        <div class="container">
            <div class="section-title text-center">
                <h2>Hubungi Saya</h2>
                <p class="lead">Siap membantu mewujudkan ide kreatif Anda menjadi karya yang luar biasa</p>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow border-0">
                        <div class="card-body p-5">
                            <form id="contactForm" action="{{ route('portfolio.send-message') }}" method="POST">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Nama Lengkap" required>
                                            <label for="name">Nama Lengkap</label>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                                            <label for="email">Emaill</label>
                                        </div>
                                    </div>
                                    
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="subject" name="subject" placeholder="Subjek" required>
                                            <label for="subject">Subjek</label>
                                        </div>
                                    </div>
                                    
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <textarea class="form-control" id="message" name="message" placeholder="Pesan" style="height: 150px" required></textarea>
                                            <label for="message">Pesan</label>
                                        </div>
                                    </div>
                                    
                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn btn-primary-custom px-5">Kirim Pesan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Contact Info -->
            <div class="row mt-5">
                <div class="col-lg-4 text-center mb-4">
                    <div class="contact-info">
                        <div class="contact-icon mb-3">
                            <i class="fas fa-envelope fa-2x" style="color: #FF6B6B;"></i>
                        </div>
                        <h5>Email</h5>
                        <p>nama@email.com</p>
                    </div>
                </div>
                
                <div class="col-lg-4 text-center mb-4">
                    <div class="contact-info">
                        <div class="contact-icon mb-3">
                            <i class="fas fa-phone fa-2x" style="color: #4ECDC4;"></i>
                        </div>
                        <h5>Telepon</h5>
                        <p>+62 812 3456 7890</p>
                    </div>
                </div>
                
                <div class="col-lg-4 text-center mb-4">
                    <div class="contact-info">
                        <div class="contact-icon mb-3">
                            <i class="fas fa-map-marker-alt fa-2x" style="color: #FFD93D;"></i>
                        </div>
                        <h5>Lokasi</h5>
                        <p>Jakarta, Indonesia</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection