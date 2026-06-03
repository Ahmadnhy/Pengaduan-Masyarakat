<?php

$title = 'Laporan';

require '../../src/app.php';

require '../../layouts/header.php';

require '../../layouts/navUser.php';


// logic backend

$result = mysqli_query($conn, "SELECT * FROM pengaduan WHERE status = 'selesai' ORDER BY id_pengaduan DESC");

?>

<div class="container py-4">
  <div class="row align-items-center mb-4 animate-fade-in-up">
    <div class="col-sm-6 text-center text-sm-left mb-3 mb-sm-0">
      <h3 class="text-dark font-weight-bold mb-1">Riwayat Pengaduan Selesai</h3>
      <p class="text-secondary small mb-0">Daftar laporan pengaduan Anda yang telah berhasil ditindaklanjuti.</p>
    </div>
    <div class="col-sm-6 text-center text-sm-right">
      <a href="buatLaporan.php" class="btn btn-primary shadow-lg">
        <i class="fas fa-plus mr-2"></i> Buat Laporan Baru
      </a>
    </div>
  </div>

  <hr>

  <div class="card shadow-sm border-0 animate-fade-in-up mt-4">
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table text-center table-hover">
          <thead>
            <tr>
              <th scope="col" style="width: 80px;">No</th>
              <th scope="col" style="width: 150px;">Tanggal</th>
              <th scope="col" style="width: 180px;">NIK</th>
              <th scope="col" class="text-left">Isi Pengaduan</th>
              <th scope="col" style="width: 150px;">Foto Bukti</th>
              <th scope="col" style="width: 150px;">Status</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1; ?>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
              <tr>
                <th scope="row" class="text-dark"><?= $i; ?>.</th>
                <td><?= $row["tgl_pengaduan"]; ?></td>
                <td><?= $row["nik"]; ?></td>
                <td class="text-left"><?= $row["isi_laporan"]; ?></td>
                <td>
                  <img src="<?= ASSET_PATH; ?>img/<?= $row["foto"]; ?>" class="img-thumbnail rounded" style="max-height: 50px; cursor: pointer;" alt="Bukti">
                </td>
                <td>
                  <span class="badge-pill-status status-selesai">Selesai</span>
                </td>
              </tr>
              <?php $i++; ?>
            <?php endwhile; ?>
            <?php if (mysqli_num_rows($result) === 0) : ?>
              <tr>
                <td colspan="6" class="text-center py-5 text-secondary">
                  <i class="fas fa-folder-open fa-3x mb-3 text-gray-300"></i>
                  <h6>Belum ada pengaduan yang selesai ditanggapi.</h6>
                </td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php require '../../layouts/footer.php'; ?>