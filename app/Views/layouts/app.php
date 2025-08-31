<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pakar Diagnosis Penyakit Tanaman Ubi Jalar - Dinas Ketahanan Pangan Kota Binjai</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #3b82f6;
            --primary-light: #dbeafe;
            --secondary: #f1f5f9;
            --background: #ffffff;
            --foreground: #0f172a;
            --muted-foreground: #64748b;
            --card: #ffffff;
            --card-foreground: #0f172a;
            --border: #e2e8f0;
            --shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            color: var(--foreground);
            background-color: var(--background);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        /* Header Styles */
        .header {
            position: sticky;
            top: 0;
            z-index: 50;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border);
        }

        .header-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 4rem;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .logo-icon {
            width: 2rem;
            height: 2rem;
            color: var(--primary);
        }

        .logo-text {
            display: flex;
            flex-direction: column;
        }

        .logo-title {
            font-size: 1.125rem;
            font-weight: bold;
        }

        .logo-subtitle {
            font-size: 0.75rem;
            color: var(--muted-foreground);
        }

        .nav {
            display: none;
            align-items: center;
            gap: 2rem;
        }

        .nav a {
            text-decoration: none;
            color: var(--foreground);
            transition: color 0.3s;
        }

        .nav a:hover {
            color: var(--primary);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s;
            cursor: pointer;
            border: none;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background-color: #2563eb;
        }

        .btn-outline {
            background-color: transparent;
            color: var(--foreground);
            border: 1px solid var(--border);
        }

        .btn-outline:hover {
            background-color: var(--secondary);
        }

        .btn-lg {
            padding: 0.75rem 2rem;
            font-size: 1.125rem;
        }

        /* Hero Section */
        .hero {
            padding: 5rem 0 8rem;
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 3rem;
            align-items: center;
        }

        .hero-content {
            text-align: center;
        }

        .hero-title {
            font-size: 2.5rem;
            font-weight: bold;
            line-height: 1.2;
            margin-bottom: 1rem;
        }

        .hero-title .highlight {
            color: var(--primary);
        }

        .hero-description {
            font-size: 1.125rem;
            color: var(--muted-foreground);
            margin-bottom: 2rem;
            line-height: 1.7;
        }

        .hero-buttons {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .hero-stats {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-top: 2rem;
        }

        .stat {
            text-align: center;
        }

        .stat-number {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--primary);
        }

        .stat-label {
            font-size: 0.875rem;
            color: var(--muted-foreground);
        }

        .hero-image {
            position: relative;
        }

        .hero-image-container {
            aspect-ratio: 1;
            border-radius: 1rem;
            background: linear-gradient(135deg, var(--secondary), var(--card));
            overflow: hidden;
        }

        .hero-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .hero-badge {
            position: absolute;
            bottom: -1.5rem;
            left: -1.5rem;
            background: var(--background);
            border: 1px solid var(--border);
            border-radius: 0.75rem;
            padding: 1rem;
            box-shadow: var(--shadow);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .hero-badge-icon {
            width: 2rem;
            height: 2rem;
            color: var(--primary);
        }

        /* Section Styles */
        .section {
            padding: 5rem 0;
        }

        .section-alt {
            background-color: rgba(241, 245, 249, 0.3);
        }

        .section-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .section-title {
            font-size: 2.25rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .section-description {
            font-size: 1.125rem;
            color: var(--muted-foreground);
            max-width: 42rem;
            margin: 0 auto;
        }

        /* Grid Layouts */
        .grid {
            display: grid;
            gap: 2rem;
        }

        .grid-3 {
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        }

        .grid-2 {
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        }

        /* Card Styles */
        .card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 0.5rem;
            padding: 2rem;
            box-shadow: var(--shadow);
            text-align: center;
        }

        .card-icon {
            width: 4rem;
            height: 4rem;
            background: var(--primary-light);
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
        }

        .card-number {
            width: 4rem;
            height: 4rem;
            background: var(--primary-light);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--primary);
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .card-description {
            color: var(--muted-foreground);
        }

        /* Feature Cards */
        .feature-card {
            text-align: left;
            padding: 0;
            border: none;
            box-shadow: none;
            background: transparent;
        }

        .feature-icon {
            width: 3rem;
            height: 3rem;
            background: var(--primary-light);
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
        }

        /* Testimonial Cards */
        .testimonial-card {
            text-align: left;
        }

        .stars {
            display: flex;
            gap: 0.25rem;
            margin-bottom: 1rem;
        }

        .star {
            width: 1rem;
            height: 1rem;
            background: var(--primary);
            border-radius: 50%;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-top: 1rem;
        }

        .author-avatar {
            width: 2.5rem;
            height: 2.5rem;
            background: var(--primary-light);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: var(--primary);
        }

        .author-name {
            font-weight: 600;
        }

        .author-title {
            font-size: 0.875rem;
            color: var(--muted-foreground);
        }

        /* CTA Section */
        .cta {
            background: linear-gradient(135deg, var(--primary-light), rgba(241, 245, 249, 0.3));
            border-radius: 1rem;
            padding: 3rem;
            text-align: center;
        }

        .cta-title {
            font-size: 2.25rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
        }

        .cta-description {
            font-size: 1.125rem;
            color: var(--muted-foreground);
            margin-bottom: 2rem;
        }

        .cta-buttons {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            align-items: center;
        }

        /* Footer */
        .footer {
            background: var(--card);
            border-top: 1px solid var(--border);
            padding: 3rem 0;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .footer-section h3 {
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .footer-section ul {
            list-style: none;
        }

        .footer-section ul li {
            margin-bottom: 0.5rem;
        }

        .footer-section a {
            color: var(--muted-foreground);
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-section a:hover {
            color: var(--primary);
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 0.75rem;
            color: var(--muted-foreground);
        }

        .footer-bottom {
            border-top: 1px solid var(--border);
            padding-top: 2rem;
            text-align: center;
            color: var(--muted-foreground);
        }

        /* Mobile Menu */
        .mobile-menu-btn {
            display: block;
            background: none;
            border: none;
            cursor: pointer;
        }

        .mobile-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: var(--background);
            border-bottom: 1px solid var(--border);
            padding: 1rem;
        }

        .mobile-menu.active {
            display: block;
        }

        .mobile-menu a {
            display: block;
            padding: 0.75rem 0;
            text-decoration: none;
            color: var(--foreground);
            border-bottom: 1px solid var(--border);
        }

        /* Responsive Design */
        @media (min-width: 768px) {
            .nav {
                display: flex;
            }

            .mobile-menu-btn {
                display: none;
            }

            .hero-content {
                text-align: left;
            }

            .hero-grid {
                grid-template-columns: 1fr 1fr;
            }

            .hero-title {
                font-size: 3.75rem;
            }

            .hero-buttons {
                flex-direction: row;
            }

            .hero-stats {
                justify-content: flex-start;
            }

            .cta-buttons {
                flex-direction: row;
                justify-content: center;
            }
        }

        @media (min-width: 1024px) {
            .container {
                padding: 0 2rem;
            }

            .hero {
                padding: 5rem 0 8rem;
            }

            .hero-title {
                font-size: 4rem;
            }

            .section-title {
                font-size: 2.5rem;
            }

            .cta-title {
                font-size: 2.5rem;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <!-- <svg class="logo-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                        </path>
                    </svg> -->

                    <img src="<?= base_url() ?>assets/images/Logobinjai.png" alt="" width="40px">
                    <div class="logo-text">
                        <span class="logo-title">Dinas Ketahanan Pangan</span>
                        <span class="logo-subtitle">Kota Binjai</span>
                    </div>
                </div>
                <nav class="nav">
                    <a href="#home">Beranda</a>
                    <a href="#diagnosis">Diagnosis</a>
                    <a href="#about">Tentang</a>
                    <a href="#contact">Kontak</a>
                </nav>
                <!-- <li class="d-lg-none"><a href="">Log In</a></li> -->
                <a href="<?= url_to('admin.login') ?>" class="btn btn-primary" style="display: none;">Mulai
                    Diagnosis</a>
                <button class="mobile-menu-btn" onclick="toggleMobileMenu()">
                    <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
            <div class="mobile-menu" id="mobileMenu">
                <a href="#home">Beranda</a>
                <a href="#diagnosis">Diagnosis</a>
                <a href="#about">Tentang</a>
                <a href="#contact">Kontak</a>
                <a href="#diagnosis" class="btn btn-primary" style="margin-top: 1rem;">Mulai Diagnosis</a>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="container">
            <div class="hero-grid">
                <div class="hero-content">
                    <h1 class="hero-title">
                        Sistem Pakar Diagnosis Penyakit
                        <span class="highlight">Tanaman Ubi Jalar</span>
                    </h1>
                    <p class="hero-description">
                        Layanan digital Dinas Ketahanan Pangan dan Pertanian Kota Binjai untuk mendukung petani dalam
                        mendiagnosis penyakit tanaman ubi jalar menggunakan metode Certainty Factor yang akurat dan
                        terpercaya.
                    </p>
                    <div class="hero-buttons">
                        <a href="#diagnosis" class="btn btn-primary btn-lg">
                            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                style="margin-right: 0.5rem;">
                                <polygon points="13,2 3,14 12,14 11,22 21,10 12,10"></polygon>
                            </svg>
                            Mulai Diagnosis Sekarang
                        </a>
                        <a href="#about" class="btn btn-outline btn-lg">Panduan Penggunaan</a>
                    </div>
                    <div class="hero-stats">
                        <div class="stat">
                            <div class="stat-number">95%</div>
                            <div class="stat-label">Akurasi</div>
                        </div>
                        <div class="stat">
                            <div class="stat-number">500+</div>
                            <div class="stat-label">Petani Terlayani</div>
                        </div>
                        <div class="stat">
                            <div class="stat-number">24/7</div>
                            <div class="stat-label">Tersedia</div>
                        </div>
                    </div>
                </div>
                <div class="hero-image">
                    <div class="hero-image-container">
                        <img src="<?= base_url() ?>assets/images/sweet-potato-tech.png"
                            alt="Tanaman ubi jalar sehat dengan teknologi modern">
                    </div>
                    <div class="hero-badge">
                        <svg class="hero-badge-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                            </path>
                        </svg>
                        <div>
                            <div style="font-weight: 600;">Layanan Pemerintah</div>
                            <div style="font-size: 0.875rem; color: var(--muted-foreground);">Gratis & Terpercaya</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="section section-alt">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Cara Kerja Sistem</h2>
                <p class="section-description">
                    Proses diagnosis yang mudah dan akurat dalam 3 langkah sederhana
                </p>
            </div>
            <div class="grid grid-3">
                <div class="card">
                    <div class="card-number">1</div>
                    <h3 class="card-title">Input Gejala</h3>
                    <p class="card-description">
                        Masukkan gejala-gejala yang terlihat pada tanaman ubi jalar Anda melalui form yang mudah
                        dipahami
                    </p>
                </div>
                <div class="card">
                    <div class="card-number">2</div>
                    <h3 class="card-title">Analisis AI</h3>
                    <p class="card-description">
                        Sistem menganalisis gejala menggunakan metode Certainty Factor untuk menentukan tingkat
                        kepastian
                    </p>
                </div>
                <div class="card">
                    <div class="card-number">3</div>
                    <h3 class="card-title">Hasil & Solusi</h3>
                    <p class="card-description">
                        Dapatkan hasil diagnosis lengkap dengan rekomendasi penanganan yang tepat dan efektif
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="about" class="section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Keunggulan Layanan Kami</h2>
                <p class="section-description">
                    Layanan digital terdepan dari Pemerintah Kota Binjai untuk mendukung ketahanan pangan daerah
                </p>
            </div>
            <div class="grid grid-3">
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="card-title">Metode Certainty Factor</h3>
                    <p class="card-description">
                        Menggunakan metode ilmiah yang terbukti untuk mengukur tingkat kepastian diagnosis dengan akurat
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="card-title">Akurasi Tinggi</h3>
                    <p class="card-description">
                        Tingkat akurasi diagnosis mencapai 95% berdasarkan database penyakit yang komprehensif
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <polygon points="13,2 3,14 12,14 11,22 21,10 12,10"></polygon>
                        </svg>
                    </div>
                    <h3 class="card-title">Diagnosis Cepat</h3>
                    <p class="card-description">
                        Hasil diagnosis dapat diperoleh dalam hitungan menit dengan interface yang user-friendly
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="card-title">Rekomendasi Lengkap</h3>
                    <p class="card-description">
                        Setiap diagnosis disertai dengan rekomendasi penanganan dan pencegahan yang detail
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="card-title">Mudah Digunakan</h3>
                    <p class="card-description">
                        Interface yang intuitif dan mudah dipahami oleh petani dari berbagai tingkat pendidikan
                    </p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="card-title">Layanan Pemerintah</h3>
                    <p class="card-description">
                        Dikembangkan oleh Dinas Ketahanan Pangan Kota Binjai dengan dukungan ahli pertanian
                        berpengalaman
                    </p>
                </div>
            </div>
        </div>
    </section>


    <!-- CTA Section -->
    <section id="diagnosis" class="section">
        <div class="container">
            <div class="cta">
                <h2 class="cta-title">
                    Wujudkan Ketahanan Pangan Kota Binjai Bersama Kami
                </h2>
                <p class="cta-description">
                    Manfaatkan layanan digital gratis dari Dinas Ketahanan Pangan dan Pertanian Kota Binjai untuk
                    meningkatkan produktivitas pertanian ubi jalar Anda
                </p>
                <div class="cta-buttons">
                    <a href="#" class="btn btn-primary btn-lg">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            style="margin-right: 0.5rem;">
                            <polygon points="13,2 3,14 12,14 11,22 21,10 12,10"></polygon>
                        </svg>
                        Mulai Diagnosis Gratis
                    </a>
                    <a href="#contact" class="btn btn-outline btn-lg">Hubungi Dinas Kami</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contact" class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-section">
                    <div class="logo" style="margin-bottom: 1rem;">
                        <svg class="logo-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                            </path>
                        </svg>
                        <div class="logo-text">
                            <span class="logo-title">Dinas Ketahanan Pangan</span>
                            <span class="logo-subtitle">Kota Binjai</span>
                        </div>
                    </div>
                    <p style="color: var(--muted-foreground);">
                        Layanan digital untuk mendukung ketahanan pangan dan pertanian berkelanjutan di Kota Binjai
                        melalui
                        sistem pakar diagnosis penyakit tanaman ubi jalar.
                    </p>
                </div>
                <div class="footer-section">
                    <h3>Layanan</h3>
                    <ul>
                        <li><a href="#">Diagnosis Penyakit</a></li>
                        <li><a href="#">Konsultasi Pertanian</a></li>
                        <li><a href="#">Database Penyakit</a></li>
                        <li><a href="#">Panduan Penanganan</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Informasi</h3>
                    <ul>
                        <li><a href="#">Tentang Dinas</a></li>
                        <li><a href="#">Program Kerja</a></li>
                        <li><a href="#">Berita Pertanian</a></li>
                        <li><a href="#">Panduan Layanan</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Kontak</h3>
                    <div class="contact-item">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                            </path>
                        </svg>
                        <span>(061) 8821234</span>
                    </div>
                    <div class="contact-item">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                        <span>ketahananpangan@binjaikota.go.id</span>
                    </div>
                    <div class="contact-item">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span>Jl. Veteran No. 1, Binjai, Sumatera Utara</span>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2024 Dinas Ketahanan Pangan dan Pertanian Kota Binjai. Semua hak dilindungi undang-undang.</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobileMenu');
            mobileMenu.classList.toggle('active');
        }

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                    // Close mobile menu if open
                    document.getElementById('mobileMenu').classList.remove('active');
                }
            });
        });

        // Show/hide header button on larger screens
        function updateHeaderButton() {
            const headerButton = document.querySelector('.header .btn-primary');
            if (window.innerWidth >= 768) {
                headerButton.style.display = 'inline-flex';
            } else {
                headerButton.style.display = 'none';
            }
        }

        // Initial call and resize listener
        updateHeaderButton();
        window.addEventListener('resize', updateHeaderButton);

        // Close mobile menu when clicking outside
        document.addEventListener('click', function (e) {
            const mobileMenu = document.getElementById('mobileMenu');
            const mobileMenuBtn = document.querySelector('.mobile-menu-btn');

            if (!mobileMenu.contains(e.target) && !mobileMenuBtn.contains(e.target)) {
                mobileMenu.classList.remove('active');
            }
        });
    </script>
</body>

</html>