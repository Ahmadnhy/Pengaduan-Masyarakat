<?php require_once __DIR__ . '/src/app.php'; ?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>WPM - Portal Pengaduan & Aspirasi Masyarakat</title>
  <meta content="Portal resmi penyampaian pengaduan, keluhan, dan aspirasi masyarakat secara online, transparan, dan aman." name="description">
  <meta content="pengaduan masyarakat, keluhan, aspirasi publik, wpm" name="keywords">

  <!-- Favicons -->
  <link rel="icon" type="image/png" href="<?= ASSET_PATH; ?>img/icon.png">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= ASSET_PATH; ?>vendor/aos/aos.css" rel="stylesheet">
  <link href="<?= ASSET_PATH; ?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= ASSET_PATH; ?>vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?= ASSET_PATH; ?>vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="<?= ASSET_PATH; ?>vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?= ASSET_PATH; ?>vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?= ASSET_PATH; ?>css/style.css" rel="stylesheet">
  <style>
    /* Premium Inline Overrides for Landing Page */
    body {
      font-family: 'Inter', sans-serif;
      background-color: #f8fafc;
    }
    h1, h2, h3, h4, h5, h6, .logo span, .nav-link {
      font-family: 'Plus Jakarta Sans', sans-serif;
    }
    .header {
      background: rgba(255, 255, 255, 0.75) !important;
      backdrop-filter: blur(16px) !important;
      -webkit-backdrop-filter: blur(16px) !important;
      border-bottom: 1px solid rgba(226, 232, 240, 0.6);
      box-shadow: 0 4px 30px rgba(0, 0, 0, 0.02);
    }
    .hero {
      position: relative;
      background-color: #f8fafc !important;
      background-image: 
        radial-gradient(at 0% 0%, rgba(99, 102, 241, 0.15) 0px, transparent 50%),
        radial-gradient(at 100% 0%, rgba(54, 185, 204, 0.12) 0px, transparent 50%),
        radial-gradient(at 50% 100%, rgba(244, 63, 94, 0.08) 0px, transparent 50%),
        url("data:image/svg+xml,%3Csvg width='80' height='80' viewBox='0 0 80 80' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M80 0H0v80h80V0zM1 79V1h78v78H1z' fill='%2394a3b8' fill-opacity='0.03' fill-rule='evenodd'/%3E%3C/svg%3E") !important;
      overflow: hidden;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding-top: 80px; /* Offset fixed header for vertical centering */
    }
    .hero-title {
      font-size: 3.5rem;
      font-weight: 800;
      letter-spacing: -1px;
      background: linear-gradient(135deg, #1e1b4b 0%, #4f46e5 50%, #06b6d4 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      line-height: 1.15;
    }
    .btn-get-started {
      background: linear-gradient(135deg, #4f46e5 0%, #06b6d4 100%) !important;
      border: none !important;
      border-radius: 50px !important;
      padding: 16px 44px !important;
      font-weight: 700 !important;
      letter-spacing: 0.5px;
      box-shadow: 0 10px 25px rgba(79, 70, 229, 0.25) !important;
      transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1) !important;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      line-height: 1;
    }
    .btn-get-started:hover {
      transform: translateY(-3px) scale(1.02) !important;
      box-shadow: 0 15px 35px rgba(79, 70, 229, 0.35) !important;
    }
    .btn-get-started span {
      display: inline-block;
      line-height: 1;
    }
    .btn-get-started i {
      font-size: 1.25rem;
      line-height: 1;
      margin-left: 6px;
      display: inline-block;
      transition: transform 0.3s ease;
    }
    .btn-get-started:hover i {
      transform: translateX(4px);
    }
    .modal-content {
      border: 1px solid rgba(255, 255, 255, 0.8) !important;
      border-radius: 1.75rem !important;
      background: rgba(255, 255, 255, 0.9) !important;
      backdrop-filter: blur(16px) !important;
      -webkit-backdrop-filter: blur(16px) !important;
      box-shadow: 0 30px 60px rgba(0, 0, 0, 0.08) !important;
      overflow: hidden;
    }
    .modalss {
      border-radius: 50px !important;
      border: 1.5px solid #cbd5e1 !important;
      padding: 12px 30px !important;
      font-weight: 600;
      color: #475569 !important;
      transition: all 0.2s ease;
    }
    .modalss:hover {
      background-color: #f1f5f9 !important;
      color: #1e293b !important;
    }
    .modals {
      background: linear-gradient(135deg, #4f46e5 0%, #06b6d4 100%) !important;
      border: none !important;
      border-radius: 50px !important;
      padding: 12px 30px !important;
      font-weight: 600;
      box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2) !important;
    }
    .modals:hover {
      box-shadow: 0 6px 16px rgba(79, 70, 229, 0.3) !important;
    }
    @keyframes float-slow {
      0% { transform: translateY(0px) scale(1); }
      100% { transform: translateY(-20px) scale(1.05); }
    }
  </style>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="index.php" class="logo d-flex align-items-center">
        <span class="fs-4">WPM</span>
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="index.php">Home</a></li>
          <li><a class="nav-link scrollto" href="public/user/login.php">Login Warga</a></li>
          <li><a class="nav-link scrollto" href="public/user/register.php">Daftar Akun</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero d-flex align-items-center">
    
    <!-- Floating background glow elements -->
    <div class="position-absolute" style="top: 15%; left: 10%; width: 300px; height: 300px; background: rgba(99, 102, 241, 0.2); filter: blur(80px); border-radius: 50%; pointer-events: none; z-index: 0; animation: float-slow 15s infinite alternate;"></div>
    <div class="position-absolute" style="bottom: 15%; right: 10%; width: 250px; height: 250px; background: rgba(54, 185, 204, 0.15); filter: blur(70px); border-radius: 50%; pointer-events: none; z-index: 0; animation: float-slow 12s infinite alternate-reverse;"></div>

    <div class="container" style="position: relative; z-index: 2;">
      <div class="row justify-content-center">
        <div class="col-lg-9 d-flex flex-column align-items-center justify-content-center text-center">
          <h1 data-aos="fade-up" class="hero-title text-center mb-3">Layanan Pengaduan & Aspirasi Warga</h1>
          <h2 data-aos="fade-up" data-aos-delay="400" class="mt-3 fs-5 text-secondary text-center" style="line-height: 1.6; max-width: 750px;">Sampaikan laporan, keluhan, dan aspirasi Anda secara online dan aman langsung kepada pihak berwenang. Bersama kita wujudkan pelayanan publik yang lebih transparan dan responsif.</h2>
          <div data-aos="fade-up" data-aos-delay="600" class="mt-4 text-center">
            <a href="#" class="btn-get-started scrollto" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
              <span>Mulai</span>
              <i class="bi bi-arrow-right-short"></i>
            </a>
          </div>
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-0 p-3">
        <div class="modal-header border-0">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center p-4">
          <i class="fas fa-info-circle text-primary mb-3" style="font-size: 3.5rem; display: block; margin: 0 auto;"></i>

          <h4 class="fw-bold mb-2">Sebelum mulai...</h4>
          <p class="text-secondary fs-6">Pastikan kamu sudah mendaftarkan akun masyarakat terlebih dahulu ya.</p>

          <div class="d-flex justify-content-center gap-3 mt-4">
              <a href="public/user/login.php" class="btn btn-light modalss px-4">Login</a>
              <a href="public/user/register.php" class="btn btn-primary modals px-4 text-white">Daftar</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Vendor JS Files -->
  <script src="<?= ASSET_PATH; ?>vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="<?= ASSET_PATH; ?>vendor/aos/aos.js"></script>
  <script src="<?= ASSET_PATH; ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= ASSET_PATH; ?>vendor/glightbox/js/glightbox.min.js"></script>
  <script src="<?= ASSET_PATH; ?>vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="<?= ASSET_PATH; ?>vendor/swiper/swiper-bundle.min.js"></script>
  <script src="<?= ASSET_PATH; ?>vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="<?= ASSET_PATH; ?>js/main.js"></script>

</body>

</html>