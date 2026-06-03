<?php

$title = 'Preview';

require '../../src/app.php';

require '../../layouts/header.php';

require '../../layouts/navUser.php';


// logic backend

$id = $_GET['id_tanggapan'];

$query = "SELECT * FROM (( tanggapan INNER JOIN pengaduan ON tanggapan.id_pengaduan = pengaduan.id_pengaduan ) 
                            INNER JOIN petugas ON tanggapan.id_petugas = petugas.id_petugas) WHERE id_tanggapan = $id";

$result = mysqli_query($conn, $query);

?>


<div class="container py-4">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      
      <div class="d-flex justify-content-between align-items-center mb-4 d-print-none animate-fade-in-up">
        <a href="tanggapan.php" class="btn btn-outline-secondary btn-sm shadow-sm"><i class="fas fa-arrow-left mr-1"></i> Kembali ke Riwayat</a>
        <button onclick="window.print();" class="btn btn-primary btn-sm shadow-sm"><i class="fas fa-print mr-1"></i> Cetak / Print Dokumen</button>
      </div>

      <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <div class="card shadow border-0 animate-fade-in-up" id="printable-area" style="border-radius: 1rem; overflow: hidden;">
          <!-- Card Header with Portal Identity -->
          <div class="card-header bg-gradient-primary text-white p-4 border-0 text-center">
            <h4 class="font-weight-bold mb-1 text-uppercase tracking-wider">Bukti Tanggapan Pengaduan</h4>
            <p class="text-white-50 small mb-0">Portal Pelayanan & Pengaduan Masyarakat WPM</p>
          </div>
          
          <div class="card-body p-5">
            <!-- Header Metadata -->
            <div class="row mb-4">
              <div class="col-md-6 mb-3 mb-md-0">
                <span class="text-secondary small d-block font-weight-bold text-uppercase">Pelapor (NIK)</span>
                <span class="text-dark font-weight-bold fs-5"><?= $row['nik']; ?></span>
              </div>
              <div class="col-md-6 text-md-right">
                <span class="text-secondary small d-block font-weight-bold text-uppercase">Status Pengaduan</span>
                <span class="badge badge-pill badge-success px-3 py-2 text-uppercase font-weight-bold"><i class="fas fa-check-circle mr-1"></i> Selesai Ditanggapi</span>
              </div>
            </div>

            <hr>

            <!-- Attachment & Timeline -->
            <div class="row my-4 align-items-center">
              <div class="col-md-5 text-center mb-4 mb-md-0">
                <span class="font-weight-bold text-secondary small d-block mb-2">Lampiran Bukti Foto</span>
                <div class="img-preview-container p-2 bg-white rounded border d-inline-block shadow-sm" style="max-width: 100%;">
                  <?php if (!empty($row['foto'])) : ?>
                    <img src="<?= ASSET_PATH; ?>img/<?= $row['foto']; ?>" class="img-fluid rounded" style="max-height: 180px; object-fit: contain;" alt="Lampiran Bukti">
                  <?php else : ?>
                    <img src="<?= ASSET_PATH; ?>img/investigate.png" class="img-fluid rounded" style="max-height: 180px; object-fit: contain;" alt="Default Bukti">
                  <?php endif; ?>
                </div>
              </div>
              
              <div class="col-md-7 border-left pl-md-4">
                <div class="mb-3">
                  <span class="text-secondary small d-block">Tanggal Pengajuan Laporan</span>
                  <span class="text-dark font-weight-bold"><i class="far fa-calendar-alt mr-2 text-primary"></i> <?= $row['tgl_pengaduan']; ?></span>
                </div>
                <div>
                  <span class="text-secondary small d-block">Tanggal Tanggapan Petugas</span>
                  <span class="text-dark font-weight-bold"><i class="far fa-calendar-check mr-2 text-success"></i> <?= $row['tgl_tanggapan']; ?></span>
                </div>
              </div>
            </div>

            <!-- Report Text Box -->
            <div class="my-4 p-4 rounded bg-light" style="border-left: 4px solid var(--primary);">
              <span class="text-primary font-weight-bold small d-block text-uppercase mb-2"><i class="fas fa-quote-left mr-1"></i> Isi Aduan Warga</span>
              <p class="text-dark mb-0 fs-6" style="line-height: 1.6; font-style: italic;">
                "<?= $row['isi_laporan']; ?>"
              </p>
            </div>

            <!-- Response Text Box -->
            <div class="my-4 p-4 rounded" style="background-color: #f0fdf4; border-left: 4px solid #10b981;">
              <span class="text-success font-weight-bold small d-block text-uppercase mb-2"><i class="fas fa-reply mr-1"></i> Tanggapan Resmi Petugas</span>
              <p class="text-dark mb-0 font-weight-bold fs-6" style="line-height: 1.6;">
                <?= $row['tanggapan']; ?>
              </p>
            </div>

            <hr class="my-4">

            <!-- Signature Area -->
            <div class="row mt-5">
              <div class="col-md-6 mb-4 mb-md-0">
                <span class="text-secondary small d-block">Metode Validasi</span>
                <span class="text-dark font-weight-bold small"><i class="fas fa-shield-alt text-success mr-1"></i> Sistem e-Verification Resmi</span>
              </div>
              <div class="col-md-6 text-md-right">
                <span class="text-secondary small d-block">Petugas Penanggung Jawab</span>
                <h5 class="text-dark font-weight-bold mb-0"><?= $row['nama_petugas']; ?></h5>
                <span class="badge badge-pill badge-primary px-3 py-1 mt-1 text-uppercase small"><?= $row['level']; ?></span>
              </div>
            </div>

          </div>
        </div>
      <?php endwhile; ?>

    </div>
  </div>
</div>



<?php require '../../layouts/footer.php'; ?>