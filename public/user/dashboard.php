<?php

$title = 'Home';

require '../../src/app.php';

require '../../layouts/header.php';

require '../../layouts/navUser.php';

?>

<div class="container py-4">
  <div class="card glass-card shadow-sm mb-4 animate-fade-in-up">
    <div class="card-body p-5">
      <div class="row align-items-center">
        <div class="col-lg-7 text-center text-lg-left mb-4 mb-lg-0">
          <h2 class="text-dark font-weight-bold mb-2">Selamat Datang di Portal WPM</h2>
          <p class="text-secondary mb-4 fs-6" style="line-height: 1.6;">
            Sampaikan segala bentuk keluhan, saran, maupun laporan mengenai fasilitas umum, pelayanan publik, atau aspirasi Anda demi kemajuan bersama secara cepat, mudah, dan aman.
          </p>
          <div class="d-flex justify-content-center justify-content-lg-start gap-3">
            <a href="buatLaporan.php" class="btn btn-primary shadow-lg mr-3">
              <i class="fas fa-edit mr-2"></i> Buat Laporan Baru
            </a>
            <a href="riwayat.php" class="btn btn-outline-primary">
              <i class="fas fa-history mr-2"></i> Riwayat Laporan
            </a>
          </div>
        </div>
        <div class="col-lg-5 text-center">
          <img src="<?= ASSET_PATH; ?>img/userdsh.png" class="img-fluid" style="max-height: 250px;" alt="Dashboard Warga" data-aos="fade-left" data-aos-duration="900">
        </div>
      </div>
    </div>
  </div>
</div>

<?php require '../../layouts/footer.php'; ?>