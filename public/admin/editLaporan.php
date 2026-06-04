<?php

$title = 'Edit Laporan';

require '../../src/app.php';

require '../../layouts/header.php';

require '../../layouts/navAdmin.php';

$id = $_GET["id_pengaduan"];
$source = isset($_GET["source"]) ? $_GET["source"] : 'laporan';

$result = mysqli_query($conn, "SELECT * FROM pengaduan WHERE id_pengaduan = $id");

if (isset($_POST["submit"])) {
  if (editLaporan($_POST) > 0) {
    $sukses = true;
    $result = mysqli_query($conn, "SELECT * FROM pengaduan WHERE id_pengaduan = $id");
  } else {
    $error = true;
  }
}

?>

<div class="container py-4">
  <div class="row align-items-center mb-4 animate-fade-in-up">
    <div class="col-12">
      <h3 class="text-dark font-weight-bold mb-1">Edit Laporan Pengaduan</h3>
      <p class="text-secondary small mb-0">Ubah detail laporan pengaduan masyarakat yang terdaftar di sistem.</p>
    </div>
  </div>

  <hr>

  <?php if (isset($sukses)) : ?>
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" style="border-radius: 0.75rem;" role="alert">
      <span class="font-weight-bold text-success"><i class="fas fa-check-circle mr-2"></i> Detail laporan berhasil diperbarui!</span>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php endif; ?>

  <?php if (isset($error)) : ?>
    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" style="border-radius: 0.75rem;" role="alert">
      <span class="font-weight-bold text-danger"><i class="fas fa-exclamation-circle mr-2"></i> Gagal memperbarui laporan atau tidak ada perubahan data.</span>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php endif; ?>

  <div class="card shadow-sm border-0 animate-fade-in-up mt-4">
    <div class="card-body p-5">
      <form action="" method="POST">
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
          <input type="hidden" name="id_pengaduan" value="<?= $row['id_pengaduan']; ?>">
          
          <div class="row">
            <!-- Left Column: Form Details -->
            <div class="col-lg-7 pr-lg-5">
              <h5 class="font-weight-bold text-dark mb-4">Detail Pengaduan</h5>
              
              <div class="form-group mb-3">
                <label for="tgl_pengaduan" class="font-weight-bold text-secondary small">Tanggal Pengaduan</label>
                <input type="date" class="form-control shadow-sm" id="tgl_pengaduan" value="<?= $row['tgl_pengaduan']; ?>" name="tgl_pengaduan" required>
              </div>

              <div class="form-group mb-3">
                <label for="nik" class="font-weight-bold text-secondary small">NIK Pelapor</label>
                <input type="number" class="form-control shadow-sm" id="nik" value="<?= $row['nik']; ?>" name="nik" required>
              </div>

              <div class="form-group mb-3">
                <label for="status" class="font-weight-bold text-secondary small">Status Pengaduan</label>
                <select name="status" id="status" class="form-control shadow-sm" required>
                  <option value="proses" <?= $row['status'] === 'proses' ? 'selected' : ''; ?>>Proses (Belum Terverifikasi)</option>
                  <option value="selesai" <?= $row['status'] === 'selesai' ? 'selected' : ''; ?>>Selesai (Terverifikasi)</option>
                </select>
              </div>

              <div class="form-group mb-4">
                <label for="isi_laporan" class="font-weight-bold text-secondary small">Rincian Laporan</label>
                <textarea class="form-control shadow-sm" id="isi_laporan" name="isi_laporan" rows="4" required><?= $row['isi_laporan']; ?></textarea>
              </div>

              <div class="d-flex justify-content-between align-items-center mt-4">
                <a href="<?= $source === 'terverify' ? 'terverify.php' : 'laporan.php'; ?>" class="text-secondary small font-weight-bold"><i class="fas fa-arrow-left mr-1"></i> Kembali</a>
                <button type="submit" name="submit" class="btn btn-primary px-4 shadow-lg">Simpan Perubahan</button>
              </div>
            </div>

            <!-- Right Column: Image Preview -->
            <div class="col-lg-5 text-center mt-4 mt-lg-0 d-flex flex-column align-items-center justify-content-center border-left pl-lg-5">
              <span class="font-weight-bold text-secondary small mb-3">Foto Bukti Lampiran</span>
              <div class="img-preview-container shadow-sm p-2 bg-white rounded border mb-3" style="max-width: 100%; width: 100%;">
                <?php if (!empty($row['foto'])) : ?>
                  <img src="<?= ASSET_PATH; ?>img/<?= $row['foto']; ?>" class="img-fluid rounded" style="max-height: 250px; object-fit: contain;" alt="Lampiran Bukti">
                <?php else : ?>
                  <div class="d-flex flex-column align-items-center justify-content-center bg-light rounded py-5 px-3" style="width: 250px; border: 2px dashed #dee2e6; margin: 0 auto;">
                    <i class="fas fa-image text-muted mb-2" style="font-size: 2.5rem;"></i>
                    <span class="text-secondary small font-weight-bold">Tidak Ada Foto Bukti</span>
                  </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      </form>
    </div>
  </div>
</div>

<?php require '../../layouts/footer.php'; ?>
