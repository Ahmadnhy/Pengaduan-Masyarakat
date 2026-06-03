<?php

$title = 'Register';

require '../../src/app.php';

require '../../layouts/header.php';


// Logic Backend

if (isset($_POST['submit'])) {

  if (regisUser($_POST) > 0)
    header("location: sukses.php");
}

?>


<div class="d-flex justify-content-center py-5">
  <div class="card shadow glass-card animate-fade-in-up" data-aos="zoom-in" style="max-width: 480px; width: 100%;">
    <div class="card-body p-5">
      <div class="text-left mb-4">
        <h4 class="font-weight-bold text-dark text-uppercase">Registrasi Warga</h4>
        <p class="text-secondary small">Lengkapi data diri Anda untuk membuat akun pelaporan.</p>
      </div>
      
      <form action="" method="post">
        <div class="form-group mb-3">
          <label for="nik" class="font-weight-bold text-secondary small">Nomor Induk Kependudukan (NIK)</label>
          <input type="text" class="form-control shadow-sm" id="nik" placeholder="Masukkan 16 digit NIK" name="nik" required minlength="8">
        </div>
        <div class="form-group mb-3">
          <label for="nama" class="font-weight-bold text-secondary small">Nama Lengkap</label>
          <input type="text" class="form-control shadow-sm" id="nama" placeholder="Masukkan Nama Lengkap" name="nama" required>
        </div>
        <div class="form-group mb-3">
          <label for="username" class="font-weight-bold text-secondary small">Username</label>
          <input type="text" class="form-control shadow-sm" id="username" placeholder="Masukkan Username Anda" name="username" required>
        </div>
        <div class="form-group mb-3">
          <label for="password" class="font-weight-bold text-secondary small">Password</label>
          <input type="password" class="form-control shadow-sm" id="password" placeholder="Masukkan Password Anda" name="password" required>
        </div>
        <div class="form-group mb-4">
          <label for="telp" class="font-weight-bold text-secondary small">Nomor Telepon</label>
          <input type="text" class="form-control shadow-sm" id="telp" placeholder="Masukkan Nomor Telepon Aktif" name="telp" required>
        </div>
        
        <div class="text-center">
          <button type="submit" name="submit" class="btn btn-primary shadow-lg py-2 px-4 mt-2">Registrasi Akun</button>
        </div>
        
        <hr class="my-4">
        <div class="text-center">
          <span class="text-secondary small">Sudah memiliki akun? </span><a href="login.php" class="text-primary font-weight-bold small">Masuk di sini</a>
        </div>
      </form>
    </div>
  </div>
</div>

<?php require '../../layouts/footer.php'; ?>