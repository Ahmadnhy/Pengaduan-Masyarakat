<?php

$title = 'Tanggapan';

require '../../src/app.php';

require '../../layouts/header.php';

require '../../layouts/navUser.php';


// logic backend

$query = "SELECT * FROM ( ( tanggapan INNER JOIN pengaduan ON tanggapan.id_pengaduan = pengaduan.id_pengaduan )
          INNER JOIN petugas ON tanggapan.id_petugas = petugas.id_petugas ) ORDER BY id_tanggapan DESC";

$result = mysqli_query($conn, $query);

?>


<div class="container py-4">
  <div class="row align-items-center mb-4 animate-fade-in-up">
    <div class="col-12">
      <h3 class="text-dark font-weight-bold mb-1">Tanggapan & Resolusi Laporan</h3>
      <p class="text-secondary small mb-0">Daftar tanggapan resmi yang diberikan oleh petugas pelayanan publik terhadap laporan Anda.</p>
    </div>
  </div>

  <hr>

  <div class="card shadow-sm border-0 animate-fade-in-up mt-4">
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table text-center table-hover">
          <thead>
            <tr>
              <th scope="col" style="width: 60px;">No</th>
              <th scope="col" style="width: 130px;">NIK</th>
              <th scope="col" style="width: 140px;">Tgl Lapor</th>
              <th scope="col" class="text-left">Laporan Kejadian</th>
              <th scope="col" style="width: 140px;">Tgl Respon</th>
              <th scope="col" class="text-left">Tanggapan Petugas</th>
              <th scope="col" style="width: 180px;">Nama Petugas</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1; ?>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
              <tr>
                <th scope="row" class="text-dark"><?= $i; ?>.</th>
                <td><?= $row["nik"]; ?></td>
                <td><?= $row["tgl_pengaduan"]; ?></td>
                <td class="text-left"><?= $row["isi_laporan"]; ?></td>
                <td><?= $row["tgl_tanggapan"]; ?></td>
                <td class="text-left font-weight-bold text-success"><?= $row["tanggapan"]; ?></td>
                <td>
                  <span class="badge badge-light p-2 font-weight-bold text-dark border"><i class="fas fa-user-shield text-primary mr-1"></i> <?= $row["nama_petugas"]; ?></span>
                </td>
              </tr>
              <?php $i++; ?>
            <?php endwhile; ?>
            <?php if (mysqli_num_rows($result) === 0) : ?>
              <tr>
                <td colspan="7" class="text-center py-5 text-secondary">
                  <i class="fas fa-comment-slash fa-3x mb-3 text-gray-300"></i>
                  <h6>Belum ada tanggapan yang dipublikasikan.</h6>
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