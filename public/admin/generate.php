<?php

$title = 'Generate Laporan';

require '../../src/app.php';

require '../../layouts/header.php';

require '../../layouts/navAdmin.php';


// logic backend

$query = "SELECT * FROM (( tanggapan INNER JOIN pengaduan ON tanggapan.id_pengaduan = pengaduan.id_pengaduan )
                          INNER JOIN petugas ON tanggapan.id_petugas = petugas.id_petugas )";

$result = mysqli_query($conn, $query);

?>

<div class="row animate-fade-in-up mb-4">
  <div class="col-12">
    <div class="d-flex align-items-center justify-content-between">
      <div>
        <h2 class="text-dark font-weight-bold mb-0">Generate Laporan</h2>
        <p class="text-secondary small mt-1">Cetak bukti pengaduan resmi beserta tanggapan yang telah diselesaikan oleh petugas.</p>
      </div>
    </div>
  </div>
</div>

<div class="row animate-fade-in-up">
  <?php if (mysqli_num_rows($result) === 0) : ?>
    <div class="col-12 text-center py-5">
      <img src="<?= ASSET_PATH; ?>img/investigate.png" class="img-fluid mb-3" style="max-height: 200px;" alt="Data Kosong">
      <h5 class="text-secondary">Belum ada laporan yang ditanggapi.</h5>
    </div>
  <?php endif; ?>

  <?php while ($row = mysqli_fetch_assoc($result)) : ?>
    <div class="col-lg-6 mb-4">
      <div class="card shadow-sm border-0 h-100" style="border-radius: 1rem; overflow: hidden; transition: transform 0.2s, box-shadow 0.2s;">
        <div class="card-header bg-white border-bottom py-3 px-4 d-flex align-items-center justify-content-between">
          <div>
            <span class="text-secondary small d-block font-weight-bold">PELAPOR (NIK)</span>
            <span class="text-primary font-weight-bold" style="font-size: 1.1rem;"><?= $row['nik']; ?></span>
          </div>
          <span class="badge badge-success px-3 py-2 font-weight-bold" style="border-radius: 30px; font-size: 0.7rem; letter-spacing: 0.5px;">SELESAI</span>
        </div>
        
        <div class="card-body p-4 d-flex flex-column justify-content-between">
          <div class="row align-items-center mb-4">
            <div class="col-4 text-center">
              <span class="font-weight-bold text-secondary small d-block mb-2">Bukti Foto</span>
              <div class="p-1 bg-white rounded border shadow-sm d-inline-block" style="width: 100%; max-width: 120px;">
                <?php if (!empty($row['foto'])) : ?>
                  <img src="<?= ASSET_PATH; ?>img/<?= $row['foto']; ?>" class="img-fluid rounded" style="height: 80px; width: 100%; object-fit: cover;" alt="Bukti Foto">
                <?php else : ?>
                  <img src="<?= ASSET_PATH; ?>img/investigate.png" class="img-fluid rounded" style="height: 80px; width: 100%; object-fit: cover;" alt="Default Foto">
                <?php endif; ?>
              </div>
            </div>
            <div class="col-8 border-left pl-3">
              <div class="mb-2">
                <span class="text-secondary small d-block">Tanggal Pengaduan:</span>
                <span class="text-dark font-weight-bold small"><i class="far fa-calendar mr-1 text-primary"></i> <?= $row['tgl_pengaduan']; ?></span>
              </div>
              <div>
                <span class="text-secondary small d-block">Tanggal Tanggapan:</span>
                <span class="text-dark font-weight-bold small"><i class="far fa-calendar-check mr-1 text-success"></i> <?= $row['tgl_tanggapan']; ?></span>
              </div>
            </div>
          </div>

          <div class="p-3 bg-light rounded mb-3" style="border-left: 4px solid var(--primary); font-size: 0.85rem;">
            <span class="text-primary font-weight-bold d-block mb-1"><i class="fas fa-quote-left mr-1"></i> Isi Laporan:</span>
            <p class="text-dark mb-0 text-truncate" style="max-height: 4.8em; line-height: 1.6; font-style: italic;">
              "<?= $row['isi_laporan']; ?>"
            </p>
          </div>

          <div class="p-3 rounded mb-3" style="background-color: #f0fdf4; border-left: 4px solid #10b981; font-size: 0.85rem;">
            <span class="text-success font-weight-bold d-block mb-1"><i class="fas fa-reply mr-1"></i> Tanggapan:</span>
            <p class="text-dark mb-0 text-truncate" style="max-height: 4.8em; line-height: 1.6;">
              <?= $row['tanggapan']; ?>
            </p>
          </div>

          <div class="d-flex align-items-center justify-content-between border-top pt-3 mt-auto">
            <div>
              <span class="text-secondary small d-block">Petugas Penjawab:</span>
              <span class="text-dark font-weight-bold small"><i class="fas fa-user-shield mr-1 text-info"></i> <?= $row['nama_petugas']; ?></span>
            </div>
            <div class="d-flex">
              <a href="preview.php?id_tanggapan=<?= $row['id_tanggapan']; ?>" class="btn btn-outline-primary btn-sm font-weight-bold px-3 mr-2 shadow-sm" style="border-radius: 8px;">
                <i class="fas fa-eye mr-1"></i> Preview
              </a>
              <a href="preview.php?id_tanggapan=<?= $row['id_tanggapan']; ?>" target="_blank" class="btn btn-primary btn-sm font-weight-bold px-3 shadow-sm" style="border-radius: 8px;">
                <i class="fas fa-print mr-1"></i> Cetak
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php endwhile; ?>
</div>

<?php require '../../layouts/footer.php'; ?>