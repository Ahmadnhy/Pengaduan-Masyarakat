<?php

$title = 'Tanggapan';

require '../../src/app.php';

require '../../layouts/header.php';

require '../../layouts/navAdmin.php';


// logic backend

$query = "SELECT * FROM ( ( tanggapan INNER JOIN pengaduan ON tanggapan.id_pengaduan = pengaduan.id_pengaduan )
          INNER JOIN petugas ON tanggapan.id_petugas = petugas.id_petugas ) ORDER BY id_tanggapan DESC";

$result = mysqli_query($conn, $query);

?>

<div class="container py-4">
  <div class="row align-items-center mb-4 animate-fade-in-up">
    <div class="col-12">
      <h3 class="text-dark font-weight-bold mb-1">Daftar Tanggapan Pengaduan</h3>
      <p class="text-secondary small mb-0">Riwayat seluruh tanggapan dan resolusi laporan yang telah dikirimkan oleh petugas.</p>
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
              <th scope="col">NIK Pelapor</th>
              <th scope="col">Tanggal Laporan</th>
              <th scope="col">Isi Aduan</th>
              <th scope="col">Tanggal Tanggapan</th>
              <th scope="col">Isi Tanggapan</th>
              <th scope="col">Petugas Respon</th>
              <th scope="col" style="width: 180px;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1; ?>
            <?php if (mysqli_num_rows($result) > 0) : ?>
              <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                  <td class="align-middle font-weight-bold text-secondary"><?= $i; ?>.</td>
                  <td class="align-middle font-weight-bold text-dark"><?= $row["nik"]; ?></td>
                  <td class="align-middle"><?= $row["tgl_pengaduan"]; ?></td>
                  <td class="align-middle text-left" style="max-width: 200px;"><?= $row["isi_laporan"]; ?></td>
                  <td class="align-middle"><?= $row["tgl_tanggapan"]; ?></td>
                  <td class="align-middle text-left text-success font-weight-bold" style="max-width: 200px;"><?= $row["tanggapan"]; ?></td>
                  <td class="align-middle"><span class="badge badge-pill badge-primary px-3 py-2"><i class="fas fa-user-shield mr-1"></i> <?= $row["nama_petugas"]; ?></span></td>
                  <td class="align-middle">
                    <div class="d-flex justify-content-center align-items-center">
                      <a href="editTanggapan.php?id_tanggapan=<?= $row["id_tanggapan"]; ?>" class="btn-action-edit mr-2"><i class="fas fa-edit mr-1"></i> Edit</a>
                      <a href="hapusTanggapan.php?id_tanggapan=<?= $row["id_tanggapan"]; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus tanggapan ini?');" class="btn-action-delete"><i class="fas fa-trash mr-1"></i> Hapus</a>
                    </div>
                  </td>
                </tr>
                <?php $i++; ?>
              <?php endwhile; ?>
            <?php else : ?>
              <tr>
                <td colspan="7" class="text-center py-5 text-secondary">
                  <i class="fas fa-comment-slash fa-3x mb-3 text-light d-block"></i>
                  <span>Belum ada tanggapan yang dikirimkan.</span>
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