<?php

$title = 'sukses';

require '../../src/app.php';

require '../../layouts/header.php';

?>


<div class="d-flex justify-content-center py-5 mt-5">
  <div class="card shadow glass-card animate-fade-in-up text-center" data-aos="zoom-in" style="max-width: 480px; width: 100%;">
    <div class="card-body p-5">
      <img src="<?= ASSET_PATH; ?>img/sksimage.png" class="img-fluid mb-4" style="max-height: 180px;" alt="Sukses">
      <h3 class="font-weight-bold text-dark mb-2">Registrasi Sukses!</h3>
      <h6 class="text-secondary mb-4" style="line-height: 1.5;">Akun Anda telah berhasil dibuat. Silakan login untuk mulai mengirimkan laporan dan keluhan Anda.</h6>
      <div class="mt-4">
        <a href="login.php" class="btn btn-primary btn-block shadow-lg py-2">Masuk Sekarang</a>
      </div>
    </div>
  </div>
</div>

<?php require '../../layouts/footer.php'; ?>