<!DOCTYPE html>
<html lang="id">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Sistem Pakar Diagnosis Penyakit Tanaman Ubi Jalar - Dinas Ketahanan Pangan dan Pertanian Kota Binjai">
    <meta name="keywords" content="sistem pakar, ubi jalar, diagnosis penyakit, pertanian, binjai, ketahanan pangan">
    <meta name="author" content="Dinas Ketahanan Pangan dan Pertanian Kota Binjai">
    <title>Login - Sistem Pakar Ubi Jalar | Dinas Ketahanan Pangan Kota Binjai</title>

    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- <link rel="stylesheet" href="<= base_url() ?>assets/css/quill.snow.css"> -->

    <style>
        :root {
            --primary-color: #1e40af;
            --secondary-color: #3b82f6;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --light-bg: #f8fafc;
            --dark-text: #1e293b;
            --gray-text: #64748b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            min-height: 100vh;
            color: var(--dark-text);
        }

        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .login-image {
            background: linear-gradient(rgba(30, 64, 175, 0.8), rgba(59, 130, 246, 0.8)),
                url('/placeholder.svg?height=800&width=600') center/cover;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            position: relative;
        }

        .image-overlay {
            text-align: center;
            z-index: 2;
            padding: 2rem;
        }

        .image-overlay h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .image-overlay p {
            font-size: 1.2rem;
            opacity: 0.9;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }

        .login-card {
            background: white;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .login-form-container {
            width: 100%;
            max-width: 400px;
        }

        .logo-section {
            text-align: center;
            margin-bottom: 2rem;
        }

        .logo-section img {
            width: 80px;
            height: 80px;
            margin-bottom: 1rem;
        }

        .logo-text {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .logo-subtitle {
            font-size: 0.9rem;
            color: var(--gray-text);
            line-height: 1.4;
        }

        .form-title {
            font-size: 1.8rem;
            font-weight: 600;
            color: var(--dark-text);
            margin-bottom: 0.5rem;
        }

        .form-subtitle {
            color: var(--gray-text);
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-weight: 500;
            color: var(--dark-text);
            margin-bottom: 0.5rem;
        }

        .form-control {
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(30, 64, 175, 0.1);
        }

        .input-group {
            position: relative;
        }

        .input-group .form-control {
            padding-right: 3rem;
        }

        .password-toggle {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--gray-text);
            cursor: pointer;
            z-index: 10;
        }

        .btn-primary {
            background: var(--primary-color);
            border: none;
            border-radius: 8px;
            padding: 0.75rem 2rem;
            font-weight: 500;
            font-size: 1rem;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-primary:hover {
            background: #1e3a8a;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(30, 64, 175, 0.3);
        }

        .alert {
            border-radius: 8px;
            border: none;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }

        .alert-success {
            background: #f0fdf4;
            color: #166534;
            border-left: 4px solid var(--success-color);
        }

        .alert-danger {
            background: #fef2f2;
            color: #dc2626;
            border-left: 4px solid var(--danger-color);
        }

        .footer-text {
            text-align: center;
            margin-top: 2rem;
            color: var(--gray-text);
            font-size: 0.9rem;
        }

        .government-badge {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 1rem;
            padding: 0.5rem;
            background: #f1f5f9;
            border-radius: 6px;
            font-size: 0.8rem;
            color: var(--gray-text);
        }

        @media (max-width: 768px) {
            .login-image {
                display: none;
            }

            .login-card {
                padding: 1rem;
            }

            .image-overlay h2 {
                font-size: 2rem;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid p-0">
        <div class="row g-0">
            <!-- Updated left side with sweet potato agriculture theme -->
            <div class="col-lg-7 d-none d-lg-block">
                <div class="login-image">
                    <div class="image-overlay">
                        <h2>Sistem Pakar Ubi Jalar</h2>
                        <p>Diagnosis Penyakit Tanaman Ubi Jalar<br>
                            Dinas Ketahanan Pangan dan Pertanian<br>
                            Kota Binjai</p>
                        <div class="mt-4">
                            <i class="fas fa-seedling fa-3x mb-3" style="opacity: 0.8;"></i>
                            <p style="font-size: 1rem;">Teknologi Cerdas untuk Pertanian Berkelanjutan</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Updated right side with Indonesian content and government branding -->
            <div class="col-lg-5">
                <div class="login-card">
                    <div class="login-form-container">
                        <div class="logo-section">
                            <img src="<?= base_url() ?>assets/images/Logobinjai.png" alt="Logo Kota Binjai"
                                class="mb-3">
                            <div class="logo-text">Sistem Pakar Ubi Jalar</div>
                            <div class="logo-subtitle">
                                Dinas Ketahanan Pangan dan Pertanian<br>
                                Kota Binjai
                            </div>
                        </div>

                        <!-- Updated alert messages for Indonesian -->
                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success" role="alert">
                                <i class="fas fa-check-circle me-2"></i>
                                <strong>Berhasil!</strong> <?= session()->getFlashdata('success') ?>
                            </div>
                        <?php endif ?>

                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <strong>Gagal!</strong> <?= session()->getFlashdata('error') ?>
                            </div>
                        <?php endif ?>

                        <!-- Updated form with Indonesian labels and professional styling -->
                        <form method="POST" action="<?= url_to('admin.cek.login') ?>" class="needs-validation"
                            novalidate>
                            <h4 class="form-title">Masuk ke Sistem</h4>
                            <p class="form-subtitle">Masukkan username dan password untuk mengakses sistem</p>

                            <div class="form-group">
                                <label class="form-label">Username</label>
                                <input class="form-control" name="username" type="text" required
                                    placeholder="Masukkan username Anda">
                                <div class="invalid-feedback">
                                    Username harus diisi
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Password</label>
                                <div class="input-group">
                                    <input class="form-control" type="password" name="login[password]" id="password"
                                        required placeholder="Masukkan password Anda">
                                    <button type="button" class="password-toggle" onclick="togglePassword()">
                                        <i class="fas fa-eye" id="toggleIcon"></i>
                                    </button>
                                </div>
                                <div class="invalid-feedback">
                                    Password harus diisi
                                </div>
                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-sign-in-alt me-2"></i>
                                    Masuk ke Sistem
                                </button>
                            </div>
                        </form>

                        <!-- Added government badge and removed social login -->
                        <!-- <div class="government-badge">
                            <i class="fas fa-shield-alt"></i>
                            <span>Sistem Resmi Pemerintah Kota Binjai</span>
                        </div>

                        <div class="footer-text">
                            <p>&copy; 2024 Dinas Ketahanan Pangan dan Pertanian Kota Binjai<br>
                                <small>Sistem Pakar Diagnosis Penyakit Tanaman Ubi Jalar</small>
                            </p>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        (function () {
            'use strict';
            window.addEventListener('load', function () {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function (form) {
                    form.addEventListener('submit', function (event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
</body>

</html>