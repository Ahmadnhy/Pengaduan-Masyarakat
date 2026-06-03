<?php

$title = 'Generate Laporan';

require '../../src/app.php';

require '../../layouts/header.php';

require '../../layouts/navUser.php';


// logic backend

$query = "SELECT * FROM (( tanggapan INNER JOIN pengaduan ON tanggapan.id_pengaduan = pengaduan.id_pengaduan )
                          INNER JOIN petugas ON tanggapan.id_petugas = petugas.id_petugas )";

$result = mysqli_query($conn, $query);

?>


<div class="container py-4">
  <div class="row align-items-center mb-4 animate-fade-in-up">
    <div class="col-12">
      <h3 class="text-dark font-weight-bold mb-1">Cetak / Unduh Laporan Pengaduan</h3>
      <p class="text-secondary small mb-0">Unduh dokumen pengaduan resmi Anda beserta tanggapan yang telah diselesaikan.</p>
    </div>
  </div>

  <hr>

  <div class="row animate-fade-in-up">
    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
      <div class="col-md-6 mb-4">
        <div class="card shadow-sm border-0 h-100" data-aos="fade-up">
          <div class="card-header d-flex justify-content-between align-items-center bg-transparent py-3">
            <span class="badge badge-light border text-dark p-2 font-weight-bold">NIK : <?= $row['nik']; ?></span>
            <a href="javascript:window.print();" class="btn btn-outline-primary btn-sm py-1 px-3">
              <i class="fas fa-download mr-1"></i> Cetak Laporan
            </a>
          </div>
          <div class="card-body p-4">
            <div class="row align-items-center mb-3">
              <div class="col-auto">
                <img src="<?= ASSET_PATH; ?>img/icon.png" style="max-height: 48px;" alt="Logo WPM">
              </div>
              <div class="col">
                <div class="small text-secondary font-weight-bold">Tanggal Lapor:</div>
                <div class="text-dark font-weight-bold small"><?= $row['tgl_pengaduan']; ?></div>
              </div>
              <div class="col text-right">
                <span class="badge-pill-status status-selesai">Selesai</span>
              </div>
            </div>
            
            <hr class="my-3">
            
            <div class="mb-3">
              <span class="text-primary font-weight-bold small d-block mb-1">ISI PENGADUAN:</span>
              <p class="text-dark small mb-0" style="line-height: 1.5;"><?= $row['isi_laporan']; ?></p>
            </div>
            
            <div class="p-3 bg-light rounded mb-3 border">
              <span class="text-success font-weight-bold small d-block mb-1"><i class="fas fa-reply mr-1"></i> TANGGAPAN RESMI:</span>
              <p class="text-dark font-italic small mb-0" style="line-height: 1.5;"><?= $row['tanggapan']; ?></p>
            </div>
            
            <div class="d-flex justify-content-between align-items-center mt-3 pt-2 border-top">
              <span class="small text-secondary">Ditanggapi oleh: <strong class="text-dark"><?= $row['nama_petugas']; ?></strong></span>
              <a href="preview.php?id_tanggapan=<?= $row['id_tanggapan']; ?>" class="btn btn-primary btn-sm py-1 px-3">Pratinjau</a>
            </div>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
    <?php if (mysqli_num_rows($result) === 0) : ?>
      <div class="col-12 text-center py-5 text-secondary animate-fade-in-up">
        <i class="fas fa-print fa-3x mb-3 text-gray-300"></i>
        <h6>Tidak ada dokumen laporan untuk dicetak.</h6>
      </div>
    <?php endif; ?>
  </div>
</div>

<?php require '../../layouts/footer.php'; ?>