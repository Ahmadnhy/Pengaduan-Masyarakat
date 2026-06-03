<?php

$title = 'Data Petugas';

require '../../src/app.php';

require '../../layouts/header.php';

require '../../layouts/navAdmin.php';


// Logic Backend

$result = mysqli_query($conn, "SELECT * FROM petugas WHERE level = 'petugas' ORDER BY id_petugas DESC");

?>

<div class="container py-4">
  <div class="row align-items-center mb-4 animate-fade-in-up">
    <div class="col-sm-6 text-center text-sm-left mb-3 mb-sm-0">
      <h3 class="text-dark font-weight-bold mb-1">Daftar Petugas Pelayanan</h3>
      <p class="text-secondary small mb-0">Kelola data petugas yang berwenang memproses aduan masyarakat.</p>
    </div>
    <div class="col-sm-6 text-center text-sm-right">
      <a href="tambah.php" class="btn btn-primary shadow-sm" style="border-radius: 8px;">
        <i class="fas fa-user-plus mr-2"></i> Tambah Petugas Baru
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
              <th scope="col" class="align-middle text-left pl-4">Nama Petugas</th>
              <th scope="col" class="align-middle">Username</th>
              <th scope="col" class="align-middle">Kata Sandi</th>
              <th scope="col" class="align-middle">Nomor Telepon</th>
              <th scope="col" style="width: 220px;" class="align-middle">Tindakan</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1; ?>
            <?php if (mysqli_num_rows($result) > 0) : ?>
              <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                  <td class="align-middle font-weight-bold text-secondary"><?= $i; ?>.</td>
                  <td class="align-middle font-weight-bold text-dark text-left pl-4">
                    <i class="fas fa-user-shield text-info mr-2"></i><?= $row['nama_petugas']; ?>
                  </td>
                  <td class="align-middle"><?= $row['username']; ?></td>
                  <td class="align-middle text-muted">••••••</td>
                  <td class="align-middle"><?= $row['telp']; ?></td>
                  <td class="align-middle">
                    <div class="d-flex justify-content-center align-items-center">
                      <a href="edit.php?id_petugas=<?= $row['id_petugas']; ?>" class="btn-action-edit mr-2">
                        <i class="fas fa-edit mr-1"></i> Edit
                      </a>
                      <a href="hapus.php?id_petugas=<?= $row['id_petugas']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus petugas ini?');" class="btn-action-delete">
                        <i class="fas fa-trash mr-1"></i> Hapus
                      </a>
                    </div>
                  </td>
                </tr>
                <?php $i++; ?>
              <?php endwhile; ?>
            <?php else : ?>
              <tr>
                <td colspan="6" class="text-center py-5 text-secondary">
                  <i class="fas fa-user-shield fa-3x mb-3 text-gray-300"></i>
                  <h6>Belum ada petugas terdaftar.</h6>
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