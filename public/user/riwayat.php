<?php

$title = 'Riwayat Laporan';

require '../../src/app.php';

// Proteksi Halaman
if (!isset($_SESSION['nik'])) {
    header("Location: login.php");
    exit;
}

require '../../layouts/header.php';

require '../../layouts/navUser.php';

$nik = $_SESSION['nik'];
$result = mysqli_query($conn, "SELECT * FROM pengaduan WHERE nik = '$nik' ORDER BY id_pengaduan DESC");

?>

<div class="container py-4">
  <div class="row align-items-center mb-4 animate-fade-in-up">
    <div class="col-sm-6 text-center text-sm-left mb-3 mb-sm-0">
      <h3 class="text-dark font-weight-bold mb-1">Riwayat Pengaduan Anda</h3>
      <p class="text-secondary small mb-0">Pantau status penanganan dan tanggapan resmi dari laporan yang Anda kirimkan.</p>
    </div>
    <div class="col-sm-6 text-center text-sm-right">
      <a href="buatLaporan.php" class="btn btn-primary shadow-sm" style="border-radius: 8px;">
        <i class="fas fa-plus mr-2"></i> Buat Laporan Baru
      </a>
    </div>
  </div>

  <hr>

  <div class="card shadow-sm border-0 animate-fade-in-up mt-4" style="border-radius: 12px; overflow: hidden;">
    <div class="card-body p-4">
      <div class="table-responsive">
        <table class="table table-hover text-center align-middle mb-0">
          <thead class="thead-light">
            <tr>
              <th scope="col" style="width: 80px;" class="align-middle">No</th>
              <th scope="col" style="width: 140px;" class="align-middle">Tanggal Lapor</th>
              <th scope="col" style="width: 150px;" class="align-middle">NIK Pelapor</th>
              <th scope="col" class="text-left align-middle">Isi Pengaduan</th>
              <th scope="col" style="width: 130px;" class="align-middle">Foto Bukti</th>
              <th scope="col" style="width: 140px;" class="align-middle">Status</th>
              <th scope="col" style="width: 180px;" class="align-middle">Tanggapan</th>
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
                  <td class="align-middle text-left" style="max-width: 320px;"><?= $row["isi_laporan"]; ?></td>
                  <td class="align-middle">
                    <?php if (!empty($row['foto'])) : ?>
                      <img src="<?= ASSET_PATH; ?>img/<?= $row["foto"]; ?>" class="img-thumbnail rounded shadow-sm" style="max-height: 60px; object-fit: cover;" alt="Bukti">
                    <?php else : ?>
                      <span class="text-muted small">Tidak ada foto</span>
                    <?php endif; ?>
                  </td>
                  <td class="align-middle">
                    <?php if ($row['status'] === '0') : ?>
                      <span class="badge px-3 py-2 font-weight-bold" style="border-radius: 30px; font-size: 0.7rem; background-color: rgba(246, 194, 62, 0.1); color: #f6c23e;">PENDING</span>
                    <?php elseif ($row['status'] === 'proses') : ?>
                      <span class="badge px-3 py-2 font-weight-bold" style="border-radius: 30px; font-size: 0.7rem; background-color: rgba(54, 185, 204, 0.1); color: #36b9cc;">DIPROSES</span>
                    <?php elseif ($row['status'] === 'selesai') : ?>
                      <span class="badge px-3 py-2 font-weight-bold" style="border-radius: 30px; font-size: 0.7rem; background-color: rgba(28, 200, 138, 0.1); color: #1cc88a;">SELESAI</span>
                    <?php endif; ?>
                  </td>
                  <td class="align-middle">
                    <?php 
                    if ($row['status'] === 'selesai') {
                        $id_peng = $row['id_pengaduan'];
                        $t_query = mysqli_query($conn, "SELECT id_tanggapan FROM tanggapan WHERE id_pengaduan = $id_peng");
                        if (mysqli_num_rows($t_query) > 0) {
                            $t_data = mysqli_fetch_assoc($t_query);
                            $id_tanggapan = $t_data['id_tanggapan'];
                            ?>
                            <a href="preview.php?id_tanggapan=<?= $id_tanggapan; ?>" class="btn-action-verify">
                              <i class="fas fa-eye mr-1"></i> Tanggapan
                            </a>
                            <?php
                        } else {
                            echo '<span class="text-muted small italic">Selesai diverifikasi</span>';
                        }
                    } else {
                        echo '<span class="text-secondary small"><i class="fas fa-hourglass-half mr-1"></i> Menunggu...</span>';
                    }
                    ?>
                  </td>
                </tr>
                <?php $i++; ?>
              <?php endwhile; ?>
            <?php else : ?>
              <tr>
                <td colspan="7" class="text-center py-5 text-secondary">
                  <i class="fas fa-history fa-3x mb-3 text-gray-300 d-block"></i>
                  <h6>Anda belum pernah membuat laporan pengaduan.</h6>
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
