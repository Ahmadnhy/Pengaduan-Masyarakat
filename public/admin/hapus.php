<?php

$title = 'Hapus';

require '../../src/app.php';

require '../../layouts/header.php';

require '../../layouts/navAdmin.php';


// logic backend

$id = $_GET["id_petugas"];

if (deletePetugas($id) > 0) {
    $sukses = true;
} else {
    echo mysqli_error($conn);
}

?>


<?php if (isset($sukses)) : ?>

  <div class="container py-5">
    <div class="row justify-content-center py-5">
      <div class="col-md-6 text-center">
        <div class="card shadow-sm border-0 p-5 animate-fade-in-up" style="border-radius: 1.5rem;">
          <div class="card-body">
            <div class="mb-4">
              <img src="<?= ASSET_PATH; ?>img/sukses.png" class="img-fluid mb-4" style="max-height: 180px;" alt="Sukses Hapus" data-aos="zoom-in" data-aos-duration="700">
            </div>
            <h3 class="font-weight-bold text-dark mb-2">Petugas Berhasil Dihapus</h3>
            <p class="text-secondary small mb-4">Akun petugas telah dihapus secara permanen dari sistem database.</p>
            
            <a href="petugas.php" class="btn btn-primary px-5 py-2 shadow-lg" style="border-radius: 25px;">Selesai</a>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php endif; ?>

<?php require '../../layouts/footer.php'; ?>