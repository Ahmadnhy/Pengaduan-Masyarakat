<?php

$title = 'Edit Petugas';

require '../../src/app.php';

require '../../layouts/header.php';

require '../../layouts/navAdmin.php';

$id = $_GET["id_petugas"];

$result = mysqli_query($conn, "SELECT * FROM petugas WHERE id_petugas = $id");

if (isset($_POST["submit"])) {

  if (editPetugas($_POST) > 0) {
    $sukses = true;
    // Refresh the data after edit
    $result = mysqli_query($conn, "SELECT * FROM petugas WHERE id_petugas = $id");
  } else {
    $error = true;
  }
}

?>


<div class="container py-4">
  <div class="row align-items-center mb-4 animate-fade-in-up">
    <div class="col-12">
      <h3 class="text-dark font-weight-bold mb-1">Edit Akun Petugas</h3>
      <p class="text-secondary small mb-0">Ubah informasi akun petugas dalam sistem pelayanan pengaduan.</p>
    </div>
  </div>

  <hr>

  <?php if (isset($sukses)) : ?>
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" style="border-radius: 0.75rem;" role="alert">
      <span class="font-weight-bold text-success"><i class="fas fa-check-circle mr-2"></i> Akun Petugas berhasil diperbarui!</span>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php endif; ?>

  <?php if (isset($error)) : ?>
    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" style="border-radius: 0.75rem;" role="alert">
      <span class="font-weight-bold text-danger"><i class="fas fa-exclamation-circle mr-2"></i> Maaf, akun petugas gagal diubah atau tidak ada perubahan data.</span>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php endif; ?>

  <div class="card shadow-sm border-0 animate-fade-in-up mt-4">
    <div class="card-body p-5">
      <div class="row">
        <div class="col-lg-8 mx-auto">
          <form action="" method="POST">
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
              <input type="hidden" name="id_petugas" value="<?= $row['id_petugas']; ?>">
              <input type="hidden" name="level" value="<?= $row['level']; ?>">

              <div class="form-group mb-3">
                <label for="nama_petugas" class="font-weight-bold text-secondary small">Nama Lengkap Petugas</label>
                <input type="text" class="form-control shadow-sm" id="nama_petugas" placeholder="Masukkan Nama Lengkap Petugas" name="nama_petugas" value="<?= $row['nama_petugas']; ?>" required>
              </div>
              
              <div class="form-group mb-3">
                <label for="username" class="font-weight-bold text-secondary small">Username Akun</label>
                <input type="text" class="form-control shadow-sm" id="username" placeholder="Masukkan Username Akun" name="username" value="<?= $row['username']; ?>" required>
              </div>
              
              <div class="form-group mb-3">
                <label for="password" class="font-weight-bold text-secondary small">Kata Sandi (Isi untuk mengganti)</label>
                <input type="password" class="form-control shadow-sm" id="password" placeholder="Masukkan Kata Sandi Baru" name="password" value="<?= $row['password']; ?>" required>
              </div>
              
              <div class="form-group mb-4">
                <label for="telp" class="font-weight-bold text-secondary small">Nomor Telepon Petugas</label>
                <input type="number" class="form-control shadow-sm" id="telp" placeholder="Masukkan Nomor Telepon" name="telp" value="<?= $row['telp']; ?>" required>
              </div>
              
              <div class="d-flex justify-content-between align-items-center mt-4">
                <a href="petugas.php" class="text-secondary small font-weight-bold"><i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar</a>
                <button type="submit" name="submit" class="btn btn-primary px-4 shadow-lg">Simpan Perubahan</button>
              </div>
            <?php endwhile; ?>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require '../../layouts/footer.php'; ?>