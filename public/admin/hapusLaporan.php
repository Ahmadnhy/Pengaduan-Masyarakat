<?php

$title = 'Hapus Laporan';

require '../../src/app.php';

require '../../layouts/header.php';

require '../../layouts/navAdmin.php';

$id = $_GET["id_pengaduan"];
$source = isset($_GET["source"]) ? $_GET["source"] : 'laporan';

if (deleteLaporan($id) > 0) {
    $sukses = true;
} else {
    $error = true;
}

?>

<?php if (isset($sukses)) : ?>
  <div class="container py-5">
    <div class="row justify-content-center py-5">
      <div class="col-md-6 text-center">
        <div class="card shadow-sm border-0 p-5 animate-fade-in-up" style="border-radius: 1.5rem;">
          <div class="card-body">
            <div class="mb-4">
              <i class="fas fa-check-circle text-success fa-5x mb-4" data-aos="zoom-in" data-aos-duration="700"></i>
            </div>
            <h3 class="font-weight-bold text-dark mb-2">Laporan Berhasil Dihapus</h3>
            <p class="text-secondary small mb-4">Laporan masyarakat beserta tanggapan terkait telah dihapus secara permanen.</p>
            
            <a href="<?= $source === 'terverify' ? 'terverify.php' : 'laporan.php'; ?>" class="btn btn-primary px-5 py-2 shadow-lg" style="border-radius: 25px;">Selesai</a>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>

<?php if (isset($error)) : ?>
  <div class="container py-5">
    <div class="row justify-content-center py-5">
      <div class="col-md-6 text-center">
        <div class="card shadow-sm border-0 p-5 animate-fade-in-up" style="border-radius: 1.5rem;">
          <div class="card-body">
            <div class="mb-4">
              <i class="fas fa-exclamation-circle text-danger fa-5x mb-4"></i>
            </div>
            <h3 class="font-weight-bold text-dark mb-2">Gagal Menghapus</h3>
            <p class="text-secondary small mb-4">Terjadi kesalahan pada server saat menghapus data laporan.</p>
            
            <a href="<?= $source === 'terverify' ? 'terverify.php' : 'laporan.php'; ?>" class="btn btn-secondary px-5 py-2 shadow-lg" style="border-radius: 25px;">Kembali</a>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>

<?php require '../../layouts/footer.php'; ?>
