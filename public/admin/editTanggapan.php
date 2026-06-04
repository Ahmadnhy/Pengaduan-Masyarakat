<?php

$title = 'Edit Tanggapan';

require '../../src/app.php';

require '../../layouts/header.php';

require '../../layouts/navAdmin.php';

$id = $_GET["id_tanggapan"];

$result = mysqli_query($conn, "SELECT * FROM tanggapan WHERE id_tanggapan = $id");

$petugas_list = mysqli_query($conn, "SELECT * FROM petugas ORDER BY level ASC, nama_petugas ASC");

if (isset($_POST["submit"])) {
  if (editTanggapan($_POST) > 0) {
    $sukses = true;
    $result = mysqli_query($conn, "SELECT * FROM tanggapan WHERE id_tanggapan = $id");
  } else {
    $error = true;
  }
}

?>

<div class="container py-4">
  <div class="row align-items-center mb-4 animate-fade-in-up">
    <div class="col-12">
      <h3 class="text-dark font-weight-bold mb-1">Edit Tanggapan Pengaduan</h3>
      <p class="text-secondary small mb-0">Ubah isi tanggapan resmi yang diberikan kepada masyarakat.</p>
    </div>
  </div>

  <hr>

  <?php if (isset($sukses)) : ?>
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" style="border-radius: 0.75rem;" role="alert">
      <span class="font-weight-bold text-success"><i class="fas fa-check-circle mr-2"></i> Tanggapan berhasil diperbarui!</span>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php endif; ?>

  <?php if (isset($error)) : ?>
    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" style="border-radius: 0.75rem;" role="alert">
      <span class="font-weight-bold text-danger"><i class="fas fa-exclamation-circle mr-2"></i> Gagal memperbarui tanggapan atau tidak ada perubahan data.</span>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php endif; ?>

  <div class="card shadow-sm border-0 animate-fade-in-up mt-4">
    <div class="card-body p-5">
      <div class="row">
        <!-- Left Column: Illustration -->
        <div class="col-lg-5 text-center mb-4 mb-lg-0 border-right pr-lg-5 d-flex flex-column align-items-center justify-content-center">
          <i class="fas fa-reply-all text-primary mb-4" style="font-size: 3.5rem;"></i>
          <h5 class="text-primary font-weight-bold">Perbarui Respon</h5>
          <p class="text-secondary small text-center px-3">Pastikan tanggapan yang diubah tetap sopan, jelas, dan memberikan solusi yang terbaik.</p>
        </div>

        <!-- Right Column: Form -->
        <div class="col-lg-7 pl-lg-5">
          <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <form action="" method="POST">
              <input type="hidden" name="id_tanggapan" value="<?= $row['id_tanggapan']; ?>">
              
              <div class="form-group mb-3">
                <label for="tgl_tanggapan" class="font-weight-bold text-secondary small">Tanggal Tanggapan</label>
                <input type="date" class="form-control shadow-sm" id="tgl_tanggapan" name="tgl_tanggapan" value="<?= $row['tgl_tanggapan']; ?>" required>
              </div>

              <div class="form-group mb-3">
                <label for="tanggapan" class="font-weight-bold text-secondary small">Isi Tanggapan</label>
                <textarea class="form-control shadow-sm" id="tanggapan" name="tanggapan" rows="5" required><?= $row['tanggapan']; ?></textarea>
              </div>

              <div class="form-group mb-4">
                <label for="petugas" class="font-weight-bold text-secondary small">Petugas Penanggung Jawab</label>
                <select name="id_petugas" id="petugas" class="form-control shadow-sm" required>
                  <option disabled value="">Pilih Petugas / Admin</option>
                  <?php while($p = mysqli_fetch_assoc($petugas_list)) : ?>
                    <option value="<?= $p['id_petugas']; ?>" <?= $p['id_petugas'] === $row['id_petugas'] ? 'selected' : ''; ?>><?= $p['nama_petugas']; ?> (<?= ucfirst($p['level']); ?>)</option>
                  <?php endwhile; ?>
                </select>
              </div>

              <div class="d-flex justify-content-between align-items-center mt-4">
                <a href="tanggapan.php" class="text-secondary small font-weight-bold"><i class="fas fa-arrow-left mr-1"></i> Kembali</a>
                <button type="submit" name="submit" class="btn btn-primary px-4 shadow-lg">Simpan Perubahan</button>
              </div>
            </form>
          <?php endwhile; ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require '../../layouts/footer.php'; ?>
