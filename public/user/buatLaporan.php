<?php

$title = 'Buat Laporan';

require '../../src/app.php';

require '../../layouts/header.php';

require '../../layouts/navUser.php';


// Logic


if (isset($_POST["submit"])) {

  if (tambahAduan($_POST) > 0) {
    $sukses = true;
  } else {
    $error = true;
  }
}


?>


<div class="container py-4">
  <div class="row animate-fade-in-up mb-4">
    <div class="col-12">
      <h3 class="text-dark font-weight-bold">Formulir Pengaduan Warga</h3>
      <p class="text-secondary small">Sampaikan keluhan atau saran Anda secara jujur, objektif, dan jelas.</p>
    </div>
  </div>

  <div class="card shadow glass-card border-0 animate-fade-in-up" data-aos="fade-up">
    <div class="card-body p-5">
      
      <?php if (isset($sukses)) : ?>
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" style="border-radius: 0.75rem;" role="alert">
          <span class="font-weight-bold text-success"><i class="fas fa-check-circle mr-2"></i> Laporan Anda berhasil dikirim! Petugas kami akan segera meninjau dan memproses laporan Anda.</span>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php endif; ?>

      <?php if (isset($error)) : ?>
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" style="border-radius: 0.75rem;" role="alert">
          <span class="font-weight-bold text-danger"><i class="fas fa-times-circle mr-2"></i> Maaf, laporan gagal dikirim. Silakan periksa kembali data yang Anda masukkan.</span>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php endif; ?>

      <div class="row">
        <div class="col-lg-8 mx-auto">
          <form action="" method="POST" enctype="multipart/form-data">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="tanggal" class="font-weight-bold text-secondary small">Tanggal Kejadian / Laporan</label>
                <input type="date" class="form-control shadow-sm" id="tanggal" name="tgl_pengaduan" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="nik" class="font-weight-bold text-secondary small">NIK Anda</label>
                <input type="number" class="form-control shadow-sm" id="nik" value="<?= isset($_SESSION['nik']) ? $_SESSION['nik'] : ''; ?>" placeholder="Masukkan 16 digit NIK" name="nik" required <?= isset($_SESSION['nik']) ? 'readonly' : ''; ?>>
              </div>
            </div>

            <div class="form-group mb-3">
              <label for="foto" class="font-weight-bold text-secondary small">Lampiran Foto Bukti</label>
              <input type="file" class="form-control-file form-control py-2 shadow-sm" id="foto" name="foto" required>
              <small class="text-muted">Pilih foto/gambar bukti laporan (.jpg, .png)</small>
            </div>

            <div class="form-group mb-4">
              <label for="isi" class="font-weight-bold text-secondary small">Rincian Laporan Kejadian</label>
              <textarea class="form-control shadow-sm" id="isi" rows="5" placeholder="Jelaskan secara rinci kronologi kejadian, tempat, dan hal terkait..." name="isi_laporan" required></textarea>
            </div>

            <input type="hidden" name="status" value="proses">

            <div class="d-flex justify-content-end">
              <button class="btn btn-primary shadow-lg px-4" name="submit">Kirim Laporan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require '../../layouts/footer.php'; ?>