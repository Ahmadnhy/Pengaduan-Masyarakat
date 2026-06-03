<?php

$title = 'Laporan Masyarakat';

require '../../src/app.php';

require '../../layouts/header.php';

require '../../layouts/navPetugas.php';


// logic backend

$result = mysqli_query($conn, "SELECT * FROM pengaduan WHERE status = 'proses' ORDER BY id_pengaduan DESC");

?>

<div class="container py-4">
  <div class="row align-items-center mb-4 animate-fade-in-up">
    <div class="col-12">
      <h3 class="text-dark font-weight-bold mb-1">Daftar Pengaduan Masuk</h3>
      <p class="text-secondary small mb-0">Kelola dan verifikasi laporan baru yang disampaikan oleh masyarakat.</p>
    </div>
  </div>

  <hr>

  <div class="card shadow-sm border-0 animate-fade-in-up mt-4">
    <div class="card-body p-4">
      <div class="table-responsive">
        <table class="table table-hover text-center align-middle mb-0">
          <thead class="thead-light">
            <tr>
              <th scope="col" style="width: 60px;">No</th>
              <th scope="col">Tanggal Masuk</th>
              <th scope="col">NIK Pelapor</th>
              <th scope="col">Isi Laporan</th>
              <th scope="col" style="width: 150px;">Foto Bukti</th>
              <th scope="col" style="width: 120px;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1; ?>
            <?php if (mysqli_num_rows($result) > 0) : ?>
              <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                  <td class="align-middle font-weight-bold text-secondary"><?= $i; ?>.</td>
                  <td class="align-middle"><?= $row["tgl_pengaduan"]; ?></td>
                  <td class="align-middle font-weight-bold text-dark"><?= $row["nik"]; ?></td>
                  <td class="align-middle text-left" style="max-width: 300px;"><?= $row["isi_laporan"]; ?></td>
                  <td class="align-middle">
                    <?php if (!empty($row['foto'])) : ?>
                      <img src="<?= ASSET_PATH; ?>img/<?= $row["foto"]; ?>" class="img-thumbnail rounded shadow-sm" style="max-height: 60px; object-fit: cover;" alt="Bukti">
                    <?php else : ?>
                      <span class="text-muted small">Tidak ada foto</span>
                    <?php endif; ?>
                  </td>
                  <td class="align-middle">
                    <div class="d-flex justify-content-center align-items-center">
                      <a href="verify.php?id_pengaduan=<?= $row["id_pengaduan"]; ?>" class="btn-action-verify mr-2"><i class="fas fa-check-double mr-1"></i> Verifikasi</a>
                      <a href="editLaporan.php?id_pengaduan=<?= $row["id_pengaduan"]; ?>&source=laporan" class="btn-action-edit mr-2"><i class="fas fa-edit mr-1"></i> Edit</a>
                      <a href="hapusLaporan.php?id_pengaduan=<?= $row["id_pengaduan"]; ?>&source=laporan" onclick="return confirm('Apakah Anda yakin ingin menghapus laporan ini?');" class="btn-action-delete"><i class="fas fa-trash mr-1"></i> Hapus</a>
                    </div>
                  </td>
                </tr>
                <?php $i++; ?>
              <?php endwhile; ?>
            <?php else : ?>
              <tr>
                <td colspan="6" class="text-center py-5 text-secondary">
                  <i class="fas fa-inbox fa-3x mb-3 text-light d-block"></i>
                  <span>Belum ada laporan baru yang masuk.</span>
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