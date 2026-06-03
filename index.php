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
    }
    h1, h2, h3, h4, h5, h6, .logo span, .nav-link {
      font-family: 'Plus Jakarta Sans', sans-serif;
    }
    .header {
      background: rgba(255, 255, 255, 0.85) !important;
      backdrop-filter: blur(12px) !important;
      -webkit-backdrop-filter: blur(12px) !important;
      border-bottom: 1px solid rgba(226, 232, 240, 0.8);
      box-shadow: 0 4px 30px rgba(0, 0, 0, 0.03);
    }
    .hero {
      background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%) !important;
    }
    .btn-get-started {
      background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%) !important;
      border: none !important;
      border-radius: 50px !important;
      padding: 16px 40px !important;
      font-weight: 600 !important;
      box-shadow: 0 10px 25px rgba(79, 70, 229, 0.3) !important;
      transition: all 0.3s ease !important;
    }
    .btn-get-started:hover {
      transform: translateY(-2px) !important;
      box-shadow: 0 15px 30px rgba(79, 70, 229, 0.4) !important;
    }
    .modal-content {
      border: none !important;
      border-radius: 1.5rem !important;
      box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15) !important;
      overflow: hidden;
    }
    .modal-img {
      max-height: 180px;
      width: auto;
      display: block;
      margin: 10px auto 25px auto;
    }
    .modalss {
      border-radius: 50px !important;
      border: 1.5px solid #cbd5e1 !important;
      padding: 10px 25px !important;
      font-weight: 600;
      color: #475569 !important;
      transition: all 0.2s ease;
    }
    .modalss:hover {
      background-color: #f1f5f9 !important;
    }
    .modals {
      background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%) !important;
      border: none !important;
      border-radius: 50px !important;
      padding: 10px 25px !important;
      font-weight: 600;
      box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2) !important;
    }
    .modals:hover {
      box-shadow: 0 6px 16px rgba(79, 70, 229, 0.3) !important;
    }
  </style>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="index.php" class="logo d-flex align-items-center">
        <img src="<?= ASSET_PATH; ?>img/icon.png" alt="WPM" class="me-2" style="max-height: 42px;">
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

    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-9 d-flex flex-column align-items-center justify-content-center text-center">
          <h1 data-aos="fade-up" style="line-height: 1.2;" class="text-center font-weight-bold">Layanan Pengaduan & Aspirasi Warga</h1>
          <h2 data-aos="fade-up" data-aos-delay="400" class="mt-3 fs-5 text-secondary text-center" style="line-height: 1.6; max-width: 750px;">Sampaikan laporan, keluhan, dan aspirasi Anda secara online dan aman langsung kepada pihak berwenang. Bersama kita wujudkan pelayanan publik yang lebih transparan dan responsif.</h2>
          <div data-aos="fade-up" data-aos-delay="600" class="mt-4 text-center">
            <a href="#" class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
              <span>Mulai</span>
              <i class="bi bi-arrow-right-short fs-4 ms-1"></i>
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
          <img src="<?= ASSET_PATH; ?>img/Berfikir.png" class="modal-img" alt="Registrasi">

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