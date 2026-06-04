<?php

$title = 'Tanggapan';

require '../../src/app.php';

require '../../layouts/header.php';

require '../../layouts/navPetugas.php';

// logic backend

$id = $_GET["id_pengaduan"];

$result = mysqli_query($conn, "SELECT * FROM pengaduan WHERE id_pengaduan = $id");

$petugas_list = mysqli_query($conn, "SELECT * FROM petugas ORDER BY level ASC, nama_petugas ASC");

if (isset($_POST["submit"])) {

  if (tanggapan($_POST) > 0) {
    $sukses = true;
  } else {
    $error = true;
  }
}

?>


<div class="container py-4">
  <div class="row align-items-center mb-4 animate-fade-in-up">
    <div class="col-12">
      <h3 class="text-dark font-weight-bold mb-1">Berikan Tanggapan Laporan</h3>
      <p class="text-secondary small mb-0">Tulis tanggapan atau penjelasan resmi mengenai aduan yang telah diverifikasi.</p>
    </div>
  </div>

  <hr>

  <?php if (isset($sukses)) : ?>
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" style="border-radius: 0.75rem;" role="alert">
      <span class="font-weight-bold text-success"><i class="fas fa-check-circle mr-2"></i> Tanggapan berhasil dikirim! Terima kasih atas respon Anda.</span>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php endif; ?>

  <?php if (isset($error)) : ?>
    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" style="border-radius: 0.75rem;" role="alert">
      <span class="font-weight-bold text-danger"><i class="fas fa-exclamation-circle mr-2"></i> Gagal mengirim tanggapan. Mungkin laporan ini sudah ditanggapi sebelumnya.</span>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php endif; ?>

  <div class="card shadow-sm border-0 animate-fade-in-up mt-4">
    <div class="card-body p-5">
      <div class="row">
        <!-- Left Column: Illustration & Image Attachment -->
        <div class="col-lg-5 text-center mb-4 mb-lg-0 border-right pr-lg-5 d-flex flex-column align-items-center justify-content-center">
          
          <div class="w-100 mt-2">
            <span class="font-weight-bold text-secondary small d-block mb-2">Foto Bukti Terlampir</span>
            <div class="img-preview-container shadow-sm p-2 bg-white rounded border" style="max-width: 100%;">
              <?php 
              // Fetch a temporary associative row for the photo
              $temp_result = mysqli_query($conn, "SELECT foto FROM pengaduan WHERE id_pengaduan = $id");
              $temp_row = mysqli_fetch_assoc($temp_result);
              if (!empty($temp_row['foto'])) : ?>
                <img src="<?= ASSET_PATH; ?>img/<?= $temp_row['foto']; ?>" class="img-fluid rounded" style="max-height: 180px; object-fit: contain;" alt="Lampiran Bukti">
              <?php else : ?>
                <span class="text-muted small py-3 d-block">Tidak ada foto bukti terlampir</span>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <!-- Right Column: Form -->
        <div class="col-lg-7 pl-lg-5">
          <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <form action="" method="POST">
              <input type="hidden" name="id_pengaduan" value="<?= $row['id_pengaduan']; ?>">
              
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="nik" class="font-weight-bold text-secondary small">NIK Pelapor</label>
                  <input type="text" class="form-control shadow-sm" id="nik" name="nik" value="<?= $row['nik']; ?>" readonly>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="tgl_tanggapan" class="font-weight-bold text-secondary small">Tanggal Tanggapan</label>
                  <input type="date" class="form-control shadow-sm" id="tgl_tanggapan" name="tgl_tanggapan" value="<?= date('Y-m-d'); ?>" required>
                </div>
              </div>

              <div class="form-group mb-3">
                <label for="isi_laporan" class="font-weight-bold text-secondary small">Isi Aduan Masyarakat</label>
                <textarea class="form-control shadow-sm bg-light" id="isi_laporan" name="isi_laporan" rows="3" readonly><?= $row['isi_laporan']; ?></textarea>
              </div>

              <div class="form-group mb-3">
                <label for="tanggapan" class="font-weight-bold text-secondary small">Tulis Tanggapan Anda</label>
                <textarea class="form-control shadow-sm" id="tanggapan" name="tanggapan" rows="4" placeholder="Ketik tanggapan atau instruksi penyelesaian laporan di sini..." required></textarea>
              </div>

              <div class="form-group mb-4">
                <label for="petugas" class="font-weight-bold text-secondary small">Petugas Penanggung Jawab</label>
                <select name="id_petugas" id="petugas" class="form-control shadow-sm" required>
                  <option disabled selected value="">Pilih Petugas / Admin</option>
                  <?php while($p = mysqli_fetch_assoc($petugas_list)) : ?>
                    <option value="<?= $p['id_petugas']; ?>"><?= $p['nama_petugas']; ?> (<?= ucfirst($p['level']); ?>)</option>
                  <?php endwhile; ?>
                </select>
              </div>

              <div class="d-flex justify-content-between align-items-center mt-4">
                <a href="terverify.php" class="text-secondary small font-weight-bold"><i class="fas fa-arrow-left mr-1"></i> Kembali</a>
                <button type="submit" name="submit" class="btn btn-primary px-4 shadow-lg"><i class="fas fa-paper-plane mr-2"></i> Kirim Tanggapan</button>
              </div>
            </form>
          <?php endwhile; ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require '../../layouts/footer.php'; ?>